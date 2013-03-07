<?php

$GLOBALS['TL_DCA']['tl_module']['palettes']['boziPinboradByGroup'] = '{title_legend},name,headline,type;boziPinBoardGroup';
$GLOBALS['TL_DCA']['tl_module']['palettes']['boziCustomerList'] = '{title_legend},name,headline,type;imgSize';
$GLOBALS['TL_DCA']['tl_module']['palettes']['boziPinboardSortable'] = '{title_legend},name,headline,type;imgSize,boziPinBoardItems';

$fields = array
(
    'boziPinBoardGroup' => array
    (
        'label'                   => &$GLOBALS['TL_LANG']['tl_content']['boziTeamMember'],
        'exclude'                 => true,
        'filter'                  => true,
        'inputType'               => 'checkboxWizard',
        'options_callback'        => array('BoziAttainmentModel', 'getGroupsAsArray'),
        'eval'                    => array('multiple'=>true),
        'sql'                     => "blob NULL"
    ),
    'boziPinBoardItems' => array
    (
        'label'                   => &$GLOBALS['TL_LANG']['tl_content']['posterSRC'],
        'exclude'                 => true,
        'inputType'               => 'select',
        'options_callback'        => array('BoziPinboardModel', 'getAllItemsAsArray'),
        'eval'                    => array('multiple'=>true,'chosen'=> true),
        'sql'                     => "blob Null"
    )

);

$GLOBALS['TL_DCA']['tl_module']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_module']['fields'], $fields);


