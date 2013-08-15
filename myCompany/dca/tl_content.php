<?php

$GLOBALS['TL_DCA']['tl_content']['palettes']['mycTeamMember'] = '{type_legend},type,mycCompany,mycTeamMember;{image_legend},size;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space;{invisible_legend:hide},invisible,start,stop';

$fields = array
(
    'mycCompany' => array
    (
        'label'                   => &$GLOBALS['TL_LANG']['tl_content']['mycCompany'],
        'exclude'                 => true,
        'filter'                  => true,
        'inputType'               => 'select',
        'options_callback'        => array('\MyCompany\CompanysModel', 'getAllCompaniesAsArray'),
        'eval'                    => array('chosen'=>true, 'submitOnChange'=>true, 'includeBlankOption'=>true),
        'sql'                     => "varchar(32) NOT NULL default ''"
    ),

    'mycTeamMember' => array
    (
        'label'                   => &$GLOBALS['TL_LANG']['tl_content']['mycTeamMember'],
        'exclude'                 => true,
        'filter'                  => true,
        'inputType'               => 'select',
        'options_callback'        => array('myCompany_tl_content', 'getMemberByCompany'),
        'eval'                    => array('chosen'=>true, 'submitOnChange'=>true, 'includeBlankOption'=>true),
        'sql'                     => "varchar(32) NOT NULL default ''"
    )
);

$GLOBALS['TL_DCA']['tl_content']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_content']['fields'], $fields);

class myCompany_tl_content extends Backend {

    public function getMemberByCompany($dc) {
        return \MyCompany\TeamMembersModel::getAllMemberByCompanyAsArray($dc->activeRecord->mycCompany);
    }

}