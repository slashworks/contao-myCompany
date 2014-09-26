<?php

    namespace MyCompany\Helper;

    use MyCompany\EmployeeDataModel;

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

            $aEmployeeData = EmployeeDataModel::getDataByEmployee($oEmployee->id, $oCompany->id);


            // Add language vars
            $socialLinksArr = deserialize($oEmployee->socials);

            for ($i = 0; $i < count($socialLinksArr); $i++) {
                $socialLinksArr[$i]['cssClass'] = 'myc_social_' . standardize($socialLinksArr[$i]['name']);
            }

            //generate data array
            $data = array(
                'name'      => $oEmployee->surname . ' ' . $oEmployee->lastname,
                'surname'   => $oEmployee->surname,
                'lastname'  => $oEmployee->lastname,
                'label'     => $GLOBALS['TL_LANG']['MSC']['MyCompany'],
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