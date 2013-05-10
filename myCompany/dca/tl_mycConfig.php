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
            'fields'                  => array('companyName'),
            'flag'                    => 1
        ),
        'label' => array
        (
            'fields'                  => array('companyName'),
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
        'default'                     => '{address_legend},companyName,companyShorthandle,companyStreet,companyZip,companyCity;{address_logo},companyLogo;{contact_legend},companyPhoneBasic,companyPhoneDirectDial,companyFaxDirectDial;{mailAndDomain_legend},companyDomain,companyMainMail;{structure_legend},companyPositions,companyQualifications;{syndications_legend},facebook,xing,googlePlaces'
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
        'companyName' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycConfig']['companyName'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'companyShorthandle' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycConfig']['companyShorthandle'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'companyStreet' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycConfig']['companyStreet'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'companyZip' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycConfig']['companyZip'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'companyCity' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycConfig']['companyCity'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'companyLogo' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycConfig']['companyLogo'],
            'exclude'                 => true,
            'inputType'               => 'fileTree',
            'eval'                    => array('fieldType'=>'radio', 'mandatory'=>true, 'files'=>true, 'tl_class'=>'clr'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'companyPhoneBasic' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycConfig']['companyPhoneBasic'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'companyPhoneDirectDial' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycConfig']['companyPhoneDirectDial'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'companyFaxDirectDial' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycConfig']['companyFaxDirectDial'],
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
        'companyPositions' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycConfig']['companyPositions'],
            'exclude'                 => true,
            'inputType'               => 'listWizard',
            'sql'                     => "blob NULL"
        ),
        'companyQualifications' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycConfig']['companyQualifications'],
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

