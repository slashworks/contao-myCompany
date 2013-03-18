<?php

namespace MyCompany\Helper;


class DataMaps extends \Frontend {

    /**
     * Generate the member data array
     * @param $member
     * @param $curCompany
     * @param array $imgSize
     * @return array
     */
    static public function memberData($member, $curCompany, $imgSize = array())
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
            'picture' => \Image::get(\CtoTplHelper::getImagePath($memberObj->picture), $imgSize[0], $imgSize[1], $imgSize[2]),
            'mail' => \MyCompany\Helper\Text::generateMailAddress($memberObj->mailSuffix, $companyObj->companyDomain),
            'phone' => \MyCompany\Helper\Text::generatePhoneNumber($companyObj->phoneBasic, $memberObj->directDial),
            'about' => $memberObj->about,
            'mailSuffix' => $memberObj->mailSuffix,
            'directDial' => $memberObj->directDial,
            'socialButtons' => static::generateSocialButtons($memberObj),
            'directDial' => $memberObj->directDial,
            'label' => $labels
            //TODO Adding: positions, qualifications
        );

        return $data;
    }

    /**
     * Generates socialButton array
     * @param $obj
     * @return array
     */
    static public function generateSocialButtons($obj)
    {
        // List with allowed networks including the url to a single user profile
        $socials = array
        (
            'xing' => 'https://www.xing.com/profile/',
            'twitter' => 'https://www.twitter.com//',
            'facebook' => 'https://www.facebook.com/'
        );

        $dataArr = array();

        //check if the user has any accounts and if true add them to array
        foreach($socials as $k => $v)
        {
            if($obj->$k)
            {
                // Add the details
                $dataArr[$k] = static::generateSocialSet($v.$obj->$k, $k);
            }

        }

        return $dataArr;
    }

    /**
     * Generates the basic informations for each social link
     * @param $link
     * @param $type
     * @return array
     */
    static private function generateSocialSet($link, $type)
    {
        return array
        (
            'url' => $link,
            'title' => &$GLOBALS['TL_LANG']['MSC']['MyCompany']['socialButtons'][$type]['title'],
            'class' => 'buttons social '.$type,
            'label' => &$GLOBALS['TL_LANG']['MSC']['MyCompany']['socialButtons'][$type]['label']
        );
    }
}