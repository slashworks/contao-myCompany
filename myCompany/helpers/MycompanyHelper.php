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
     * @since       24.10.14 14:21
     * @package     Core
     *
     */


    namespace MyCompany\Helper;


    class MyCompanyHelper
    {


        /**
         * @param $el
         *
         * @return bool
         */
        public static function _parseTag($el)
        {

            $strip_prefix = substr($el, strpos($el, "_") + 1);
            $aTag         = explode("::", $strip_prefix);
            if (is_array($aTag)) {
                return array("ident" => $aTag[0], "item" => $aTag[1]);
            } else {
                return false;
            }
        }

    }