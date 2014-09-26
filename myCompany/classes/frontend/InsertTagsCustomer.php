<?php

    namespace MyCompany;

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
            return false;
        }

    }
