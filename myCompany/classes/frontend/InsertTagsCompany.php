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
    use MyCompany\Helper\MyCompanyHelper;
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
        public static $documentType;


        /**
         * @param $ident
         *
         * @return mixed|null
         */
        public static function getLogo(&$ident)
        {

            $item  = CompanyModel::getInstance($ident);
            $oFile = FilesModel::findByUuid($item['logo']);

            return $oFile->path;
        }


        /**
         * address getter
         *
         * @return string
         */
        public static function getAddress(&$ident)
        {

            $aCompany = CompanyModel::getInstance($ident);
            $itemsArr = array
            (
                'companyName'    => $aCompany['name'],
                'companyStreet'  => $aCompany['street'],
                'companyZipCity' => $aCompany['zip'] . ' ' . $aCompany['city']
            );
            $out      = self::blockBuilder($itemsArr);

            return $out;
        }


        /**
         * @param bool $useLabel
         *
         * @return string
         */
        public static function getContact(&$ident, $useLabel = false)
        {

            $aCompany = CompanyModel::getInstance($ident);

            $itemsArr = array
            (
                'companyEmail' => self::getEmail($ident),
                'companyPhone' => self::getPhoneDirect($ident),
                'companyFax'   => self::getFaxDirect($ident),
            );
            $out      = self::blockBuilder($itemsArr, $useLabel);

            return $out;
        }


        /**
         * email getter
         *
         * @param bool $plain
         *
         * @return bool|string
         */
        public static function getEmail(&$ident, $plain = false)
        {

            $aCompany = CompanyModel::getInstance($ident);
            $sReturn  = false;

            //check if is plain or not
            if ($plain === true) {
                $sReturn = $aCompany['email'];
            } else {
                $sReturn = '<a href="mailto:' . $aCompany['email'] . '">' . $aCompany['email'] . '</a>';
            }

            return $sReturn;
        }


        /**
         * @param $ident
         *
         * @return mixed
         */
        public static function getPhoneDirectDial(&$ident)
        {

            $aCompany = CompanyModel::getInstance($ident);

            return $aCompany['phoneDirectDial'];
        }


        /**
         * @param $ident
         *
         * @return string
         */
        public static function getPhoneDirect(&$ident)
        {

            $aCompany = CompanyModel::getInstance($ident);

            return Text::formatPhoneNumber($aCompany['phoneBasic'], $aCompany['phoneDirectDial']);
        }


        /**
         * @param $ident
         *
         * @return string
         */
        public static function getFaxDirectDial(&$ident)
        {

            $aCompany = CompanyModel::getInstance($ident);

            return $aCompany['faxDirectDial'];
        }


        /**
         * @param $ident
         *
         * @return string
         */
        public static function getFaxDirect(&$ident)
        {

            $aCompany = CompanyModel::getInstance($ident);

            return Text::formatPhoneNumber($aCompany['faxBasic'], $aCompany['faxDirectDial']);
        }


        /**
         * @param $ident
         *
         * @return string
         */
        public static function getPhone(&$ident)
        {

            $aCompany = CompanyModel::getInstance($ident);

            return $aCompany['phoneBasic'];
        }


        /**
         * @param $ident
         *
         * @return string
         */
        public static function getName(&$ident)
        {

            $aCompany = CompanyModel::getInstance($ident);

            return $aCompany['name'];
        }


        /**
         * @param $ident
         *
         * @return string
         */
        public static function getUrl(&$ident)
        {

            $aCompany = CompanyModel::getInstance($ident);

            return $aCompany['domain'];
        }


        /**
         * @param $ident
         *
         * @return string
         */
        public static function getStreet(&$ident)
        {

            $aCompany = CompanyModel::getInstance($ident);

            return $aCompany['street'];
        }


        /**
         * @param $ident
         *
         * @return string
         */
        public static function getCity(&$ident)
        {

            $aCompany = CompanyModel::getInstance($ident);

            return $aCompany['city'];
        }


        /**
         * @param $ident
         *
         * @return string
         */
        public static function getZip(&$ident)
        {

            $aCompany = CompanyModel::getInstance($ident);

            return $aCompany['zip'];
        }


        /**
         * @param $ident
         *
         * @return string
         */
        public static function getFax(&$ident)
        {

            $aCompany = CompanyModel::getInstance($ident);

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
        public static function blockBuilder($arr, $useLabel = false, $wrap = 'span', $seperator = 'br')
        {

            if (is_array($arr)) {
                if (self::getDocumentType() == 'xhtml') {
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


        /**
         * @return mixed
         */
        public static function getDocumentType()
        {

            return self::$documentType;
        }


        /**
         * @param mixed $documentType
         */
        public static function setDocumentType($documentType)
        {

            self::$documentType = $documentType;
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
            self::setDocumentType($objPage->outputFormat);

            $aTag     = MyCompanyHelper::_parseTag($strTag);
            $mIdent   = $aTag['ident'];
            $sItem    = $aTag['item'];
            $curScope = CompanyModel::getInstance($mIdent);

            $sReturn = false;

            switch ($sItem) {
                case 'mail':
                    $sReturn = self::getEmail($mIdent);
                    break;
                case 'mailPlain':
                    $sReturn = self::getEmail($mIdent, true);
                    break;
                case 'phoneDirectDial':
                    $sReturn = self::getPhoneDirectDial($mIdent);
                    break;
                case 'phoneDirect':
                    $sReturn = self::getPhoneDirect($mIdent);
                    break;
                case 'faxDirectDial':
                    $sReturn = self::getFaxDirectDial($mIdent);
                    break;
                case 'faxDirect':
                    $sReturn = self::getFaxDirect($mIdent);
                    break;
                case 'fax':
                    $sReturn = self::getFax($mIdent);
                    break;
                case 'phone':
                    $sReturn = self::getPhone($mIdent);
                    break;
                case 'address':
                    $sReturn = self::getAddress($mIdent);
                    break;
                case 'logo':
                    $sReturn = self::getLogo($mIdent);
                    break;
                case 'contactNoLabel':
                    $sReturn = self::getContact($mIdent);
                    break;
                case 'contact':
                    $sReturn = self::getContact($mIdent, true);
                    break;
                case 'email':
                    $sReturn = self::getEmail($mIdent);
                    break;
                case 'name':
                    $sReturn = self::getName($mIdent);
                    break;
                case 'url':
                case 'website':
                case 'domain':
                    $sReturn = self::getUrl($mIdent);
                    break;
                case 'street':
                    $sReturn = self::getStreet($mIdent);
                    break;
                case 'city':
                    $sReturn = self::getCity($mIdent);
                    break;
                case 'zip':
                    $sReturn = self::getZip($mIdent);
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
    }
