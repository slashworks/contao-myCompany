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
     * Table tl_mycCustomers
     */
    $GLOBALS['TL_DCA']['tl_mycCustomers'] = array
    (

        // Config
        'config'      => array
        (
            'dataContainer'    => 'Table',
            'enableVersioning' => true,
            'sql'              => array
            (
                'keys' => array
                (
                    'id' => 'primary'
                )
            )
        ),

        // List
        'list'        => array
        (
            'sorting'           => array
            (
                'mode'   => 1,
                'fields' => array('name'),
                'flag'   => 1
            ),
            'label'             => array
            (
                'fields' => array('name'),
                'format' => '%s'
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
                    'label' => &$GLOBALS['TL_LANG']['tl_mycCustomers']['edit'],
                    'href'  => 'act=edit',
                    'icon'  => 'edit.gif'
                ),
                'copy'   => array
                (
                    'label' => &$GLOBALS['TL_LANG']['tl_mycCustomers']['copy'],
                    'href'  => 'act=copy',
                    'icon'  => 'copy.gif'
                ),
                'delete' => array
                (
                    'label'      => &$GLOBALS['TL_LANG']['tl_mycCustomers']['delete'],
                    'href'       => 'act=delete',
                    'icon'       => 'delete.gif',
                    'attributes' => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
                ),
                'show'   => array
                (
                    'label' => &$GLOBALS['TL_LANG']['tl_mycCustomers']['show'],
                    'href'  => 'act=show',
                    'icon'  => 'show.gif'
                )
            )
        ),

        // Palettes
        'palettes'    => array
        (
            '__selector__' => array(''),
            'default'      => 'name,url,logo,company;description, shorthandle'
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
            'sorting'     => array
            (
                'sql' => "int(10) unsigned NOT NULL default '0'"
            ),
            'tstamp'      => array
            (
                'sql' => "int(10) unsigned NOT NULL default '0'"
            ),
            'name'        => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_mycCustomers']['name'],
                'exclude'   => true,
                'inputType' => 'text',
                'eval'      => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
                'sql'       => "varchar(255) NOT NULL default ''"
            ),
            'url'         => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_mycCustomers']['url'],
                'exclude'   => true,
                'inputType' => 'text',
                'eval'      => array('maxlength' => 255, 'tl_class' => 'w50', 'rgxp' => 'url'),
                'sql'       => "varchar(255) NOT NULL default ''"
            ),
            'logo'        => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_mycCustomers']['logo'],
                'exclude'   => true,
                'inputType' => 'fileTree',
                'eval'      => array('fieldType' => 'radio', 'mandatory' => true, 'files' => true, 'tl_class' => 'clr'),
                'sql'       => "binary(16) NULL"
            ),
            'company'     => array(
                'label'      => &$GLOBALS['TL_LANG']['tl_mycProjects']['company'],
                'exclude'    => true,
                'inputType'  => 'select',
                'foreignKey' => "tl_mycCompanies.name",
                'eval'       => array('mandatory' => false, 'includeBlankOption' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
                'sql'        => "int(10) unsigned NOT NULL default '0'"
            ),
            'description' => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_mycCustomers']['description'],
                'exclude'   => true,
                'search'    => true,
                'inputType' => 'textarea',
                'eval'      => array('rte' => 'tinyMCE', 'helpwizard' => true),
                'sql'       => "text NULL"
            ),
            'shorthandle' => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_mycCustomers']['shorthandle'],
                'exclude'   => true,
                'inputType' => 'text',
                'eval'      => array('mandatory' => true, 'unique' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
                'sql'       => "varchar(255) NOT NULL default ''"
            ),
        )
    );