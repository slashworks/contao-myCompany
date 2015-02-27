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
    $GLOBALS['TL_DCA']['tl_mycEmployee'] = array
    (

        // Config
        'config'      => array
        (
            'dataContainer'    => 'Table',
            'ctable'           => array('tl_mycEmployeeData'),
            'enableVersioning' => true,
            'sql'              => array
            (
                'keys' => array
                (
                    'id' => 'primary'
                )
            ),
            'ondelete_callback' => array(
                array('MyCompany\Backend\Employee','deleteEmployeeData')
            )
        ),

        // List
        'list'        => array
        (
            'sorting'           => array
            (
                'mode'        => 1,
                'fields'      => array('lastname'),
                'flag'        => 1,
                'panelLayout' => 'filter;search,limit'
            ),
            'label'             => array
            (
                'fields'         => array('lastname', 'firstname', 'company'),
                'format'         => '%s %s %s',
                'label_callback' => array('MyCompany\Backend\Employee', 'getListLabel')
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
            'default'      => 'gender,title,firstname,lastname;{employeeData_legend},employeeData'
        ),

        // Subpalettes
        'subpalettes' => array
        (
            '' => ''
        ),

        // Fields
        'fields'      => array
        (
            'id'           => array
            (
                'sql' => "int(10) unsigned NOT NULL auto_increment"
            ),
            'sorting'      => array
            (
                'sql' => "int(10) unsigned NOT NULL default '0'"
            ),
            'tstamp'       => array
            (
                'sql' => "int(10) unsigned NOT NULL default '0'"
            ),
            'title'        => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_mycEmployee']['title'],
                'search'    => true,
                'inputType' => 'text',
                'eval'      => array('maxlength' => 255, 'tl_class' => 'w50'),
                'sql'       => "varchar(255) NOT NULL default ''"
            ),
            'gender'       => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_mycEmployee']['gender'],
                'search'    => true,
                'inputType' => 'select',
                'options'   => array(
                    "m" => &$GLOBALS['TL_LANG']['tl_mycEmployee']['male'],
                    "f" => &$GLOBALS['TL_LANG']['tl_mycEmployee']['female']
                ),
                'eval'      => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
                'sql'       => "varchar(1) NOT NULL default ''"
            ),
            'firstname'    => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_mycEmployee']['firstname'],
                'search'    => true,
                'inputType' => 'text',
                'eval'      => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
                'sql'       => "varchar(255) NOT NULL default ''"
            ),
            'lastname'     => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_mycEmployee']['lastname'],
                'search'    => true,
                'inputType' => 'text',
                'eval'      => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
                'sql'       => "varchar(255) NOT NULL default ''"
            ),
            'employeeData' => array(
                'label'        => &$GLOBALS['TL_LANG']['tl_mycEmployee']['data'],
                'inputType'    => 'dcaWizard',
                'foreignTable' => 'tl_mycEmployeeData',
                'eval'         => array
                (
                    // A list of fields to be displayed in the table
                    'fields'           => array('id', 'position'),

                    // Header fields of the table (leave empty to use labels)
                    'headerFields'     => array('ID', 'position'),

                    // Use a custom label for the edit button
                    'editButtonLabel'  => $GLOBALS['TL_LANG']['tl_mycEmployee']['employee_data_edit_button'],

                    // Use a custom label for the apply button
                    'applyButtonLabel' => $GLOBALS['TL_LANG']['tl_mycEmployee']['employee_data_prices_apply_button'],

                    // Order records by a particular field
                    'orderField'       => 'position DESC',

                    // Use the callback to generate the list
                    'listCallback'     => array('MyCompany\Backend\EmployeeData', 'generateWizardList'),
                )
            )
        )
    );






