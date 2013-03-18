<?php

namespace Contao;

class MycTeamModule extends \Module
{
    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'myc_team_list';

    /**
     * No markup
     * @var boolean
     */
    protected $blnNoMarkup = false;



    /**
     * Generate the module
     */
    protected function compile()
    {
        global $objPage;

        $member = deserialize($this->mycTeamMember);
        $imgSize = deserialize($this->imgSize);

        $teamMemberData = \MyCompany\TeamModel::findMembersByIdAsArray($member);
        $curCompany = \MycConfigModel::findByPk($this->mycCompany);

        $membersArr = array();

        foreach($teamMemberData as $member)
        {
            $membersArr[] = \MyCompany\Helper\DataMaps::memberData($member, $curCompany, $imgSize);
        }

        $this->Template->members = $membersArr;
        $this->Template->company = $curCompany;

    }

}
