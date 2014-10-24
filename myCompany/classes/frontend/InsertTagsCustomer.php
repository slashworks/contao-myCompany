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
    use MyCompany\Helper\MyCompanyHelper;
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
        public static $documentType;


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
         * @param $ident
         *
         * @return mixed|null
         */
        public static function getLogo(&$ident)
        {

            $aCustomer = CustomerModel::getInstance($ident);
            $oFile     = FilesModel::findByUuid($aCustomer['logo']);

            return $oFile->path;
        }


        /**
         * @param $ident
         *
         * @return mixed
         */
        public static function getName(&$ident)
        {

            $aCustomer = CustomerModel::getById($ident);

            return $aCustomer['name'];
        }


        /**
         * @param $ident
         *
         * @return mixed
         */
        public static function getUrl(&$ident)
        {

            $aCustomer = CustomerModel::getById($ident);

            return $aCustomer['url'];
        }


        /**
         * @param $ident
         *
         * @return mixed
         */
        public static function getDescription(&$ident)
        {

            $aCustomer = CustomerModel::getById($ident);

            return $aCustomer['description'];
        }


        /**
         * @param $ident
         *
         * @return mixed
         */
        public static function getCompany(&$ident)
        {

            $aCustomer = CustomerModel::getById($ident);

            return $aCustomer['company'];
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

            self::setDocumentType($objPage->outputFormat);

            $aTag     = MyCompanyHelper::_parseTag($strTag);
            $mIdent   = $aTag['ident'];
            $sItem    = $aTag['item'];
            $aProject = CustomerModel::getInstance($mIdent);


            $sReturn = false;

            switch ($sItem) {
                case 'logo':
                    $sReturn = self::getLogo($mIdent);
                    break;
                case 'name':
                    $sReturn = self::getName($mIdent);
                    break;
                case 'description':
                    $sReturn = self::getDescription($mIdent);
                    break;
                case 'url':
                    $sReturn = self::getUrl($mIdent);
                    break;
                case 'company':
                    $sReturn = self::getCompany($mIdent);
                    break;
                case 'companyPhoneDirectDial':
                    $sReturn = InsertTagsCompany::getPhoneDirect($aProject['company']);
                    break;
                case 'companyPhoneDirect':
                    $sReturn = InsertTagsCompany::getPhoneDirect($aProject['company']);
                    break;
                case 'companyFaxDirectDial':
                    $sReturn = InsertTagsCompany::getFaxDirectDial($aProject['company']);
                    break;
                case 'companyFaxDirect':
                    $sReturn = InsertTagsCompany::getFaxDirect($aProject['company']);
                    break;
                case 'companyFax':
                    $sReturn = InsertTagsCompany::getFax($aProject['company']);
                    break;
                case 'companyPhone':
                    $sReturn = InsertTagsCompany::getPhone($aProject['company']);
                    break;
                case 'companyName':
                    $sReturn = InsertTagsCompany::getName($aProject['company']);
                    break;
                case 'companyUrl':
                case 'companyDomain':
                case 'companyWebsite':
                    $sReturn = InsertTagsCompany::getUrl($aProject['company']);
                    break;
                case 'companyLogo':
                    $sReturn = InsertTagsCompany::getLogo($aProject['company']);
                    break;
                case 'companyEmail':
                    $sReturn = InsertTagsCompany::getEmail($aProject['company']);
                    break;
            }


            // HOOK
            if (isset($GLOBALS['TL_HOOKS']['mycCustomerInsertTag']) && is_array($GLOBALS['TL_HOOKS']['mycCustomerInsertTag'])) {
                foreach ($GLOBALS['TL_HOOKS']['mycCustomerInsertTag'] as $callback) {
                    $this->import($callback[0]);
                    $sReturn = $this->$callback[0]->$callback[1]($strTag, $aProject, $this);
                }
            }

            return $sReturn;
        }

    }
