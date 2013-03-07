<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Table tl_mycConfig
 */
$GLOBALS['TL_DCA']['tl_mycConfig'] = array
(

    // Config
    'config' => array
    (
        'dataContainer'               => 'Table',
        'enableVersioning'            => true,
        'sql' => array
        (
            'keys' => array
            (
                'id' => 'primary'
            )
        )
    ),

    // List
    'list' => array
    (
        'sorting' => array
        (
            'mode'                    => 1,
            'fields'                  => array('name'),
            'flag'                    => 1
        ),
        'label' => array
        (
            'fields'                  => array('name'),
            'format'                  => '%s'
        ),
        'global_operations' => array
        (
            'all' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href'                => 'act=select',
                'class'               => 'header_edit_all',
                'attributes'          => 'onclick="Backend.getScrollOffset();" accesskey="e"'
            )
        ),
        'operations' => array
        (
            'edit' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_mycConfig']['edit'],
                'href'                => 'act=edit',
                'icon'                => 'edit.gif'
            ),
            'copy' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_mycConfig']['copy'],
                'href'                => 'act=copy',
                'icon'                => 'copy.gif'
            ),
            'delete' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_mycConfig']['delete'],
                'href'                => 'act=delete',
                'icon'                => 'delete.gif',
                'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
            ),
            'show' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_mycConfig']['show'],
                'href'                => 'act=show',
                'icon'                => 'show.gif'
            )
        )
    ),

    // Palettes
    'palettes' => array
    (
        '__selector__'                => array(''),
        'default'                     => '{address_legend},name,shorthandle,street,zip,city;{address_logo},logo;{contact_legend},phoneBasic,phoneDirectDial,FaxDirectDial;{mailAndDomain_legend},companyDomain,companyMainMail;{structure_legend},positions,qualificarions;{syndications_legend},facebook,xing,googlePlaces'
    ),

    // Subpalettes
    'subpalettes' => array
    (
        ''                            => ''
    ),

    // Fields
    'fields' => array
    (
        'id' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL auto_increment"
        ),
        'sorting' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
        'tstamp' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
        'name' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycConfig']['name'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'shorthandle' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycConfig']['shorthandle'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'street' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycConfig']['street'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'zip' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycConfig']['zip'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'city' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycConfig']['city'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'logo' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycConfig']['logo'],
            'exclude'                 => true,
            'inputType'               => 'fileTree',
            'eval'                    => array('fieldType'=>'radio', 'mandatory'=>true, 'files'=>true, 'tl_class'=>'clr'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'phoneBasic' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycConfig']['city'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'phoneDirectDial' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycConfig']['phoneDirectDial'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'FaxDirectDial' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycConfig']['FaxDirectDial'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'companyDomain' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycConfig']['companyDomain'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'companyMainMail' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycConfig']['companyMainMail'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'positions' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycConfig']['positions'],
            'exclude'                 => true,
            'inputType'               => 'listWizard',
            'sql'                     => "blob NULL"
        ),
        'qualificarions' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycConfig']['qualificarions'],
            'exclude'                 => true,
            'inputType'               => 'listWizard',
            'sql'                     => "blob NULL"
        ),
        'facebook' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycConfig']['facebook'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'xing' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycConfig']['xing'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'googlePlaces' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycConfig']['googlePlaces'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
    )
);

