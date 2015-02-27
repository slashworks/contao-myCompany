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
        protected static $instances = array();


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
         * @param $ident
         *
         * @return array
         */
        public static function getInstance($ident = null)
        {

            $sCalledClassname = get_called_class();
            if ($ident === null) {
                if (!isset(self::$instances[$sCalledClassname]['direct'])) {
                    self::$instances[$sCalledClassname]['direct'] = new $sCalledClassname();
                }

                return self::$instances[$sCalledClassname]['direct'];
            }


            if (!isset(self::$instances[$sCalledClassname])) {
                self::$instances[$sCalledClassname] = array();
            }

            if (array_key_exists($ident, self::$instances[$sCalledClassname]) && !empty(self::$instances[$sCalledClassname][$ident])) {
                return self::$instances[$sCalledClassname][$ident];
            } else {
                if (is_numeric($ident)) {
                    self::$instances[$sCalledClassname][$ident] = self::getById($ident, true);

                    return self::$instances[$sCalledClassname][$ident];
                } elseif (is_string($ident)) {
                    self::$instances[$sCalledClassname][$ident] = self::getByShorthandle($ident, true);

                    return self::$instances[$sCalledClassname][$ident];
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

            if (!is_array($aReturn)) {
                $aReturn = array();
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
         * @param $pid
         *
         * @return array
         */
        public static function getByPid($pid)
        {

            $oResult = \Database::getInstance()->prepare('SELECT * FROM ' . static::$strTable . ' WHERE pid = ?')->execute($pid);
            $aReturn = $oResult->fetchAllAssoc();

            // HOOK
            if (isset($GLOBALS['TL_HOOKS']['mycGetByPid']) && is_array($GLOBALS['TL_HOOKS']['mycGetByPid'])) {
                foreach ($GLOBALS['TL_HOOKS']['mycGetByPid'] as $callback) {
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