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

        $teamMemberData = \MycTeamModel::findMembersByIdAsArray($member);
        $curCompany = \MycConfigModel::findByPk($this->mycCompany);

        $membersArr = array();

        foreach($teamMemberData as $member)
        {
            $membersArr[] = array
            (
                'name' => $member['surname'].' '.$member['lastname'],
                'surname' => $member['surname'],
                'lastname' => $member['lastname'],
                'picture' => \Image::get(CtoTplHelper::getImagePath($member['picture']), $imgSize[0], $imgSize[1], $imgSize[2]),
                'mail' => \MyCompany\Text::generateMailAddress($member['mailSuffix'], $curCompany->companyDomain),
                'phone' => \MyCompany\Text::generatePhoneNumber($curCompany->phoneBasic, $member['directDial']),
                'about' => $member['about'],
                'mailSuffix' => $member['mailSuffix'],
                'directDial' => $member['directDial'],
                //TODO Adding: positions, qualifications, twitter, xing and facebook
            );
        }

        $this->Template->members = $membersArr;
        $this->Template->company = $curCompany;

    }

}
