<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jrgregory
 * Date: 18.03.13
 * Time: 11:12
 * To change this template use File | Settings | File Templates.
 */

namespace MyCompany\CE;


class TeamMember extends CeMycWrapper
{

    public function setBeTplArr()
    {

        $teamMember = \MyCompany\TeamMembersModel::getMemberById($this->mycTeamMember);
        $teamMemberName = $teamMember->surname.' '.$teamMember->lastname;

        return array
        (

            'title' => 'Team Member',
            'content' => $teamMemberName

        );

    }


    public function setTplDataArr()
    {

        $teamMember = \MyCompany\TeamMembersModel::getMemberById($this->mycTeamMember);
        $curCompany = \MyCompany\CompanysModel::findByPk($this->mycCompany);
        $imgSize = deserialize($this->size);

        return \MyCompany\Helper\DataMaps::memberData($teamMember, $curCompany, $imgSize, $this);

    }

}