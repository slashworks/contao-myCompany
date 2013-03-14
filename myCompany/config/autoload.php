<?php

/**
 * Contao Open Source CMS
 * 
 * Copyright (C) 2005-2013 Leo Feyer
 * 
 * @package MyCompany
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'Contao\MycInsertTags'      => 'system/modules/myCompany/classes/MycInsertTags.php',

	// Helpers
	'BoziFearuresHelper'        => 'system/modules/myCompany/helpers/BoziFearuresHelper.php',
    'MyCompany\Text'            => 'system/modules/myCompany/helpers/Text.php',

	// Models
	'Contao\MycConfigModel'     => 'system/modules/myCompany/models/MycConfigModel.php',
	'Contao\MycTeamModel'     => 'system/modules/myCompany/models/MycTeamModel.php',

	// Modules
	'BE_ModuleMycConfiguration' => 'system/modules/myCompany/modules/BE_ModuleMycConfiguration.php',
	'Contao\MycTeamModule' => 'system/modules/myCompany/modules/MycTeamModule.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'be_mycConfig' => 'system/modules/myCompany/templates',
	'myc_team_list' => 'system/modules/myCompany/templates',
));
