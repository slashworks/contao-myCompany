<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jrgregory
 * Date: 18.03.13
 * Time: 11:12
 * To change this template use File | Settings | File Templates.
 */

namespace MyCompany\CE;


class TeamMember extends \ContentElement
{
    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'ce_myc_teamMember';

    public function compile()
    {
        $teamMember = \MyCompany\TeamModel::getMemberById($this->mycTeamMember);
        $curCompany = \MycConfigModel::findByPk($teamMember->company);
        $imgSize = deserialize($this->size);

        $teamMemberName = $teamMember->surname.' '.$teamMember->lastname;

        if (TL_MODE == 'BE')
        {
            $this->Template = \CtoTplHelper::generateWildCardTpl('Team Member', $teamMemberName);
        } else {
            $data = \MyCompany\Helper\DataMaps::memberData($teamMember, $curCompany, $imgSize);
            $this->Template->setData($data);
        }

    }
}