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
     * Class CompanyModel
     *
     * @package MyCompany
     */
    /**
     * Class CompanyModel
     *
     * @package MyCompany
     */
    class CompanyModel extends \Model
    {

        /**
         * Table name
         *
         * @var string
         */
        protected static $strTable = 'tl_mycCompanies';


        /**
         * @param $id
         *
         * @return array
         */
        public static function getById($id)
        {

            $oCompanyResult = \Database::getInstance()->execute('SELECT * FROM tl_mycCompanies WHERE id = "' . $id . '"');

            return $oCompanyResult->row();
        }


        /**
         * @return array
         */
        public static function getAllCompaniesAsArray()
        {

            $oCompany = \Database::getInstance()->execute('SELECT id,name FROM tl_mycCompanies');

            $data = array();

            while ($oCompany->next()) {
                $data[$oCompany->id] = $oCompany->name;
            }

            return $data;
        }


        /**
         * @return array|mixed
         */
        public static function getAllPositionsAsArray()
        {

            // select company id from active member
            $oCompany = \Database::getInstance()->prepare('SELECT company FROM tl_mycEmployee WHERE id=?')->execute(\Input::get('id'));
            $companyId = false;
            while ($oCompany->next()) {
                $companyId = $oCompany->company;
            }

            // if member has no company (e. g. when creating a new member), get first company id
            if (!$companyId) {
                $objCompanyId = \Database::getInstance()->execute('SELECT id FROM tl_mycCompanies LIMIT 1');
                while ($objCompanyId->next()) {
                    $companyId = $objCompanyId->id;
                }
            }

            // get all positions from the company
            $objPositions = \Database::getInstance()->prepare('SELECT positions FROM tl_mycCompanies WHERE id=?')->execute($companyId);
            $arrPositions = array();

            while ($objPositions->next()) {
                $arrPositions = deserialize($objPositions->positions);
            }

            return $arrPositions;
        }


        /**
         * @param $shorthandle
         *
         * @return array
         */
        public static function getAllShorthandlesAsArray($shorthandle)
        {

            $oCompany = \Database::getInstance()->prepare("SELECT * from tl_mycCompanies WHERE shorthandle = ?")->execute($shorthandle);

            return $oCompany->row();
        }


        /**
         * @param $id
         *
         * @return mixed
         */
        public static function getSocialLinksAsArray($id)
        {

            $oCompany = \Database::getInstance()->prepare("SELECT socials from tl_mycCompanies WHERE id = ?")->execute($id);

            return deserialize($oCompany->socials);
        }

    }