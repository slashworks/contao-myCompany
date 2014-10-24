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
     * @since       24.10.14 13:26
     * @package     Mycompany
     *
     */


    namespace MyCompany;

    /**
     * Class ProjectModel
     *
     * @package MyCompany
     */
    class MyCompanyModel extends \Model
    {

        /**
         * @var array
         */
        private static $instances = array();


        public static function getField($ident, $item)
        {

            $sClass    = get_called_class();
            $aEmployee = $sClass::getInstance($ident);
            if (isset($aEmployee[$item])) {
                return $aEmployee[$item];
            } else {
                return false;
            }
        }


        /**
         * @param $id
         *
         * @return array
         */
        public static function getInstance($ident)
        {

            $key = get_called_class();
            if (!isset(self::$instances[$key])) {
                self::$instances[$key] = array();
            }

            if (array_key_exists($ident, self::$instances[$key]) && !empty(self::$instances[$key][$ident])) {
                return self::$instances[$key][$ident];
            } else {
                if (is_numeric($ident)) {
                    self::$instances[$key][$ident] = self::getById($ident, true);

                    return self::$instances[$key][$ident];
                } elseif (is_string($ident)) {
                    self::$instances[$key][$ident] = self::getByShorthandle($ident, true);

                    return self::$instances[$key][$ident];
                }

                return array();
            }
        }


        /**
         * @param $id
         *
         * @return array
         */
        public static function getById($id, $force = false)
        {

            $aReturn = ($force === false) ? self::getInstance($id) : array();
            if (empty($aReturn)) {
                $oResult = \Database::getInstance()->prepare('SELECT * FROM ' . static::$strTable . ' WHERE id = ?')->execute($id);
                $aReturn = $oResult->row();
            }

            // HOOK
            if (isset($GLOBALS['TL_HOOKS']['mycGetById']) && is_array($GLOBALS['TL_HOOKS']['mycGetById'])) {
                foreach ($GLOBALS['TL_HOOKS']['mycGetById'] as $callback) {
                    \System::importStatic($callback[0]);
                    $callback[0]::$callback[1]($aReturn, static::$strTable);
                }
            }

            return $aReturn;
        }


        /**
         * @param $shorthandle
         *
         * @return array
         */
        public static function getByShorthandle($shorthandle, $force = false)
        {

            $aReturn = ($force === false) ? self::getInstance($shorthandle) : array();
            if (empty($aReturn)) {
                $oCompany = \Database::getInstance()->prepare("SELECT * from " . static::$strTable . " WHERE shorthandle = ?")->execute($shorthandle);
                $aReturn  = $oCompany->row();
            }

            // HOOK
            if (isset($GLOBALS['TL_HOOKS']['mycGetByShorthandle']) && is_array($GLOBALS['TL_HOOKS']['mycGetByShorthandle'])) {
                foreach ($GLOBALS['TL_HOOKS']['mycGetByShorthandle'] as $callback) {
                    \System::importStatic($callback[0]);
                    $callback[0]::$callback[1]($aReturn, $shorthandle, static::$strTable);
                }
            }


            return $aReturn;
        }


    }