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

/**
 * Backend Features
 */

$modulePath = 'system/modules/boziFeatures/';

array_insert($GLOBALS['BE_MOD'], 0, array(
    'MyCompany' => array(
        /*'boziPinBoard' => array(
            'tables' => array('tl_boziPinBoard'),
            'icon'   => 'system/modules/boziFeatures/res/icons/pinBoard.png'
        ),*/
        /*'MycCustomers' => array(
            'tables' => array('tl_mycCustomers'),
            'icon'   => $modulePath.'res/icons/customers.png'
        ),*/
        /*'boziCustomersStatements' => array(
            'tables' => array('tl_boziCustomerStatements'),
            'icon'   => 'system/modules/boziFeatures/res/icons/customersStatements.png'
        ),*/
        /*'boziAttainment' => array(
            'tables' => array('tl_boziAttainment'),
            'icon'   => 'system/modules/boziFeatures/res/icons/attainment.png'
        ),*/
        'mycTeam' => array(
            'tables' => array('tl_mycTeam'),
            'icon'   => $modulePath.'assets/icons/team.png'
        ),
        'mycConfig' => array(
            'tables' => array('tl_mycConfig'),
            'icon'   => $modulePath.'assets/icons/team.png'
        ),
        /*'mycConfiguration' => array(
            'callback' => 'BE_ModuleMycConfiguration',
        )*/
    )
));

$GLOBALS['FE_MOD']['boziFeatures'] = array
(
    'boziPinboradByGroup'       => 'BoziAttainmentModule',
    'boziCustomerList'          => 'BoziCustomerListModule',
    'boziPinboardSortable'      => 'BoziPinboardSortableModule'
);

/**
 * Content Elements
 */
$GLOBALS['TL_CTE']['boziFeatures'] = array
(
    //'boziTeamMember' => 'BoziTeamMember'
);

/**
 * Back end form fields
 */
//$GLOBALS['BE_FFL']['pinboardTree'] = 'PinboardTree';

/**
 * Hooks
 */
$GLOBALS['TL_HOOKS']['replaceInsertTags'][] = array('MycInsertTags', 'generateInsertTags');
//$GLOBALS['TL_HOOKS']['generatePage'][] = array('BoziTags', 'getPage');

/**
 * Stylesheet
 */
if(TL_MODE == 'FE') {
    //$GLOBALS['TL_CSS'][] = 'assets/boziweb/css/style.css';
}