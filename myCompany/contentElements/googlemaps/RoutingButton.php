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
     * Class RoutingButton
     *
     * @package MyCompany\CE
     */
    class RoutingButton extends CeMycWrapper
    {

        /**
         * @return array
         */
        public function setBeTplArr()
        {
            $curCompany = CompanyModel::getById($this->mycCompany);
            return array(
                'title'   => 'Google Maps Routing Button',
                'content' => $curCompany->name
            );
        }


        /**
         * @return array
         */
        public function setTplDataArr()
        {
            $curCompany = CompanyModel::getById($this->mycCompany);
            $addr = urlencode($curCompany['street'] . ' ' . $curCompany['plz'] . ' ' . $curCompany['city']);

            return array(
                'googleLink' => sprintf('https://maps.google.de/maps?f=d&source=s_d&saddr=&daddr=%s&hl=de&mra=ls', $addr),
                'linkLabel'  => $this->linkTitle
            );
        }
    }