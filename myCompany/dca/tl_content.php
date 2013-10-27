<?php

$GLOBALS['TL_DCA']['tl_content']['palettes']['mycTeamMember'] = '{type_legend},type,mycCompany,mycTeamMember;{image_legend},size;{protected_legend:hide},protected;{expert_legend:hide},mycTemplate,guests,cssID,space;{invisible_legend:hide},invisible,start,stop';
$GLOBALS['TL_DCA']['tl_content']['palettes']['mycTeamMembers'] = '{type_legend},type,mycTeamMembers;{image_legend},size;{protected_legend:hide},protected;{expert_legend:hide},mycTemplate,guests,cssID,space;{invisible_legend:hide},invisible,start,stop';
$GLOBALS['TL_DCA']['tl_content']['palettes']['mycTeamMembers'] = '{type_legend},type,mycTeamMembers;{image_legend},size;{protected_legend:hide},protected;{expert_legend:hide},mycTemplate,guests,cssID,space;{invisible_legend:hide},invisible,start,stop';
$GLOBALS['TL_DCA']['tl_content']['palettes']['mycRoutingButton'] = '{type_legend},type,mycCompany,linkTitle;{protected_legend:hide},protected;{expert_legend:hide},mycTemplate,guests,cssID,space;{invisible_legend:hide},invisible,start,stop';
$GLOBALS['TL_DCA']['tl_content']['palettes']['mycStaticMap'] = '{type_legend},type,mycCompany,size;{protected_legend:hide},protected;{expert_legend:hide},mycTemplate,guests,cssID,space;{invisible_legend:hide},invisible,start,stop';


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
    ),

    'mycTeamMembers' => array
    (
        'label'                   => &$GLOBALS['TL_LANG']['tl_content']['mycTeamMembers'],
        'exclude'                 => true,
        'filter'                  => true,
        'inputType'               => 'checkboxWizard',
        'options_callback'        => array('\MyCompany\TeamMembersModel', 'getAllMemberAsArray'),
        'eval'                    => array('multiple'=>true, 'helpwizard'=>true),
        'sql'                     => "blob NULL"
    ),

    'mycTeamMemberTemplate' => array
    (
        'label'                   => &$GLOBALS['TL_LANG']['tl_content']['mycTeamMember'],
        'exclude'                 => true,
        'filter'                  => true,
        'inputType'               => 'select',
        'options_callback'        => array('myCompany_tl_content', 'getMembersTemplates'),
        'eval'                    => array('chosen'=>true),
        'sql'                     => "varchar(64) NOT NULL default ''"
    ),

    'mycTemplate' => array
    (
        'label'                   => &$GLOBALS['TL_LANG']['tl_content']['mycTemplate'],
        'exclude'                 => true,
        'filter'                  => true,
        'inputType'               => 'select',
        'options_callback'        => array('myCompany_tl_content', 'getMyCTemplate'),
        'eval'                    => array('chosen'=>true),
        'sql'                     => "varchar(64) NOT NULL default ''"
    )
);

$GLOBALS['TL_DCA']['tl_content']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_content']['fields'], $fields);

class myCompany_tl_content extends Backend {

    public function getMemberByCompany($dc) {
        return \MyCompany\TeamMembersModel::getAllMemberByCompanyAsArray($dc->activeRecord->mycCompany);
    }

    public function getMembersTemplates()
    {
        return $this->getTemplateGroup('ce_myc_teamMembers_');
    }

    public function getMyCTemplate($dc)
    {
        return $this->getTemplateGroup('ce_'.$dc->activeRecord->type.'_');
    }

}