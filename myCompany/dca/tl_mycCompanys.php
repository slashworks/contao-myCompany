<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Table tl_mycCompanys
 */
$GLOBALS['TL_DCA']['tl_mycCompanys'] = array
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
                'label'               => &$GLOBALS['TL_LANG']['tl_mycCompanys']['edit'],
                'href'                => 'act=edit',
                'icon'                => 'edit.gif'
            ),
            'copy' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_mycCompanys']['copy'],
                'href'                => 'act=copy',
                'icon'                => 'copy.gif'
            ),
            'delete' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_mycCompanys']['delete'],
                'href'                => 'act=delete',
                'icon'                => 'delete.gif',
                'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
            ),
            'show' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_mycCompanys']['show'],
                'href'                => 'act=show',
                'icon'                => 'show.gif'
            )
        )
    ),

    // Palettes
    'palettes' => array
    (
        '__selector__'                => array(''),
        'default'                     => '{address_legend},name,legalForm,shorthandle,street,zip,city,country;{address_logo},logo;{contact_legend},phoneBasic,phoneDirectDial,faxBasic,faxDirectDial;{mailAndDomain_legend},domain,mainMail;{structure_legend},positions,qualifications;{syndications_legend},socials;optionals'
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
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycCompanys']['name'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'legalForm' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycCompanys']['legalForm'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'shorthandle' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycCompanys']['shorthandle'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'street' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycCompanys']['street'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'zip' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycCompanys']['zip'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'city' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycCompanys']['city'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'country' => array(
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycCompanys']['country'],
            'exclude'                 => true,
            'filter'                  => true,
            'sorting'                 => true,
            'inputType'               => 'select',
            'options'                 => System::getCountries(),
            'eval'                    => array('mandatory'=>true, 'includeBlankOption'=>true, 'chosen'=>true, 'tl_class'=>'w50'),
            'sql'                     => "varchar(2) NOT NULL default ''"
        ),
        'logo' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycCompanys']['logo'],
            'exclude'                 => true,
            'inputType'               => 'fileTree',
            'eval'                    => array('fieldType'=>'radio', 'mandatory'=>true, 'files'=>true, 'tl_class'=>'clr'),
            'sql'                     => "binary(16) NULL"
        ),
        'phoneBasic' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycCompanys']['phoneBasic'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'phoneDirectDial' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycCompanys']['phoneDirectDial'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'faxBasic' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycCompanys']['faxBasic'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'faxDirectDial' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycCompanys']['faxDirectDial'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'domain' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycCompanys']['domain'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'mainMail' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycCompanys']['mainMail'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'socials' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycCompanys']['socials'],
            'exclude'                 => true,
            'inputType'               => 'multiColumnWizard',
            'eval'                    => array('tl_class'=>'clr long', 'columnFields' => array(
                'name' => array(
                    'label'                   => &$GLOBALS['TL_LANG']['tl_mycCompanys']['socials']['name'],
                    'exclude'                 => true,
                    'inputType'               => 'text',
                    'eval'                    => array('maxlength'=>255, 'style' => 'width:200px')
                ),
                'url' => array(
                    'label'                   => &$GLOBALS['TL_LANG']['tl_mycCompanys']['socials']['url'],
                    'exclude'                 => true,
                    'inputType'               => 'text',
                    'eval'                    => array('maxlength'=>255, 'style' => 'width: 300px')
                )
            )),
            'sql'                     => "blob NULL"
        ),
        'optionals' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycCompanys']['optionals'],
            'exclude'                 => true,
            'inputType'               => 'multiColumnWizard',
            'eval'                    => array('tl_class'=>'clr long', 'columnFields' => array(
                'label' => array(
                    'label'                   => &$GLOBALS['TL_LANG']['tl_mycCompanys']['optionals']['name'],
                    'exclude'                 => true,
                    'inputType'               => 'text',
                    'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'style' => 'width:200px', 'columnPos'=>1)
                ),
                'optiontext' => array(
                    'label'                   => &$GLOBALS['TL_LANG']['tl_mycCompanys']['optionals']['text'],
                    'exclude'                 => true,
                    'inputType'               => 'text',
                    'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'style' => 'width: 300px')
                )
            )),
            'sql'                     => "blob NULL"
        )
    )
);

