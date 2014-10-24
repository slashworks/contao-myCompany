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
    class CompanyModel extends MyCompanyModel
    {

        /**
         * Table name
         *
         * @var string
         */
        protected static $strTable = 'tl_mycCompanies';



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

            // HOOK
            if (isset($GLOBALS['TL_HOOKS']['mycCompanyGetAllCompaniesAsArray']) && is_array($GLOBALS['TL_HOOKS']['mycCompanyGetAllCompaniesAsArray']))
            {
                foreach ($GLOBALS['TL_HOOKS']['mycCompanyGetAllCompaniesAsArray'] as $callback)
                {
                    \System::importStatic($callback[0]);
                    $callback[0]::$callback[1]($data, $oCompany);
                }
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

            // HOOK
            if (isset($GLOBALS['TL_HOOKS']['mycCompanyGetAllPositionsAsArray']) && is_array($GLOBALS['TL_HOOKS']['mycCompanyGetAllPositionsAsArray']))
            {
                foreach ($GLOBALS['TL_HOOKS']['mycCompanyGetAllPositionsAsArray'] as $callback)
                {
                    \System::importStatic($callback[0]);
                    $callback[0]::$callback[1]($arrPositions, $objPositions, $objCompanyId, $oCompany);
                }
            }

            return $arrPositions;
        }



        /**
         * @param $shorthandle
         *
         * @return array
         */
        public static function getByShorthandle($shorthandle, $force = false)
        {

            $aReturn = ($force === false)?self::getInstance($shorthandle):array();
            if(empty($aReturn)) {

                $oCompany = \Database::getInstance()->prepare("SELECT * from " . static::$strTable . " WHERE shorthandle = ?")->execute($shorthandle);
                $aReturn  = $oCompany->row();
            }

            // HOOK
            if (isset($GLOBALS['TL_HOOKS']['mycGetByShorthandle']) && is_array($GLOBALS['TL_HOOKS']['mycGetByShorthandle']))
            {
                foreach ($GLOBALS['TL_HOOKS']['mycGetByShorthandle'] as $callback)
                {
                    \System::importStatic($callback[0]);
                    $callback[0]::$callback[1]($aReturn, $shorthandle, static::$strTable);
                }
            }


            return $aReturn;
        }



        /**
         * @param $id
         *
         * @return mixed
         */
        public static function getSocialLinksAsArray($id)
        {

            $oCompany = \Database::getInstance()->prepare("SELECT socials from tl_mycCompanies WHERE id = ?")->execute($id);
            $aReturn = deserialize($oCompany->socials);


            // HOOK
            if (isset($GLOBALS['TL_HOOKS']['mycCompanyGetSocialLinksAsArray']) && is_array($GLOBALS['TL_HOOKS']['mycCompanyGetSocialLinksAsArray']))
            {
                foreach ($GLOBALS['TL_HOOKS']['mycCompanyGetSocialLinksAsArray'] as $callback)
                {
                    \System::importStatic($callback[0]);
                    $callback[0]::$callback[1]($aReturn, $oCompany);
                }
            }


            return $aReturn;
        }

    }