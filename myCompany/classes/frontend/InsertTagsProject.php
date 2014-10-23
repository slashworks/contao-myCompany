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
            if (strpos($strTag, 'project_') != 0) {
                return false;
            }

            $sReturn = false;
            $curScope  = $this->getProject();


            /**
             * @TODO: IMPLEMENT INSERTTAGS HERE!
             */


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

    }
