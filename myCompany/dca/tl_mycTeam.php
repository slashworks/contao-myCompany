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
 * @copyright  Joe Ray Gregory @ borowiakziehe KG 2012 
 * @author     Joe Ray Gregory 
 * @package    BoziFeatures 
 * @license    LGPL 
 * @filesource
 */

//Import Bozi Helper
$this->import('BoziFearuresHelper', 'Helper');
/**
 * Table tl_mycTeam 
 */
$GLOBALS['TL_DCA']['tl_mycTeam'] = array
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
				'label'               => &$GLOBALS['TL_LANG']['tl_mycTeam']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_mycTeam']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_mycTeam']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_mycTeam']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'                => array(''),
		'default'                     => 'surname,lastname,company,position,picture,about,jobTitle,directDial,mailSuffix,facebook,twitter,xing'
		//'default'                     => 'position,surname,lastname,picture,about,jobTitle,directDial,mailSuffix,boziCategorys,qualification'
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
		'surname' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_mycTeam']['surname'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
		),
        'lastname' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycTeam']['lastname'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'picture' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycTeam']['picture'],
            'exclude'                 => true,
            'inputType'               => 'fileTree',
            'eval'                    => array('fieldType'=>'radio', 'files'=>true, 'tl_class'=>'clr'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'about' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycTeam']['about'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'textarea',
            'eval'                    => array('rte'=>'tinyMCE', 'helpwizard'=>true),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'directDial' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycTeam']['directDial'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(2) NOT NULL default ''"
        ),
        'mailSuffix' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycTeam']['mailSuffix'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'company'   => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycTeam']['company'],
            'exclude'                 => true,
            'inputType'               => 'select',
            'options_callback'        => array('\MyCompany\ConfigModel', 'getAllCompaniesAsArray'),
            'eval'                    => array('tl_class'=>'w50','submitOnChange'=>true),
            'sql'                     =>"varchar(255) NOT NULL default ''"
        ),
        'position' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycTeam']['position'],
            'exclude'                 => true,
            'inputType'               => 'select',
            'options_callback'        => array('\MyCompany\ConfigModel', 'getAllPositionsAsArray'),
            'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'facebook' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycTeam']['facebook'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'twitter' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycTeam']['twitter'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'xing' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mycTeam']['xing'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        )
	)
);

