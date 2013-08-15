<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jrgregory
 * Date: 18.03.13
 * Time: 11:12
 * To change this template use File | Settings | File Templates.
 */

namespace MyCompany\CE;


use SW\SlashHelper;

class TeamMember extends \ContentElement
{
    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'ce_myc_teamMember';

    public function compile()
    {
        $teamMember = \MyCompany\TeamMembersModel::getMemberById($this->mycTeamMember);
        $curCompany = \MyCompany\CompanysModel::findByPk($this->mycCompany);
        $imgSize = deserialize($this->size);

        $teamMemberName = $teamMember->surname.' '.$teamMember->lastname;

        if (TL_MODE == 'BE')
        {
            $this->Template = SlashHelper::generateWildCardTpl('Team Member', $teamMemberName);
        }
        else
        {
            $data = \MyCompany\Helper\DataMaps::memberData($teamMember, $curCompany, $imgSize, $this);
            $this->Template->setData($data);
        }

    }
}