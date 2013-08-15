<?php

namespace MyCompany\Helper;

use SW\SlashHelper;

class DataMaps extends \Frontend {

    /**
     * Generate the member data array
     * @param $member
     * @param $curCompany
     * @param array $imgSize
     * @return array
     */
    static public function memberData($member, $curCompany, $imgSize = array(), $scope)
    {
        //check and convert params if they are an array
        $memberObj = (is_array($member)) ? json_decode(json_encode($member), FALSE): $member;
        $companyObj = (is_array($curCompany)) ? json_decode(json_encode($curCompany), FALSE): $curCompany;

        // Add language vars
        $langArr = $GLOBALS['TL_LANG']['MSC']['boziFeatures'];
        $labels = array
        (
            'contactUs' => $langArr['contactUs']
        );

        //generate data array
        $data = array(
            'name' => $memberObj->surname.' '.$memberObj->lastname,
            'surname' => $memberObj->surname,
            'lastname' => $memberObj->lastname,
            'picture' => \Image::get(SlashHelper::getImagePath($memberObj->picture), $imgSize[0], $imgSize[1], $imgSize[2]),
            'mail' => \MyCompany\Helper\Text::generateMailAddress($memberObj->mailSuffix, $companyObj->companyDomain),
            'phone' => \MyCompany\Helper\Text::generatePhoneNumber($companyObj->phoneBasic, $memberObj->directDial),
            'about' => $memberObj->about,
            'mailSuffix' => $memberObj->mailSuffix,
            'directDial' => $memberObj->directDial,
            'label' => $labels
        );

        if (isset($GLOBALS['TL_HOOKS']['MyCompany']['addMemberData']) && is_array($GLOBALS['TL_HOOKS']['MyCompany']['addMemberData']))
        {
            foreach ($GLOBALS['TL_HOOKS']['MyCompany']['addMemberData'] as $callback)
            {
                $scope->import($callback[0]);
                $data = $scope->$callback[0]->$callback[1]($companyObj, $memberObj, $data);
            }
        }

        return $data;
    }
}