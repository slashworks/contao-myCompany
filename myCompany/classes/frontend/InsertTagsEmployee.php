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
     * Class InsertTagsEmployee
     *
     * @package MyCompany
     */
    class InsertTagsEmployee extends \Frontend
    {

        /**
         * @var
         */
        public $employees;

        /**
         * @var
         */
        public $documentType;


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
         * @return mixed
         */
        public function getEmployees()
        {

            return $this->employees;
        }


        /**
         * @param mixed $aEmployees
         */
        public function setEmployees($aEmployees)
        {

            $this->employees = $aEmployees;
        }


        /**
         * @param $strTag
         *
         * @return bool|string
         */
        public function generateInsertTags($strTag)
        {

            // check if the insertTag is from type company
            if (strpos($strTag, 'cmember_') != 0) {
                return false;
            }


            global $objPage;

            //set pageType
            $this->setDocumentType($objPage->outputFormat);

            $this->_getData($strTag);

            $sReturn  = false;
            $curScope = $this->getEmployees();

            switch ($curScope['getItem']) {
                case 'nameFull':
                    $sReturn = self::_generateFullName($curScope);
                    break;
                case 'name':
                    $sReturn = self::_generateName($curScope);
                    break;
                case 'surname':
                    $sReturn = self::_generateName($curScope);
                    break;
                case 'lastname':
                    $sReturn = self::_generateName($curScope);
                    break;
                case 'title':
                    $sReturn = self::_generateName($curScope);
                    break;
                case 'about':
                    $sReturn = self::_generateName($curScope);
                    break;
                case 'phoneExt':
                    $sReturn = self::_generateName($curScope);
                    break;
                case 'faxExt':
                    $sReturn = self::_generateName($curScope);
                    break;
                case 'mail':
                    $sReturn = self::_generateName($curScope);
                    break;
            }

            // HOOK
            if (isset($GLOBALS['TL_HOOKS']['mycEmployeeInsertTag']) && is_array($GLOBALS['TL_HOOKS']['mycEmployeeInsertTag']))
            {
                foreach ($GLOBALS['TL_HOOKS']['mycEmployeeInsertTag'] as $callback)
                {
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

            $strip_prefix = str_replace('cmember_', '', $el);
            $itagArr      = explode("::", $strip_prefix);
            $shorthandle  = $itagArr[0];

            $t = \MyCompany\EmployeeModel::getAllShorthandlesAsArray($shorthandle);

            if (is_array($t) && count($t) > 0) {
                $t['getItem'] = $itagArr[1];
                $this->setEmployees($t);
            }
        }


        /**
         * @param $item
         *
         * @return string
         */
        private function _generateNameWTitle($item)
        {

            $title = ($item['title']) ? $item['title'] . ' ' : '';

            return $title . self::_generateName($item);
        }


        /**
         * @param $item
         *
         * @return string
         */
        private function _generateName($item)
        {

            return $item['surname'] . ' ' . $item['lastname'];
        }


        /**
         * @param $item
         *
         * @return string
         */
        private function _generateFullName($item)
        {

            return $item['title'] . ' ' . $item['surname'] . ' ' . $item['lastname'];
        }
    }
