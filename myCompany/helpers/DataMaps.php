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

    use Contao\FilesModel;
    use Contao\Image;
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
            $oCompany  = (is_array($aCompany)) ? json_decode(json_encode($aCompany), false) : $aCompany;

            if (!empty($oCompany->logo)) {
                $oLogo          = FilesModel::findByUuid($oCompany->logo);
                $sLogoPath      = $oLogo->path;
                $oCompany->logo = $sLogoPath;
            }

            $oCompany->optionals = deserialize($oCompany->optionals);
            $oCompany->positions = deserialize($oCompany->positions);
            $oCompany->socials   = deserialize($oCompany->socials);


            $aEmployeeData = EmployeeDataModel::getDataByEmployee($oEmployee->id, $oCompany->id);


            foreach ($aEmployeeData as $key => $data) {
                if (!empty($data['picture'])) {
                    $oPicture = FilesModel::findByUuid($data['picture']);
                    if (!empty($imgSize)) {
                        $sPicturePath = Image::get($oPicture->path, $imgSize[0], $imgSize[1], $imgSize[2]);
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
                'name'      => $oEmployee->surname . ' ' . $oEmployee->lastname,
                'surname'   => $oEmployee->surname,
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
    }