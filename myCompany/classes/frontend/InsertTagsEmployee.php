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

    use Contao\FilesModel;
    use MyCompany\Helper\MyCompanyHelper;
    use MyCompany\Helper\Text;

    /**
     * Class InsertTagsEmployee
     *
     * @package MyCompany
     */
    class InsertTagsEmployee extends \Frontend
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
         * @return string
         */
        public static function getName(&$ident)
        {

            $aEmployee = EmployeeModel::getInstance($ident);

            return $aEmployee['surname'] . ' ' . $aEmployee['lastname'];
        }


        /**
         * @param $ident
         *
         * @return string
         */
        public static function getPhone(&$ident)
        {

            $aEmployee = EmployeeModel::getInstance($ident);
            $aCompany  = CompanyModel::getInstance($aEmployee['data']['company']);


            return Text::formatPhoneNumber($aCompany['phoneBasic'], $aEmployee['data']['phoneExt']);
        }


        /**
         * @param $ident
         *
         * @return string
         */
        public static function getFax(&$ident)
        {

            $aEmployee = EmployeeModel::getInstance($ident);
            $aCompany  = CompanyModel::getInstance($aEmployee['data']['company']);

            return Text::formatPhoneNumber($aCompany['faxBasic'], $aEmployee['data']['faxExt']);
        }


        /**
         * @param $ident
         *
         * @return mixed|null
         */
        public static function getPicture(&$ident)
        {

            $aEmployee = EmployeeDataModel::getInstance($ident);
            $oFile     = FilesModel::findByUuid($aEmployee['picture']);

            return $oFile->path;
        }


        /**
         * @param $ident
         *
         * @return string
         */
        public static function getFullName(&$ident)
        {

            $aEmployee = EmployeeModel::getInstance($ident);

            return $aEmployee['title'] . ' ' . $aEmployee['surname'] . ' ' . $aEmployee['lastname'];
        }


        /**
         * @param $curScope
         *
         * @return mixed
         */
        public static function getSurname(&$ident)
        {

            $aEmployee = EmployeeModel::getInstance($ident);

            return $aEmployee['surname'];
        }


        /**
         * @param $curScope
         *
         * @return mixed
         */
        public static function getLastname(&$ident)
        {

            $aEmployee = EmployeeModel::getInstance($ident);

            return $aEmployee['lastname'];
        }


        /**
         * @param $curScope
         *
         * @return mixed
         */
        public static function getTitle(&$ident)
        {

            $aEmployee = EmployeeModel::getInstance($ident);

            return $aEmployee['title'];
        }


        /**
         * @param $curScope
         *
         * @return mixed
         */
        public static function getPosition(&$ident)
        {

            $aEmployee = EmployeeModel::getInstance($ident);

            return $aEmployee['data']['position'];
        }


        /**
         * @param $curScope
         *
         * @return mixed
         */
        public static function getAbout(&$ident)
        {

            $aEmployee = EmployeeModel::getInstance($ident);

            return $aEmployee['data']['about'];
        }


        /**
         * @param $curScope
         *
         * @return mixed
         */
        public static function getEmail(&$ident)
        {

            $aEmployee = EmployeeModel::getInstance($ident);

            return $aEmployee['data']['email'];
        }


        /**
         * @param $curScope
         *
         * @return mixed
         */
        public static function getMobile(&$ident)
        {

            $aEmployee = EmployeeModel::getInstance($ident);

            return $aEmployee['data']['mobile'];
        }


        /**
         * @param $curScope
         *
         * @return mixed
         */
        public static function getPhoneExt(&$ident)
        {

            $aEmployee = EmployeeModel::getInstance($ident);

            return $aEmployee['data']['phoneExt'];
        }


        /**
         * @param $curScope
         *
         * @return mixed
         */
        public static function getFaxExt(&$ident)
        {

            $aEmployee = EmployeeModel::getInstance($ident);

            return $aEmployee['data']['faxExt'];
        }


        /**
         * @param $strTag
         *
         * @return bool|string
         */
        public function generateInsertTags($strTag)
        {

            // check if the insertTag is from type company
            if (strpos($strTag, 'employee_') !== 0) {
                return false;
            }


            global $objPage;
            self::setDocumentType($objPage->outputFormat);

            $aTag              = MyCompanyHelper::_parseTag($strTag);
            $mIdent            = $aTag['ident'];
            $sItem             = $aTag['item'];
            $aEmployeeData     = EmployeeDataModel::getInstance($mIdent);
            $aEmployee         = EmployeeModel::getInstance($aEmployeeData['pid']);
            $aEmployee['data'] = $aEmployeeData;

            $sReturn = false;
            switch ($sItem) {
                case 'nameFull':
                case 'fullName':
                    $sReturn = self::getFullName($mIdent);
                    break;
                case 'name':
                    $sReturn = self::getName($mIdent);
                    break;
                case 'id':
                    $sReturn = self::getName($mIdent);
                    break;
                case 'surname':
                    $sReturn = self::getSurname($mIdent);
                    break;
                case 'lastname':
                    $sReturn = self::getLastname($mIdent);
                    break;
                case 'title':
                    $sReturn = self::getTitle($mIdent);
                    break;
                case 'position':
                    $sReturn = self::getPosition($mIdent);
                    break;
                case 'about':
                    $sReturn = self::getAbout($mIdent);
                    break;
                case 'email':
                    $sReturn = self::getEmail($mIdent);
                    break;
                case 'mobile':
                    $sReturn = self::getMobile($mIdent);
                    break;
                case 'phoneExt':
                    $sReturn = self::getPhoneExt($mIdent);
                    break;
                case 'faxExt':
                    $sReturn = self::getFaxExt($mIdent);
                    break;
                case 'picture':
                    $sReturn = self::getPicture($mIdent);
                    break;
                case 'phone':
                    $sReturn = self::getPhone($mIdent);
                    break;
                case 'fax':
                    $sReturn = self::getFax($mIdent);
                    break;
                case 'companyPhoneDirectDial':
                    $sReturn = InsertTagsCompany::getPhoneDirect($aEmployeeData['company']);
                    break;
                case 'companyPhoneDirect':
                    $sReturn = InsertTagsCompany::getPhoneDirect($aEmployeeData['company']);
                    break;
                case 'companyFaxDirectDial':
                    $sReturn = InsertTagsCompany::getFaxDirectDial($aEmployeeData['company']);
                    break;
                case 'companyFaxDirect':
                    $sReturn = InsertTagsCompany::getFaxDirect($aEmployeeData['company']);
                    break;
                case 'companyFax':
                    $sReturn = InsertTagsCompany::getFax($aEmployeeData['company']);
                    break;
                case 'companyPhone':
                    $sReturn = InsertTagsCompany::getPhone($aEmployeeData['company']);
                    break;
                case 'companyName':
                    $sReturn = InsertTagsCompany::getName($aEmployeeData['company']);
                    break;
                case 'companyUrl':
                case 'companyWebsite':
                case 'companyDomain':
                    $sReturn = InsertTagsCompany::getUrl($aEmployeeData['company']);
                    break;
                case 'companyLogo':
                    $sReturn = InsertTagsCompany::getLogo($aEmployeeData['company']);
                    break;
                case 'companyEmail':
                    $sReturn = InsertTagsCompany::getEmail($aEmployeeData['company']);
                    break;
            }


            // HOOK
            if (isset($GLOBALS['TL_HOOKS']['mycEmployeeInsertTag']) && is_array($GLOBALS['TL_HOOKS']['mycEmployeeInsertTag'])) {
                foreach ($GLOBALS['TL_HOOKS']['mycEmployeeInsertTag'] as $callback) {
                    $this->import($callback[0]);
                    $sReturn = $this->$callback[0]->$callback[1]($strTag, $aEmployee, $this);
                }
            }


            return $sReturn;
        }
    }




