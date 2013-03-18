<?php

$GLOBALS['TL_DCA']['tl_content']['palettes']['mycTeamMember'] = '{type_legend},type,mycTeamMember;{image_legend},size;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space;{invisible_legend:hide},invisible,start,stop';

$fields = array
(
    'mycTeamMember' => array
    (
        'label'                   => &$GLOBALS['TL_LANG']['tl_content']['mycTeamMember'],
        'exclude'                 => true,
        'filter'                  => true,
        'inputType'               => 'select',
        'options_callback'        => array('\MyCompany\TeamModel', 'getAllMemberAsArray'),
        'eval'                    => array('chosen'=>true, 'submitOnChange'=>true),
        'sql'                     => "varchar(32) NOT NULL default ''"
    )
);

$GLOBALS['TL_DCA']['tl_content']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_content']['fields'], $fields);