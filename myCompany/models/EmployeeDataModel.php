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
     * @package     MyCompany
     *
     */

    namespace MyCompany;


    /**
     * Class EmployeeDataModel
     *
     * @package MyCompany
     */
    class EmployeeDataModel extends MyCompanyModel
    {


        /**
         * Table name
         *
         * @var string
         */
        protected static $strTable = 'tl_mycEmployeeData';


        /**
         * @param      $employee_id
         * @param null $company
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


        public static function deleteById($id)
        {

            if (empty($id)) {
                return;
            }
            \Database::getInstance()->prepare('DELETE FROM tl_mycEmployeeData WHERE id = ?')->execute($id);
        }


        public static function deleteAllByArray($aDatas)
        {

            if (empty($aDatas)) {
                return;
            }

            foreach ($aDatas as $aData) {
                if (isset($aData['id'])) {
                    self::deleteById($aData['id']);
                }
            }
        }
    }