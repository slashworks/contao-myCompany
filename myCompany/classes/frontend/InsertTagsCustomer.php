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
            $sReturn = false;
            $curScope  = $this->getCustomer();


            /**
             * @TODO: IMPLEMENT INSERTTAGS HERE!
             */


            // HOOK
            if (isset($GLOBALS['TL_HOOKS']['mycCustomerInsertTag']) && is_array($GLOBALS['TL_HOOKS']['mycCustomerInsertTag']))
            {
                foreach ($GLOBALS['TL_HOOKS']['mycCustomerInsertTag'] as $callback)
                {
                    $this->import($callback[0]);
                    $sReturn = $this->$callback[0]->$callback[1]($strTag, $curScope, $this);
                }
            }

            return $sReturn;
        }

    }
