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
     * @since       26.09.14 16:15
     * @package     Core
     *
     */

    namespace MyCompany;


    /**
     * Class EmployeeDataModel
     *
     * @package MyCompany
     */
    class EmployeeDataModel extends \Model
    {


        /**
         * @param $id
         *
         * @return array
         */
        public static function getById($id)
        {

            $oResult = \Database::getInstance()->prepare('SELECT * FROM tl_mycEmployeeData WHERE id = ?')->execute($id);

            return $oResult->row();
        }


        /**
         * @param $employee_id
         *
         * @return array
         */
        public static function getDataByEmployee($employee_id, $company = null)
        {

            if ($company == null) {
                $oResult = \Database::getInstance()->prepare('SELECT * FROM tl_mycEmployeeData WHERE pid = ?')->execute($employee_id);
            } else {
                $oResult = \Database::getInstance()->prepare('SELECT * FROM tl_mycEmployeeData WHERE pid = ? AND company = ?')->execute($employee_id, $company);
            }

            $aResult = array();
            while ($oResult->next()) {
                $aResult[] = $oResult->row();
            }


            return $aResult;
        }


    }