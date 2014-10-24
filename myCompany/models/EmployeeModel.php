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
     * @since       25.09.14 14:41
     * @package     Core
     *
     */
    namespace MyCompany;

    /**
     * Class EmployeeModel
     *
     * @package MyCompany
     */
    class EmployeeModel extends MyCompanyModel
    {

        /**
         * Table name
         *
         * @var string
         */
        protected static $strTable = 'tl_mycEmployee';


        /**
         * @param $id
         *
         * @return array
         */
        public static function getInstance($ident)
        {

            if (is_numeric($ident)) {
                return parent::getInstance($ident);
            } else {
                $aEmployeeData     = EmployeeDataModel::getInstance($ident);
                $aEmployee         = parent::getInstance($aEmployeeData['pid']);
                $aEmployee['data'] = $aEmployeeData;

                return $aEmployee;
            }
        }


        /**
         * @return array
         */
        public static function getAllEmployeeAsArray()
        {

            $oEmployeeResult = \Database::getInstance()->execute('SELECT id,surname,lastname FROM tl_mycEmployee');

            $data = array();

            while ($oEmployeeResult->next()) {
                $data[$oEmployeeResult->id] = $oEmployeeResult->surname . ' ' . $oEmployeeResult->lastname;
            }

            return $data;
        }


        /**
         * @param $id
         *
         * @return array
         */
        public static function getAllEmployeeByCompanyAsArray($id)
        {

            $oEmployeeResult = \Database::getInstance()->prepare("SELECT e.id, e.title, e.gender, e.surname, e.lastname ,d.id as data_id,d.pid as employee_id, d.company, d.position, d.shorthandle, d.picture, d.about, d.email, d.mobile, d.socials, d.detailPage, d.phoneExt, d.faxExt,c.name as company_name, c.legalForm as company_legalForm, c.shorthandle as company_shorthandle, c.street as company_street, c.zip as company_zip, c.city as company_city, c.country as cmpany_country, c.logo as company_logo, c.phoneBasic as company_phoneBasic, c.phoneDirectDial as company_phoneDirectDial, c.faxBasic as company_faxBasic, c.faxDirectDial as company_faxDirectDial, c.domain as company_domain, c.email as company_email, c.socials as company_socials, c.optionals as company_optionals, c.positions as company_positions FROM tl_mycEmployee e, tl_mycEmployeeData d, tl_mycCompanies c WHERE d.company = ? AND d.pid = e.id AND c.id = d.company")->execute($id);
            $data            = array();
            while ($oEmployeeResult->next()) {
                $data[$oEmployeeResult->id] = $oEmployeeResult->surname . ' ' . $oEmployeeResult->lastname;
            }

            return $data;

        }


        /**
         * @param $aEmployeeIds
         *
         * @return array
         */
        public static function findEmployeesByIdAsArray($aEmployeeIds)
        {

            if (is_array($aEmployeeIds)) {
                $sEmployeeIds    = implode($aEmployeeIds, ',');
                $oEmployeeResult = \Database::getInstance()->prepare("SELECT * FROM tl_mycEmployee WHERE id IN(" . $sEmployeeIds . ") ORDER BY FIELD(id," . $sEmployeeIds . ")")->execute();

                $data = array();

                while ($oEmployeeResult->next()) {
                    $data[] = $oEmployeeResult->row();
                }

                return $data;
            }

            return array();
        }


        /**
         * @param $shorthandle
         *
         * @return array
         */
        public static function getAllShorthandlesAsArray($shorthandle)
        {

            $oEmployeeResult = \Database::getInstance()->prepare("SELECT * from tl_mycEmployee e, tl_mycEmployeeData d WHERE e.id = d.pid AND d.shorthandle = ?")->execute($shorthandle);

            return $oEmployeeResult->row();
        }
    }