<?php

$GLOBALS['TL_DCA']['tl_module']['palettes']['__selector__'][] = 'mycCompany';

$GLOBALS['TL_DCA']['tl_module']['palettes']['mycTeam'] = '{title_legend},name,headline,type;mycCompany,mycTeamMember,imgSize;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';

$GLOBALS['TL_DCA']['tl_module']['subpalettes']['mycCompany'] = 'mycTeamMember';

/*$GLOBALS['TL_DCA']['tl_module']['palettes']['boziPinboradByGroup'] = '{title_legend},name,headline,type;boziPinBoardGroup';
$GLOBALS['TL_DCA']['tl_module']['palettes']['boziCustomerList'] = '{title_legend},name,headline,type;imgSize';
$GLOBALS['TL_DCA']['tl_module']['palettes']['boziPinboardSortable'] = '{title_legend},name,headline,type;imgSize,boziPinBoardItems';*/

$fields = array
(
    'mycCompany' => array
    (
        'label'                   => &$GLOBALS['TL_LANG']['tl_content']['mycTeamMember'],
        'exclude'                 => true,
        'inputType'               => 'select',
        'options_callback'        => array('MycConfigModel', 'getAllCompanysAsArray'),
        'eval'                    => array('includeBlankOption'=>true, 'submitOnChange' => true),
        'sql'                     => "varchar(32) NOT NULL default ''"
    ),

    'mycTeamMember' => array
    (
        'label'                   => &$GLOBALS['TL_LANG']['tl_content']['mycTeamMember'],
        'exclude'                 => true,
        'inputType'               => 'checkboxWizard',
        'options_callback'        => array('tl_mycTeamMember', 'getTeamMembersByCompany'),
        'eval'                    => array('multiple'=>true),
        'sql'                     => "blob NULL"
    )

);

$GLOBALS['TL_DCA']['tl_module']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_module']['fields'], $fields);

class tl_mycTeamMember extends Backend
{
    public function getTeamMembersByCompany($dc)
    {
        $t = \MyCompany\TeamModel::getAllMemberByCompanyAsArray($dc->activeRecord->mycCompany);

        if(count($t) > 0) {
            return \MyCompany\TeamModel::getAllMemberByCompanyAsArray($dc->activeRecord->mycCompany);
        }

    }
}