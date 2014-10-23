<?php

    namespace MyCompany\Helper;

    /**
     * Helper for some Text basics. standarize things like mails or phone numbers
     * @package MyCompany\Helper
     */
    class Text extends \Controller
    {
        /**
         * Generates a E-Mail address
         * @param $suffix
         * @param $domain
         * @return string
         */
        public static function generateMailAddress($suffix, $domain)
        {
            return $suffix.'@'.$domain;
        }

        /**
         * generates a phone number
         * @param $prefix
         * @param $directDial
         * @return string
         */
        public static function formatPhoneNumber($prefix, $directDial)
        {
            return $prefix.' - '.$directDial;
        }
    }