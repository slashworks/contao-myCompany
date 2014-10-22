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
     * @since       26.09.14 17:26
     * @package     Core
     *
     */

    namespace MyCompany;

    /**
     * Class ProjectModel
     *
     * @package MyCompany
     */
    class ProjectModel extends \Model
    {

        /**
         * @param $id
         *
         * @return array
         */
        public function getById($id)
        {

            $oResult = \Database::getInstance()->prepare('SELECT * FROM tl_mycProjects WHERE id = ?')->execute($id);

            $aReturn = $oResult->row();

            // HOOK
            if (isset($GLOBALS['TL_HOOKS']['mycProjectGetById']) && is_array($GLOBALS['TL_HOOKS']['mycProjectGetById']))
            {
                foreach ($GLOBALS['TL_HOOKS']['mycProjectGetById'] as $callback)
                {
                    $this->import($callback[0]);
                    $this->$callback[0]->$callback[1]($aReturn, $this);
                }
            }

            return $aReturn;
        }


        /**
         * @param $company_id
         *
         * @return array
         */
        public function getByCompany($company_id)
        {

            $oResult = \Database::getInstance()->prepare('SELECT * FROM tl_mycProjects WHERE company = ?')->execute($company_id);

            $aReturn = $oResult->row();

            // HOOK
            if (isset($GLOBALS['TL_HOOKS']['mycProjectGetByCompany']) && is_array($GLOBALS['TL_HOOKS']['mycProjectGetByCompany']))
            {
                foreach ($GLOBALS['TL_HOOKS']['mycProjectGetByCompany'] as $callback)
                {
                    $this->import($callback[0]);
                    $this->$callback[0]->$callback[1]($aReturn, $this);
                }
            }

            return $aReturn;
        }


        /**
         * @param $customer_id
         *
         * @return array
         */
        public function getByCustomer($customer_id)
        {

            $oResult = \Database::getInstance()->prepare('SELECT * FROM tl_mycProjects WHERE customer = ?')->execute($customer_id);

            $aReturn = $oResult->row();

            // HOOK
            if (isset($GLOBALS['TL_HOOKS']['mycProjectGetByCustomer']) && is_array($GLOBALS['TL_HOOKS']['mycProjectGetByCustomer']))
            {
                foreach ($GLOBALS['TL_HOOKS']['mycProjectGetByCustomer'] as $callback)
                {
                    $this->import($callback[0]);
                    $this->$callback[0]->$callback[1]($aReturn, $this);
                }
            }

            return $aReturn;
        }


        /**
         * @param $customer_id
         * @param $company_id
         *
         * @return array
         */
        public function getByCustomerAndCompany($customer_id, $company_id)
        {

            $oResult = \Database::getInstance()->prepare('SELECT * FROM tl_mycProjects WHERE customer = ? AND company = ?')->execute($customer_id, $company_id);

            $aReturn = $oResult->row();

            // HOOK
            if (isset($GLOBALS['TL_HOOKS']['mycProjectGetByCustomerAndCompany']) && is_array($GLOBALS['TL_HOOKS']['mycProjectGetByCustomerAndCompany']))
            {
                foreach ($GLOBALS['TL_HOOKS']['mycProjectGetByCustomerAndCompany'] as $callback)
                {
                    $this->import($callback[0]);
                    $this->$callback[0]->$callback[1]($aReturn, $this);
                }
            }

            return $aReturn;
        }


    }