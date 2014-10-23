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
     * Class InsertTagsCustomer
     *
     * @package MyCompany
     */
    use Contao\FilesModel;
    use MyCompany\Helper\Text;

    /**
     * Class InsertTagsCustomer
     *
     * @package MyCompany
     */
    class InsertTagsCustomer extends \Frontend
    {

        /**
         * @var
         */
        public $customer;

        /**
         * @var
         */
        public $documentType;


        /**
         * @return mixed
         */
        public function getCustomer()
        {

            return $this->customer;
        }


        /**
         * @param mixed $customer
         */
        public function setCustomer($customer)
        {

            $this->customer = $customer;
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
            if (strpos($strTag, 'customer_') !== 0) {
                return false;
            }

            global $objPage;

            //set pageType
            $this->setDocumentType($objPage->outputFormat);
            $this->_getData($strTag);


            $sReturn  = false;
            $curScope = $this->getCustomer();

            /**
             * @TODO: IMPLEMENT INSERTTAGS HERE!
             */


            switch ($curScope['getItem']) {
                case 'logo':
                    $sReturn = $this->_getLogo($curScope);
                    break;
                case 'companyPhoneDirectDial':
                    $sReturn = self::_generateCompanyPhoneDirectDial($curScope);
                    break;
                case 'companyPhoneDirect':
                    $sReturn = self::_generateCompanyPhoneDirect($curScope);
                    break;
                case 'companyFaxDirectDial':
                    $sReturn = self::_generateCompanyFaxDirectDial($curScope);
                    break;
                case 'companyFaxDirect':
                    $sReturn = self::_generateCompanyFaxDirect($curScope);
                    break;
                case 'companyFax':
                    $sReturn = self::_generateCompanyFax($curScope);
                    break;
                case 'companyPhone':
                    $sReturn = self::_generateCompanyPhone($curScope);
                    break;
                case 'companyName':
                    $sReturn = self::_generateCompanyName($curScope);
                    break;
                case 'companyUrl':
                    $sReturn = self::_generateCompanyUrl($curScope);
                    break;
                case 'companyLogo':
                    $sReturn = self::_generateCompanyLogo($curScope);
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


            // HOOK
            if (isset($GLOBALS['TL_HOOKS']['mycCustomerInsertTag']) && is_array($GLOBALS['TL_HOOKS']['mycCustomerInsertTag'])) {
                foreach ($GLOBALS['TL_HOOKS']['mycCustomerInsertTag'] as $callback) {
                    $this->import($callback[0]);
                    $sReturn = $this->$callback[0]->$callback[1]($strTag, $curScope, $this);
                }
            }

            return $sReturn;
        }





        /**
         * @param $el
         */
        private function _getData($el)
        {

            $strip_prefix = str_replace('customer_', '', $el);
            $itagArr      = explode("::", $strip_prefix);
            $shorthandle  = $itagArr[0];


            $t = \MyCompany\CustomerModel::getAllShorthandlesAsArray($shorthandle);

            if (is_array($t) && count($t) > 0) {
                $t['getItem'] = $itagArr[1];
                $this->setCustomer($t);
            }
        }


        /**
         * @param $item
         *
         * @return string
         */
        private function _generateCompanyEmail($item)
        {

            $aCompany = CompanyModel::getById($item['company']);

            return $aCompany['email'];
        }

        /**
         * @param $item
         *
         * @return string
         */
        private function _generateCompanyName($item)
        {

            $aCompany = CompanyModel::getById($item['company']);

            return $aCompany['name'] . ' ' . $aCompany['legalForm'];
        }


        /**
         * @param $item
         *
         * @return string
         */
        private function _generateCompanyPhoneDirectDial($item)
        {

            $aCompany = CompanyModel::getById($item['company']);

            return $aCompany['phoneDirectDial'];
        }


        /**
         * @param $item
         *
         * @return string
         */
        private function _generateCompanyPhoneDirect($item)
        {

            $aCompany = CompanyModel::getById($item['company']);

            return Text::formatPhoneNumber($aCompany['phoneBasic'], $aCompany['phoneDirectDial']);
        }


        /**
         * @param $item
         *
         * @return string
         */
        private function _generateCompanyFaxDirectDial($item)
        {

            $aCompany = CompanyModel::getById($item['company']);

            return $aCompany['faxDirectDial'];
        }


        /**
         * @param $item
         *
         * @return string
         */
        private function _generateCompanyFaxDirect($item)
        {

            $aCompany = CompanyModel::getById($item['company']);

            return Text::formatPhoneNumber($aCompany['faxBasic'], $aCompany['faxDirectDial']);
        }


        /**
         * @param $item
         *
         * @return string
         */
        private function _generateCompanyUrl($item)
        {

            $aCompany = CompanyModel::getById($item['company']);

            return $aCompany['domain'];
        }


        /**
         * @param $item
         *
         * @return string
         */
        private function _generateCompanyLogo($item)
        {

            $aCompany = CompanyModel::getById($item['company']);
            $oFile    = FilesModel::findByUuid($aCompany['logo']);

            return $oFile->path;
        }

        /**
         * @param $item
         *
         * @return string
         */
        private function _generateCompanyPhone($item)
        {

            $aCompany = CompanyModel::getById($item['company']);

            return $aCompany['phoneBasic'];
        }


        /**
         * @param $item
         *
         * @return string
         */
        private function _generateCompanyFax($item)
        {

            $aCompany = CompanyModel::getById($item['company']);

            return $aCompany['faxBasic'];
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

    }
