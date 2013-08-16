<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2011 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Joe Ray Gregory @ slashworks 2013
 * @author     Joe Ray Gregory 
 * @package    BoziFeatures 
 * @license    LGPL 
 * @filesource
 */

//Import Bozi Helper
$this->import('BoziFearuresHelper', 'Helper');
/**
 * Table tl_mycTeamMembers 
 */
$GLOBALS['TL_DCA']['tl_mycTeamMembers'] = array
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
			'fields'                  => array('lastname'),
			'flag'                    => 1
		),
		'label' => array
		(
			'fields'                  => array('lastname', 'surname'),
			'format'                  => '%s, %s'
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
				'label'               => &$GLOBALS['TL_LANG']['tl_mycTeamMembers']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_mycTeamMembers']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_mycTeamMembers']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_mycTeamMembers']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'                => array(''),
		'default'                     => 'title,surname,lastname,shorthandle,companys,picture,about,jobTitle,directDial,mailSuffix'
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
        'title' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycTeamMembers']['title'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
		'surname' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_mycTeamMembers']['surname'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
		),
        'lastname' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycTeamMembers']['lastname'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'shorthandle' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycTeamMembers']['shorthandle'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'picture' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycTeamMembers']['picture'],
            'exclude'                 => true,
            'inputType'               => 'fileTree',
            'eval'                    => array('fieldType'=>'radio', 'files'=>true, 'tl_class'=>'clr'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'about' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycTeamMembers']['about'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'textarea',
            'eval'                    => array('rte'=>'tinyMCE', 'helpwizard'=>true),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'directDial' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycTeamMembers']['directDial'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(2) NOT NULL default ''"
        ),
        'mailSuffix' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycTeamMembers']['mailSuffix'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'companys'   => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycTeamMembers']['company'],
            'exclude'                 => true,
            'inputType'               => 'select',
            'options_callback'        => array('\MyCompany\CompanysModel', 'getAllCompaniesAsArray'),
            'eval'                    => array('tl_class'=>'w50','multiple'=>true, 'chosen'=>true),
            'sql'                     =>"blob NULL"
        )
	)
);

