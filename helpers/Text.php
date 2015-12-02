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

    namespace MyCompany\Helper;

    /**
     * Helper for some Text basics. standarize things like mails or phone numbers
     *
     * @package MyCompany\Helper
     */
    class Text extends \Controller
    {

        /**
         * Generates a E-Mail address
         *
         * @param $suffix
         * @param $domain
         *
         * @return string
         */
        public static function generateMailAddress($suffix, $domain)
        {

            return $suffix . '@' . $domain;
        }


        /**
         * generates a phone number
         *
         * @param $prefix
         * @param $directDial
         *
         * @return string
         */
        public static function formatPhoneNumber($prefix, $directDial)
        {

            return $prefix . ' - ' . $directDial;
        }
    }