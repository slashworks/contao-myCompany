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

    use MyCompany\Helper\MyCompanyHelper;

    /**
     * Class InsertTagsCustomer
     *
     * @package MyCompany
     */
    class InsertTagsProject extends \Frontend
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
         * @return mixed
         */
        public static function getCustomer(&$ident)
        {

            $aProject = ProjectModel::getById($ident);

            return $aProject['customer'];
        }


        /**
         * @param $ident
         *
         * @return mixed
         */
        public static function getName(&$ident)
        {

            $aProject = ProjectModel::getById($ident);

            return $aProject['name'];
        }


        /**
         * @param $ident
         *
         * @return mixed
         */
        public static function getUrl(&$ident)
        {

            $aProject = ProjectModel::getById($ident);

            return $aProject['url'];
        }


        /**
         * @param $ident
         *
         * @return mixed
         */
        public static function getDescription(&$ident)
        {

            $aProject = ProjectModel::getById($ident);

            return $aProject['description'];
        }


        /**
         * @param $ident
         *
         * @return mixed
         */
        public static function getImages(&$ident)
        {

            $aImages  = array();
            $aProject = ProjectModel::getById($ident);
            $aFiles   = \FilesModel::findMultipleByUuids(deserialize($aProject['images']));
            foreach ($aFiles as $oFile) {
                $aImages[] = "<img src=\"" . $oFile->path . "\" class=\"myc_project_image\">";
            }


            return implode("", $aImages);
        }


        /**
         * @param $strTag
         *
         * @return bool|string
         */
        public function generateInsertTags($strTag)
        {

            // check if the insertTag is from type company
            if (strpos($strTag, 'project_') !== 0) {
                return false;
            }

            global $objPage;
            self::setDocumentType($objPage->outputFormat);

            $aTag     = MyCompanyHelper::_parseTag($strTag);
            $mIdent   = $aTag['ident'];
            $sItem    = $aTag['item'];
            $curScope = ProjectModel::getInstance($mIdent);
            $sReturn  = false;

            switch ($sItem) {
                case 'images':
                    $sReturn = self::getImages($mIdent);
                    break;
                case 'name':
                    $sReturn = self::getName($mIdent);
                    break;
                case 'url':
                    $sReturn = self::getUrl($mIdent);
                    break;
                case 'description':
                    $sReturn = self::getDescription($mIdent);
                    break;
                case 'customerLogo':
                    $sReturn = InsertTagsCustomer::getLogo($curScope['customer']);
                    break;
                case 'customerName':
                    $sReturn = InsertTagsCustomer::getName($curScope['customer']);
                    break;
                case 'customerUrl':
                    $sReturn = InsertTagsCustomer::getUrl($curScope['customer']);
                    break;
                case 'customerCompany':
                    $sReturn = InsertTagsCustomer::getCompany($curScope['customer']);
                    break;
                case 'customerDescription':
                    $sReturn = InsertTagsCustomer::getDescription($curScope['customer']);
                    break;

            }


            if ($sReturn === false) {
                if (isset($curScope[$curScope['getItem']])) {
                    $sReturn = $curScope[$curScope['getItem']];
                }
            }


            // HOOK
            if (isset($GLOBALS['TL_HOOKS']['mycProjectInsertTag']) && is_array($GLOBALS['TL_HOOKS']['mycProjectInsertTag'])) {
                foreach ($GLOBALS['TL_HOOKS']['mycProjectInsertTag'] as $callback) {
                    $this->import($callback[0]);
                    $sReturn = $this->$callback[0]->$callback[1]($strTag, $curScope, $this);
                }
            }


            return $sReturn;
        }

    }
