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

	// Models
	'Contao\MycConfigModel'     => 'system/modules/myCompany/models/MycConfigModel.php',

	// Modules
	'BE_ModuleMycConfiguration' => 'system/modules/myCompany/modules/BE_ModuleMycConfiguration.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'be_mycConfig' => 'system/modules/myCompany/templates',
));
