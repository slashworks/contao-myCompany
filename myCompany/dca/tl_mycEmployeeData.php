<?php
    /**
     *
     *          _           _                       _
     *         | |         | |                     | |
     *      ___| | __ _ ___| |____      _____  _ __| | _____
     *     / __| |/ _` / __| '_ \ \ /\ / / _ \| '__| |/ / __|
     *     \__ \ | (_| \__ \ | | \ V  V / (_) | |  |   <\__ \
     *     |___/_|\__,_|___/_| |_|\_/\_/ \___/|_|  |_|\_\___/
     *                                        web development
     *
     *     http://www.slash-works.de </> hallo@slash-works.de
     *
     *
     * @author      rwollenburg
     * @copyright   rwollenburg@slashworks
     * @since       24.09.14 00:00
     * @package     MyCompany
     *
     */


    /**
     * Table tl_mycEmployee
     */
    $GLOBALS['TL_DCA']['tl_mycEmployeeData'] = array
    (

        // Config
        'config'      => array
        (
            'dataContainer'    => 'Table',
            'ptable'           => 'tl_mycEmployee',
            'enableVersioning' => true,
            'sql'              => array
            (
                'keys' => array
                (
                    'id' => 'primary'
                )
            ),
            'onload_callback'  => array(
                array('MyCompany\EmployeeData', 'filterList')
            )

        ),

        // List
        'list'        => array
        (
            'sorting'           => array
            (
                'mode'         => 1,
                'fields'       => array('company', 'position'),
                'headerFields' => array('company', 'position'),
                'flag'         => 1,
                //                'filter' => array(
                //                    array('company = ?', \Input::get('company')? \Input::get('company'):'')
                //                )
            ),
            'label'             => array
            (
                'fields'         => array('position'),
                'format'         => '%s',
                'label_callback' => array('MyCompany\EmployeeData', 'getLabel'),
                'group_callback' => array('MyCompany\EmployeeData', 'getGroupLabel'),
            ),
            'global_operations' => array
            (
                'all' => array
                (
                    'label'      => &$GLOBALS['TL_LANG']['MSC']['all'],
                    'href'       => 'act=select',
                    'class'      => 'header_edit_all',
                    'attributes' => 'onclick="Backend.getScrollOffset();" accesskey="e"'
                )
            ),
            'operations'        => array
            (
                'edit'   => array
                (
                    'label' => &$GLOBALS['TL_LANG']['tl_mycEmployee']['edit'],
                    'href'  => 'act=edit',
                    'icon'  => 'edit.gif'
                ),
                'copy'   => array
                (
                    'label' => &$GLOBALS['TL_LANG']['tl_mycEmployee']['copy'],
                    'href'  => 'act=copy',
                    'icon'  => 'copy.gif'
                ),
                'delete' => array
                (
                    'label'      => &$GLOBALS['TL_LANG']['tl_mycEmployee']['delete'],
                    'href'       => 'act=delete',
                    'icon'       => 'delete.gif',
                    'attributes' => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
                ),
                'show'   => array
                (
                    'label' => &$GLOBALS['TL_LANG']['tl_mycEmployee']['show'],
                    'href'  => 'act=show',
                    'icon'  => 'show.gif'
                )
            )
        ),

        // Palettes
        'palettes'    => array
        (
            '__selector__' => array(''),
            'default'      => 'company,position;{contact_legend},email,phoneExt,faxExt,mobile;{about_legend},about,picture;{social_legend:hide},socials;{otherinfo_legend:hide},shorthandle,detailPage;'
        ),

        // Subpalettes
        'subpalettes' => array
        (
            '' => ''
        ),

        // Fields
        'fields'      => array
        (
            'id'          => array
            (
                'sql' => "int(10) unsigned NOT NULL auto_increment"
            ),
            'pid'         => array
            (
                'sql' => "int(10) unsigned NOT NULL"
            ),
            'sorting'     => array
            (
                'sql' => "int(10) unsigned NOT NULL default '0'"
            ),
            'tstamp'      => array
            (
                'sql' => "int(10) unsigned NOT NULL default '0'"
            ),
            'company'     => array(
                'label'        => &$GLOBALS['TL_LANG']['tl_mycEmployeeData']['company'],
                'exclude'      => true,
                'inputType'    => 'select',
                'foreignKey'   => 'tl_mycCompanies.name',
                'foreignField' => 'id',
                'eval'         => array('mandatory' => true, 'maxlength' => 255, 'chosen' => true, 'submitOnChange' => true, 'includeBlankOption' => true, 'tl_class' => 'w50'),
                'sql'          => "int(10) unsigned NOT NULL",

            ),
            'position'    => array
            (
                'label'            => &$GLOBALS['TL_LANG']['tl_mycEmployeeData']['jobTitle'],
                'exclude'          => true,
                'inputType'        => 'select',
                'options_callback' => array('MyCompany\EmployeeData', 'getPositionsByCompany'),
                'eval'             => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50', 'chosen' => true),
                'sql'              => "varchar(255) NOT NULL default ''"
            ),
            'shorthandle' => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_mycEmployeeData']['shorthandle'],
                'exclude'   => true,
                'inputType' => 'text',
                'eval'      => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
                'sql'       => "varchar(255) NOT NULL default ''"
            ),
            'picture'     => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_mycEmployeeData']['picture'],
                'exclude'   => true,
                'inputType' => 'fileTree',
                'eval'      => array('fieldType' => 'radio', 'files' => true, 'tl_class' => 'clr'),
                'sql'       => "binary(16) NULL"
            ),
            'about'       => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_mycEmployeeData']['about'],
                'exclude'   => true,
                'search'    => true,
                'inputType' => 'textarea',
                'eval'      => array('rte' => 'tinyMCE', 'helpwizard' => true),
                'sql'       => "text NULL"
            ),
            'phoneExt'       => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_mycEmployeeData']['phoneExt'],
                'exclude'   => true,
                'inputType' => 'text',
                'eval'      => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
                'sql'       => "varchar(10) NOT NULL default ''"
            ),
            'faxExt'       => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_mycEmployeeData']['faxExt'],
                'exclude'   => true,
                'inputType' => 'text',
                'eval'      => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
                'sql'       => "varchar(10) NOT NULL default ''"
            ),
            'email'       => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_mycEmployeeData']['email'],
                'exclude'   => true,
                'inputType' => 'text',
                'eval'      => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
                'sql'       => "varchar(255) NOT NULL default ''"
            ),
            'mobile'      => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_mycEmployeeData']['mobile'],
                'exclude'   => true,
                'inputType' => 'text',
                'eval'      => array('maxlength' => 255, 'tl_class' => 'w50'),
                'sql'       => "varchar(255) NOT NULL default ''"
            ),
            'socials'     => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_mycEmployeeData']['socials'],
                'exclude'   => true,
                'inputType' => 'multiColumnWizard',
                'eval'      => array('tl_class' => 'clr long', 'columnFields' => array(
                    'name' => array(
                        'label'     => &$GLOBALS['TL_LANG']['tl_mycCompanys']['socials']['name'],
                        'exclude'   => true,
                        'inputType' => 'text',
                        'eval'      => array('maxlength' => 255, 'style' => 'width:200px')
                    ),
                    'url'  => array(
                        'label'     => &$GLOBALS['TL_LANG']['tl_mycCompanys']['socials']['url'],
                        'exclude'   => true,
                        'inputType' => 'text',
                        'eval'      => array('maxlength' => 255, 'style' => 'width: 300px')
                    )
                )),
                'sql'       => "blob NULL"
            ),
            'detailPage'  => array
            (
                'label'      => &$GLOBALS['TL_LANG']['tl_mycEmployeeData']['detailPage'],
                'exclude'    => true,
                'inputType'  => 'pageTree',
                'foreignKey' => 'tl_page.title',
                'eval'       => array('fieldType' => 'radio', 'tl_class' => 'clr'),
                'sql'        => "int(10) unsigned NOT NULL default '0'",
                'relation'   => array('type' => 'hasOne', 'load' => 'eager')
            ),
        )
    );


