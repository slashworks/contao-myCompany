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
     * @since       22.10.14 15:58
     * @package     MyCompany
     *
     */


    namespace MyCompany;


    /**
     * Class Employee
     *
     * @package MyCompany
     */
    class Company extends \Backend
    {

        /**
         * @param $aData
         * @param $sLabel
         * @param $oDca
         *
         * @return string
         */
        public function getListLabel($aData, $sLabel, $oDca)
        {

            $sLabel = "";
            $aLogo  = \FilesModel::findByUuid($aData['logo']);
            $path   = \Image::get($aLogo->path, 48, 48, "proportional");
            $sLabel .= <<<LABEL
            <div style="height:31px;float:left;width:56px;padding:0 10px 10px 10px;vertical-align:middle;display:inline-block;text-align:center;">
                <div style="display:inline-block;height:100%;"></div><img src="{$path}" style="display:inline-block;vertical-align:middle;">
            </div>
            <div style="height:31px;padding-top:20px;">
                <strong>{$aData["name"]} {$aData["legalForm"]}</strong>
            </div>
LABEL;

            return $sLabel;
        }
    }