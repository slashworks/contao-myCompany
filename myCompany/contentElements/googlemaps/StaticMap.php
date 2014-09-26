<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jrgregory
 * Date: 18.03.13
 * Time: 11:12
 * To change this template use File | Settings | File Templates.
 */

namespace MyCompany\CE;


use MyCompany\CompanyModel;

class StaticMap extends CeMycWrapper
{

    public function setBeTplArr()
    {

        $curCompany = CompanyModel::getById($this->mycCompany);

        return array
        (

            'title' => 'Google Maps static map',
            'content' => $curCompany->name

        );

    }


    public function setTplDataArr()
    {

        $curCompany = CompanyModel::getById($this->mycCompany);

        return array
        (
            'street' => urlencode($curCompany['street']),
            'zip' => urlencode($curCompany['zip']),
            'city' => urlencode($curCompany['city']),
            'isStatic' => $this->mycTeamMapStatic
        );

    }
}