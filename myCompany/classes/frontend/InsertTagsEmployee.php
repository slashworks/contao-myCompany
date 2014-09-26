<?php

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

            return $this->parseEmployeeInsertTags($strTag);
        }


        /**
         * Actions for company insert tags
         *
         * @return bool|string
         */
        private function parseEmployeeInsertTags()
        {

            $_r       = false;
            $curScope = $this->getEmployees();

            switch ($curScope['getItem']) {
                case 'nameFull':
                    $_r = self::_generateFullName($curScope);
                    break;
                case 'name':
                    $_r = self::_generateName($curScope);
                    break;
                case 'surname':
                    $_r = self::_generateName($curScope);
                    break;
                case 'lastname':
                    $_r = self::_generateName($curScope);
                    break;
                case 'title':
                    $_r = self::_generateName($curScope);
                    break;
                case 'about':
                    $_r = self::_generateName($curScope);
                    break;
                case 'phoneExt':
                    $_r = self::_generateName($curScope);
                    break;
                case 'faxExt':
                    $_r = self::_generateName($curScope);
                    break;
                case 'mail':
                    $_r = self::_generateName($curScope);
                    break;
            }

            return $_r;
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

            return $item['title'].' '.$item['surname'] . ' ' . $item['lastname'];
        }
    }
