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
     * Table tl_mycCompanies
     */
    $GLOBALS['TL_DCA']['tl_mycCompanies'] = array
    (

        // Config
        'config'      => array
        (
            'dataContainer'    => 'Table',
            'enableVersioning' => true,
            'ctable'           => array(),
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
                'fields'         => array('name'),
                'format'         => '%s',
                'label_callback' => array('MyCompany\Company', 'getListLabel')
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
                    'label' => &$GLOBALS['TL_LANG']['tl_mycCompanies']['edit'],
                    'href'  => 'act=edit',
                    'icon'  => 'edit.gif'
                ),
                'copy'   => array
                (
                    'label' => &$GLOBALS['TL_LANG']['tl_mycCompanies']['copy'],
                    'href'  => 'act=copy',
                    'icon'  => 'copy.gif'
                ),
                'delete' => array
                (
                    'label'      => &$GLOBALS['TL_LANG']['tl_mycCompanies']['delete'],
                    'href'       => 'act=delete',
                    'icon'       => 'delete.gif',
                    'attributes' => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
                ),
                'show'   => array
                (
                    'label' => &$GLOBALS['TL_LANG']['tl_mycCompanies']['show'],
                    'href'  => 'act=show',
                    'icon'  => 'show.gif'
                )
            )
        ),

        // Palettes
        'palettes'    => array
        (
            '__selector__' => array(''),
            'default'      => '{address_legend},name,legalForm,shorthandle,street,zip,city,country;{address_logo},logo;{contact_legend},phoneBasic,phoneDirectDial,faxBasic,faxDirectDial;{mailAndDomain_legend},domain,email;{structure_legend},positions,qualifications;{syndications_legend},socials;optionals'
        ),

        // Subpalettes
        'subpalettes' => array
        (
            '' => ''
        ),

        // Fields
        'fields'      => array
        (
            'id'              => array
            (
                'sql' => "int(10) unsigned NOT NULL auto_increment"
            ),
            'sorting'         => array
            (
                'sql' => "int(10) unsigned NOT NULL default '0'"
            ),
            'tstamp'          => array
            (
                'sql' => "int(10) unsigned NOT NULL default '0'"
            ),
            'name'            => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_mycCompanies']['name'],
                'exclude'   => true,
                'inputType' => 'text',
                'eval'      => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
                'sql'       => "varchar(255) NOT NULL default ''"
            ),
            'legalForm'       => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_mycCompanies']['legalForm'],
                'exclude'   => true,
                'inputType' => 'select',
                'options'   => array('' => 'Einzelunternehmen / Keine', 'AG' => 'AG', 'AG & Co. KG' => 'AG & Co. KG', 'AG & Co. KGaA' => 'AG & Co. KGaA', 'GbR' => 'GbR', 'gGmbH' => 'gGmbH', 'GmbH' => 'GmbH', 'GmbH & Co. KG' => 'GmbH & Co. KG', 'GmbH & Co. KGaA' => 'GmbH & Co. KGaA', 'GmbH & Co. OHG' => 'GmbH & Co. OHG', 'eK' => 'eK', 'eG' => 'eG', 'Limited & Co. KG' => 'Limited & Co. KG', 'OHG' => 'OHG', 'KG' => 'KG', 'Co. KG' => 'Co. KG', 'InvAG' => 'InvAG', 'Partenreederei' => 'Partenreederei', 'PartG' => 'PartG', 'PartG mbB' => 'PartG mbB', 'Stiftung' => 'Stiftung', 'Stiftung & Co. KG' => 'Stiftung & Co. KG', 'Stiftung & Co. KGaA' => 'Stiftung & Co. KGaA', 'Stiftung GmbH & Co. KG' => 'Stiftung GmbH & Co. KG', 'Stille Gesellschaft' => 'Stille Gesellschaft', 'UG' => 'UG (haftungsbeschränkt)', 'UG & Co. KG' => 'UG (haftungsbeschränkt) & Co. KG', 'VVaG' => 'VVaG', 'e.V.' => 'e.V.', 'EWIV' => 'EWIV', 'SCE' => 'SCE', 'SE' => 'SE', 'GesbR' => 'GesbR', 'GewO' => 'GewO', 'OG' => 'OG', 'Ltd.' => 'Ltd.', 'LLC' => 'LLC', 'LLP' => 'LLP', 'LP' => 'LP', 'PLC' => 'PLC'),
                'eval'      => array('mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50', 'chosen' => true),
                'sql'       => "varchar(255) NOT NULL default ''"
            ),
            'shorthandle'     => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_mycCompanies']['shorthandle'],
                'exclude'   => true,
                'inputType' => 'text',
                'eval'      => array('mandatory' => true, 'unique' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
                'sql'       => "varchar(255) NOT NULL default ''"
            ),
            'street'          => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_mycCompanies']['street'],
                'exclude'   => true,
                'inputType' => 'text',
                'eval'      => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
                'sql'       => "varchar(255) NOT NULL default ''"
            ),
            'zip'             => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_mycCompanies']['zip'],
                'exclude'   => true,
                'inputType' => 'text',
                'eval'      => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
                'sql'       => "varchar(255) NOT NULL default ''"
            ),
            'city'            => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_mycCompanies']['city'],
                'exclude'   => true,
                'inputType' => 'text',
                'eval'      => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
                'sql'       => "varchar(255) NOT NULL default ''"
            ),
            'country'         => array(
                'label'     => &$GLOBALS['TL_LANG']['tl_mycCompanies']['country'],
                'exclude'   => true,
                'filter'    => true,
                'sorting'   => true,
                'inputType' => 'select',
                'options'   => System::getCountries(),
                'eval'      => array('mandatory' => true, 'includeBlankOption' => true, 'chosen' => true, 'tl_class' => 'w50'),
                'sql'       => "varchar(2) NOT NULL default ''"
            ),
            'logo'            => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_mycCompanies']['logo'],
                'exclude'   => true,
                'inputType' => 'fileTree',
                'eval'      => array('fieldType' => 'radio', 'mandatory' => true, 'files' => true, 'tl_class' => 'clr'),
                'sql'       => "binary(16) NULL"
            ),
            'phoneBasic'      => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_mycCompanies']['phoneBasic'],
                'exclude'   => true,
                'inputType' => 'text',
                'eval'      => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
                'sql'       => "varchar(255) NOT NULL default ''"
            ),
            'phoneDirectDial' => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_mycCompanies']['phoneDirectDial'],
                'exclude'   => true,
                'inputType' => 'text',
                'eval'      => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
                'sql'       => "varchar(255) NOT NULL default ''"
            ),
            'faxBasic'        => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_mycCompanies']['faxBasic'],
                'exclude'   => true,
                'inputType' => 'text',
                'eval'      => array('maxlength' => 255, 'tl_class' => 'w50'),
                'sql'       => "varchar(255) NOT NULL default ''"
            ),
            'faxDirectDial'   => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_mycCompanies']['faxDirectDial'],
                'exclude'   => true,
                'inputType' => 'text',
                'eval'      => array('maxlength' => 255, 'tl_class' => 'w50'),
                'sql'       => "varchar(255) NOT NULL default ''"
            ),
            'domain'          => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_mycCompanies']['domain'],
                'exclude'   => true,
                'inputType' => 'text',
                'eval'      => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
                'sql'       => "varchar(255) NOT NULL default ''"
            ),
            'email'           => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_mycCompanies']['email'],
                'exclude'   => true,
                'inputType' => 'text',
                'eval'      => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
                'sql'       => "varchar(255) NOT NULL default ''"
            ),
            'positions'       => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_mycCompanies']['positions'],
                'exclude'   => true,
                'inputType' => 'multiColumnWizard',
                'eval'      => array('tl_class' => 'clr long', 'columnFields' => array(
                    'name' => array(
                        'label'     => &$GLOBALS['TL_LANG']['tl_mycCompanies']['socials']['name'],
                        'exclude'   => true,
                        'inputType' => 'text',
                        'eval'      => array('maxlength' => 255, 'style' => 'width:200px'),
                    )
                )),
                'sql'       => "blob NULL"
            ),
            'socials'         => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_mycCompanies']['socials'],
                'exclude'   => true,
                'inputType' => 'multiColumnWizard',
                'eval'      => array('tl_class' => 'clr long', 'columnFields' => array(
                    'name' => array(
                        'label'     => &$GLOBALS['TL_LANG']['tl_mycCompanies']['socials']['name'],
                        'exclude'   => true,
                        'inputType' => 'select',
                        'eval'      => array('maxlength' => 255, 'style' => 'width:200px', 'chosen' => true, 'includeBlankOption' => true),
                        'options'   => array(
                            'google+'   => 'Google+',
                            'facebook'  => 'Facebook',
                            'twitter'   => 'Twitter',
                            'linkedin'  => 'Linkedin',
                            'xing'      => 'Xing',
                            'youtube'   => 'Youtube',
                            'yelp'      => 'Yelp',
                            'instagram' => 'Instagram',
                            'flickr'    => 'Flickr',
                            'pinterest' => 'Pinterest',
                        )
                    ),
                    'url'  => array(
                        'label'     => &$GLOBALS['TL_LANG']['tl_mycCompanies']['socials']['url'],
                        'exclude'   => true,
                        'inputType' => 'text',
                        'eval'      => array('maxlength' => 255, 'style' => 'width: 300px')
                    )
                )),
                'sql'       => "blob NULL"
            ),
            'optionals'       => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_mycCompanies']['optionals'],
                'exclude'   => true,
                'inputType' => 'multiColumnWizard',
                'eval'      => array('tl_class' => 'clr long', 'columnFields' => array(
                    'label'      => array(
                        'label'     => &$GLOBALS['TL_LANG']['tl_mycCompanies']['optionals']['name'],
                        'exclude'   => true,
                        'inputType' => 'text',
                        'eval'      => array('mandatory' => false, 'maxlength' => 255, 'style' => 'width:200px', 'columnPos' => 1)
                    ),
                    'optiontext' => array(
                        'label'     => &$GLOBALS['TL_LANG']['tl_mycCompanies']['optionals']['text'],
                        'exclude'   => true,
                        'inputType' => 'text',
                        'eval'      => array('mandatory' => false, 'maxlength' => 255, 'style' => 'width: 300px')
                    )
                )),
                'sql'       => "blob NULL"
            ),
            'employees'       => array(
                'label'        => &$GLOBALS['TL_LANG']['tl_mycCompanies']['employees'],
                'inputType'    => 'dcaWizard',
                'foreignField' => 'company',
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
                    'listCallback'     => array('MyCompany\Employee', 'generateEmployeeListByCompany'),
                )
            )
        )
    );


