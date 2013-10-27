<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jrgregory
 * Date: 18.03.13
 * Time: 11:12
 * To change this template use File | Settings | File Templates.
 */

namespace MyCompany\CE;


use MyCompany\CompanysModel;
use MyCompany\TeamMembersModel;
use SW\SlashHelper;

class TeamMembers extends CeMycWrapper
{

    public function setBeTplArr()
    {

        return array
        (

            'title' => 'Team Member Liste',
            'content' => 'SHOW CHOSEN MEMBERS'

        );

    }

    public function setTplDataArr()
    {

        $teamMembers = deserialize($this->mycTeamMembers);
        $data = array();

        $imgSize = deserialize($this->size);

        foreach($teamMembers as $k => $v) {

            $teamMember = TeamMembersModel::getMemberById($v);
            $curCompany = CompanysModel::findByPk($teamMember->company);
            $data['members'][] = \MyCompany\Helper\DataMaps::memberData($teamMember, $curCompany, $imgSize, $this);
        }

        return $data;


    }

}