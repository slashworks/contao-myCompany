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
        public $project;

        /**
         * @var
         */
        public $documentType;


        /**
         * @return mixed
         */
        public function getProject()
        {

            return $this->project;
        }


        /**
         * @param mixed $customer
         */
        public function setProject($project)
        {

            $this->project = $project;
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
            if (strpos($strTag, 'project_') !== 0) {
                return false;
            }

            global $objPage;

            //set pageType
            $this->setDocumentType($objPage->outputFormat);
            $this->_getData($strTag);

            $sReturn = false;
            $curScope  = $this->getProject();


            /**
             * @TODO: IMPLEMENT INSERTTAGS HERE!
             */


            switch ($curScope['getItem']) {
                case 'images':
                    $sReturn = $this->_generateImages($curScope);
                    break;
            }




            if ($sReturn === false) {
                if (isset($curScope[$curScope['getItem']])) {
                    $sReturn = $curScope[$curScope['getItem']];
                }
            }


            // HOOK
            if (isset($GLOBALS['TL_HOOKS']['mycProjectInsertTag']) && is_array($GLOBALS['TL_HOOKS']['mycProjectInsertTag']))
            {
                foreach ($GLOBALS['TL_HOOKS']['mycProjectInsertTag'] as $callback)
                {
                    $this->import($callback[0]);
                    $sReturn = $this->$callback[0]->$callback[1]($strTag, $curScope, $this);
                }
            }


            return $sReturn;
        }



        private function _generateImages($item){
            $aImages = array();
            $aTmpImages = deserialize($item['images']);
            $aFiles = FilesModel::findMultipleByUuids(deserialize($item['images']));

            foreach($aFiles as $oFile){
                $aImages[] = $oFile->path;
            }


            return implode("<br>",$aImages);
        }


        /**
         * @param $el
         */
        private function _getData($el)
        {

            $strip_prefix = str_replace('project_', '', $el);
            $itagArr      = explode("::", $strip_prefix);
            $shorthandle  = $itagArr[0];


            $t = \MyCompany\ProjectModel::getAllShorthandlesAsArray($shorthandle);

            if (is_array($t) && count($t) > 0) {
                $t['getItem'] = $itagArr[1];
                $this->setProject($t);
            }
        }

    }
