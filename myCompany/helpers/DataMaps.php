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

    use MyCompany\EmployeeDataModel;

    /**
     * Class DataMaps
     *
     * @package MyCompany\Helper
     */
    class DataMaps extends \Frontend
    {

        /**
         * Generate the member data array
         *
         * @param       $aEmployee
         * @param       $aCompany
         * @param array $imgSize
         *
         * @return array
         */
        static public function getEmployeeData($aEmployee, $aCompany, $imgSize = array(), $scope)
        {

            //check and convert params if they are an array
            $oEmployee = (is_array($aEmployee)) ? json_decode(json_encode($aEmployee), false) : $aEmployee;
            $aCompany  = self::getCompanyData($aCompany, array(), $scope);
            $oCompany  = (is_array($aCompany)) ? json_decode(json_encode($aCompany), false) : $aCompany;

            $aEmployeeData = EmployeeDataModel::getDataByEmployee($oEmployee->id, $oCompany->id);


            foreach ($aEmployeeData as $key => $data) {
                if (!empty($data['picture'])) {
                    $oPicture = \FilesModel::findByUuid($data['picture']);
                    if (!empty($imgSize)) {
                        $sPicturePath = \Image::get($oPicture->path, $imgSize[0], $imgSize[1], $imgSize[2]);
                    } else {
                        $sPicturePath = $oPicture->path;
                    }
                    $aEmployeeData[$key]['picture'] = $sPicturePath;
                }
                if ($data['company'] == $oCompany->id) {
                    $aEmployeeData[$key]['company'] = $oCompany;
                }
                $aEmployeeData[$key]['socials'] = deserialize($aEmployeeData[$key]['socials']);
            }

            // Add language vars
            $socialLinksArr = deserialize($oEmployee->socials);

            for ($i = 0; $i < count($socialLinksArr); $i++) {
                $socialLinksArr[$i]['cssClass'] = 'myc_social_' . standardize($socialLinksArr[$i]['name']);
            }

            //generate data array
            $data = array(
                'gender'    => $oEmployee->gender,
                'title'     => $oEmployee->title,
                'name'      => $oEmployee->firstname . ' ' . $oEmployee->lastname,
                'firstname'   => $oEmployee->firstname,
                'lastname'  => $oEmployee->lastname,
                'positions' => $aEmployeeData
            );

            if (isset($GLOBALS['TL_HOOKS']['MyCompany']['modifyEmployeeData']) && is_array($GLOBALS['TL_HOOKS']['MyCompany']['addMemberData'])) {
                foreach ($GLOBALS['TL_HOOKS']['MyCompany']['modifyEmployeeData'] as $callback) {
                    $scope->import($callback[0]);
                    $data = $scope->$callback[0]->$callback[1]($oCompany, $oEmployee, $data);
                }
            }


            return $data;
        }


        /**
         * @param $aCompany
         * @param $scope
         *
         * @return array
         */
        public static function getCompanyData($aCompany, $imgSize = array(), $scope)
        {

            if (empty($aCompany) || !is_array($aCompany)) {
                return array();
            }


            if (!empty($aCompany['logo'])) {
                $oLogo     = \FilesModel::findByUuid($aCompany['logo']);
                $sLogoPath = $oLogo->path;
                if (!empty($imgSize)) {
                    $sLogoPath = \Image::get($sLogoPath, $imgSize[0], $imgSize[1], $imgSize[2]);
                }
                $aCompany['logo'] = $sLogoPath;
            }

            $aCompany['optionals']           = deserialize($aCompany['optionals']);
            $aCompany['positions']           = deserialize($aCompany['positions']);
            $aCompany['socials']             = deserialize($aCompany['socials']);
            $aCompany['mycAddressBlockRows'] = deserialize($aCompany['mycAddressBlockRows']);


            if (isset($GLOBALS['TL_HOOKS']['MyCompany']['modifyCompanyData']) && is_array($GLOBALS['TL_HOOKS']['MyCompany']['modifyCompanyData'])) {
                foreach ($GLOBALS['TL_HOOKS']['MyCompany']['modifyCompanyData'] as $callback) {
                    $scope->import($callback[0]);
                    $data = $scope->$callback[0]->$callback[1]($aCompany);
                }
            }



            return $aCompany;
        }
    }