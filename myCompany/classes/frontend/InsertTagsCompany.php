<?php
    /**
     *
     *          _           _                       _
     *         | |         | |                     | |
     *      ___| | __ _ ___| |____      _____  _ __| | _____
     *     / __| |/ _` / __| '_ \ \ /\ / / _ \| '__| |/ / __|
     *     \__ \ | (_| \__ \ | | \ V  V / (_) | |  |   <\__ \
     *     |___/_|\__,_|___/_| |_|\_/\_/ \___/|_|  |_|\_\___/
     *                                        web development
     *
     *     http://www.slash-works.de </> hallo@slash-works.de
     *
     *
     * @author      rwollenburg
     * @copyright   rwollenburg@slashworks
     * @since       24.09.14 00:00
     * @package     MyCompany
     *
     */

    namespace MyCompany;

    /**
     * Class InsertTagsCompany
     *
     * @package MyCompany
     */
    use Contao\FilesModel;
    use MyCompany\Helper\Text;

    /**
     * Class InsertTagsCompany
     *
     * @package MyCompany
     */
    class InsertTagsCompany extends \Frontend
    {

        /**
         * @var
         */
        public $company;

        /**
         * @var
         */
        public $documentType;


        /**
         * @return mixed
         */
        public function getCompany()
        {

            return $this->company;
        }


        /**
         * @param mixed $companies
         */
        public function setCompany($companies)
        {

            $this->company = $companies;
        }


        /**
         * @return mixed
         */
        public function getDocumentType()
        {

            return $this->documentType;
        }


        /**
         * @param mixed $documentType
         */
        public function setDocumentType($documentType)
        {

            $this->documentType = $documentType;
        }


        /**
         * @param $strTag
         *
         * @return bool|string
         */
        public function generateInsertTags($strTag)
        {

            // check if the insertTag is from type company
            if (strpos($strTag, 'company_') !== 0) {
                return false;
            }

            global $objPage;

            //set pageType
            $this->setDocumentType($objPage->outputFormat);

            $this->_getData($strTag);


            $sReturn  = false;
            $curScope = $this->getCompany();

            switch ($curScope['getItem']) {
                case 'mail':
                    $sReturn = $this->_getEmail();
                    break;
                case 'mailPlain':
                    $sReturn = $this->_getEmail(true);
                    break;
                case 'phoneDirectDial':
                    $sReturn = self::_generateCompanyPhoneDirectDial($curScope);
                    break;
                case 'phoneDirect':
                    $sReturn = self::_generateCompanyPhoneDirect($curScope);
                    break;
                case 'faxDirectDial':
                    $sReturn = self::_generateCompanyFaxDirectDial($curScope);
                    break;
                case 'faxDirect':
                    $sReturn = self::_generateCompanyFaxDirect($curScope);
                    break;
                case 'fax':
                    $sReturn = self::_generateCompanyFax($curScope);
                    break;
                case 'phone':
                    $sReturn = self::_generateCompanyPhone($curScope);
                    break;
                case 'address':
                    $sReturn = $this->_getAddress();
                    break;
                case 'logo':
                    $sReturn = $this->_getLogo($curScope);
                    break;
                case 'contactNoLabel':
                    $sReturn = $this->_getContact();
                    break;
                case 'contact':
                    $sReturn = $this->_getContact(true);
                    break;
                case 'companyEmail':
                    $sReturn = self::_generateCompanyEmail($curScope);
                    break;
            }


            if ($sReturn === false) {
                if (isset($curScope[$curScope['getItem']])) {
                    $sReturn = $curScope[$curScope['getItem']];
                }
            }


            if (strpos($curScope['getItem'], 'opt_') === 0 && strpos($strTag, 'company_') === 0) {

                $optionals = deserialize($curScope['optionals']);
                $value     = str_replace('opt_', '', $curScope['getItem']);

                foreach ($optionals as $k => $v) {
                    if ($v['label'] === $value) {
                        $sReturn = $v['optiontext'];
                        break;
                    }

                }
            }

            // HOOK
            if (isset($GLOBALS['TL_HOOKS']['mycCompanyInsertTag']) && is_array($GLOBALS['TL_HOOKS']['mycCompanyInsertTag'])) {
                foreach ($GLOBALS['TL_HOOKS']['mycCompanyInsertTag'] as $callback) {
                    $this->import($callback[0]);
                    $sReturn = $this->$callback[0]->$callback[1]($strTag, $curScope, $this);
                }
            }

            return $sReturn;
        }

        /**
         * @param $item
         *
         * @return string
         */
        private function _getLogo($item)
        {

            $oFile = FilesModel::findByUuid($item['logo']);

            return $oFile->path;
        }

        /**
         * @param $el
         */
        private function _getData($el)
        {

            $strip_prefix = str_replace('company_', '', $el);
            $itagArr      = explode("::", $strip_prefix);
            $shorthandle  = $itagArr[0];

            $t = \MyCompany\CompanyModel::getAllShorthandlesAsArray($shorthandle);

            if (is_array($t) && count($t) > 0) {
                $t['getItem'] = $itagArr[1];
                $this->setCompany($t);
            }
        }


        /**
         * address getter
         *
         * @return string
         */
        private function _getAddress()
        {

            $_cfg     = $this->getCompany();
            $itemsArr = array
            (
                'companyName'    => $_cfg['name'],
                'companyStreet'  => $_cfg['street'],
                'companyZipCity' => $_cfg['zip'] . ' ' . $_cfg['city']
            );
            $out      = $this->blockBuilder($itemsArr);

            return $out;
        }


        /**
         * @param bool $useLabel
         *
         * @return string
         */
        private function _getContact($useLabel = false)
        {

            $_cfg     = $this->getCompany();
            $itemsArr = array
            (
                'companyEmail' => $this->_getEmail(),
                'companyPhone' => $this->_getPhoneBasic($_cfg['phoneDirectDial']),
                'companyFax'   => $this->_getPhoneBasic($_cfg['faxDirectDial'])
            );
            $out      = $this->blockBuilder($itemsArr, $useLabel);

            return $out;
        }


        /**
         * email getter
         *
         * @param bool $plain
         *
         * @return bool|string
         */
        private function _getEmail($plain = false)
        {

            $sReturn = false;

            // get the Data Array
            $_cfg = $this->getCompany();

            //build the mail string
            $_mail = $_cfg['email'];

            //check if is plain or not
            if ($plain === true) {
                $sReturn = $_mail;
            } else {
                $sReturn = '<a href="mailto:' . $_mail . '">' . $_mail . '</a>';
            }

            return $sReturn;
        }


        /**
         * phone getter
         *
         * @param bool $number
         *
         * @return string
         */
        private function _getPhoneBasic($number)
        {

            $_cfg = $this->getCompany();

            return $_cfg['phoneBasic'] . "-" . $number;
        }


        /**
         * @param $item
         *
         * @return string
         */
        private function _generateCompanyPhoneDirectDial($item)
        {

            $aCompany = $this->getCompany();

            return $aCompany['phoneDirectDial'];
        }


        /**
         * @param $item
         *
         * @return string
         */
        private function _generateCompanyPhoneDirect($item)
        {

            $aCompany = $this->getCompany();

            return Text::formatPhoneNumber($aCompany['phoneBasic'], $aCompany['phoneDirectDial']);
        }


        /**
         * @param $item
         *
         * @return string
         */
        private function _generateCompanyFaxDirectDial($item)
        {

            $aCompany = $this->getCompany();

            return $aCompany['faxDirectDial'];
        }


        /**
         * @param $item
         *
         * @return string
         */
        private function _generateCompanyFaxDirect($item)
        {

            $aCompany = $this->getCompany();

            return Text::formatPhoneNumber($aCompany['faxBasic'], $aCompany['faxDirectDial']);
        }


        /**
         * @param $item
         *
         * @return string
         */
        private function _generateCompanyPhone($item)
        {

            $aCompany = $this->getCompany();

            return $aCompany['phoneBasic'];
        }

        /**
         * @param $item
         *
         * @return string
         */
        private function _generateCompanyEmail($item)
        {

            $aCompany = $this->getCompany();

            return $aCompany['email'];
        }


        /**
         * @param $item
         *
         * @return string
         */
        private function _generateCompanyFax($item)
        {

            $aCompany = $this->getCompany();

            return $aCompany['faxBasic'];
        }


        /**
         * Helper for html building
         *
         * @param        $arr
         * @param bool   $useLabel
         * @param string $wrap
         * @param string $seperator
         *
         * @return string
         * @throws \Exception
         */
        private function blockBuilder($arr, $useLabel = false, $wrap = 'span', $seperator = 'br')
        {

            if (is_array($arr)) {
                if ($this->getDocumentType() == 'xhtml') {
                    $seperator .= ' /';
                }

                $_out = '';
                foreach ($arr as $key => $item) {
                    if ($useLabel) {
                        $_out .= '<' . $wrap . ' class="' . $key . '-label">' . $GLOBALS['TL_LANG']['MSC']['company'][$key] . '</' . $wrap . '>';
                    }
                    $_out .= '<' . $wrap . ' class="' . $key . '">' . $item . '</' . $wrap . '><' . $seperator . '>';
                }

                return $_out;
            } else {
                throw new \Exception("Parameter 1 must be an array!");
            }
        }
    }
