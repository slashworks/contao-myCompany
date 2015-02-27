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

    namespace MyCompany\CE;


    use MyCompany\CompanyModel;

    /**
     * Class StaticMap
     *
     * @package MyCompany\CE
     */
    class StaticMap extends CeMycWrapper
    {

        /**
         * @return array
         */
        public function setBackendTemplateData()
        {

            $curCompany = CompanyModel::getById($this->mycCompany);

            return array(
                'title'   => 'Google Maps static map',
                'content' => $curCompany->name
            );

        }


        /**
         * @return array
         */
        public function setTemplateData()
        {

            $curCompany = CompanyModel::getById($this->mycCompany);

            return array(
                'street'   => urlencode($curCompany['street']),
                'zip'      => urlencode($curCompany['zip']),
                'city'     => urlencode($curCompany['city']),
                'isStatic' => $this->mycTeamMapStatic
            );
        }
    }