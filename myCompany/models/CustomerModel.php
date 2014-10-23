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
     * Class CustomerModel
     *
     * @package MyCompany
     */
    class CustomerModel extends \Model
    {

        /**
         * @param $id
         *
         * @return array
         */
        public function getById($id)
        {

            $oResult = \Database::getInstance()->prepare('SELECT * FROM tl_mycCustomers WHERE id = ?')->execute($id);

            return $oResult->row();
        }


        /**
         * @param $company_id
         *
         * @return array
         */
        public function getByCompany($company_id)
        {

            $oResult = \Database::getInstance()->prepare('SELECT * FROM tl_mycCustomers WHERE company = ?')->execute($company_id);

            return $oResult->row();
        }

        /**
         * @param $shorthandle
         *
         * @return array
         */
        public static function getAllShorthandlesAsArray($shorthandle)
        {

            $oCustomer = \Database::getInstance()->prepare("SELECT * from tl_mycCustomers WHERE shorthandle = ?")->execute($shorthandle);
            $aReturn = $oCustomer->row();

            // HOOK
            if (isset($GLOBALS['TL_HOOKS']['mycCustomerGetAllShorthandlesAsArray']) && is_array($GLOBALS['TL_HOOKS']['mycCustomerGetAllShorthandlesAsArray']))
            {
                foreach ($GLOBALS['TL_HOOKS']['mycCustomerGetAllShorthandlesAsArray'] as $callback)
                {
                    \System::importStatic($callback[0]);
                    $callback[0]::$callback[1]($aReturn, $shorthandle);
                }
            }


            return $aReturn;
        }

    }