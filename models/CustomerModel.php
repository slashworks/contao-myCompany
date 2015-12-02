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
    class CustomerModel extends MyCompanyModel
    {

        /**
         * Table name
         *
         * @var string
         */
        protected static $strTable = 'tl_mycCustomers';


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


    }