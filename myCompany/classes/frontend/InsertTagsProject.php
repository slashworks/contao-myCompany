<?php

    namespace MyCompany;

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
            return false;
        }

    }
