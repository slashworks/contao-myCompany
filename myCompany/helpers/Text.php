<?php

namespace MyCompany\Helper;

class Text extends \Controller
{
    public static function generateMailAddress($suffix, $domain)
    {
        return $suffix.'@'.$domain;
    }

    public static function generatePhoneNumber($prefix, $directDial)
    {
        return $prefix.'-'.$directDial;
    }
}