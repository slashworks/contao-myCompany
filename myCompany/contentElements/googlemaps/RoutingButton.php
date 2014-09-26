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

class RoutingButton extends CeMycWrapper
{

    public function setBeTplArr()
    {
        $curCompany = CompanyModel::getById($this->mycCompany);

        return array
        (
            'title' => 'Google Maps Routing Button',
            'content' => $curCompany->name
        );
    }


    public function setTplDataArr()

    {

        $curCompany = CompanyModel::getById($this->mycCompany);

        $addr = urlencode($curCompany['street'].' '.$curCompany['plz'].' '.$curCompany['city']);

        return array
        (
            'googleLink' => sprintf('https://maps.google.de/maps?f=d&source=s_d&saddr=&daddr=%s&hl=de&mra=ls', $addr),
            'linkLabel' => $this->linkTitle
        );

    }

}