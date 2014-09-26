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
     * Backend Features
     */

    $modulePath = 'system/modules/myCompany/';

    array_insert($GLOBALS['BE_MOD'], 0, array(
        'MyCompany' => array(
            'mycCompanies'  => array(
                'tables' => array('tl_mycCompanies','tl_mycEmployee','tl_mycEmployeeData'),
                'icon'   => $modulePath . 'assets/icons/config.png'
            ),
            'mycEmployees'  => array(
                'tables' => array('tl_mycEmployee','tl_mycEmployeeData'),
                'icon'   => $modulePath . 'assets/icons/config.png'
            ),
            'mycCustomers'  => array(
                'tables' => array('tl_mycCustomers','tl_mycCompanies'),
                'icon'   => $modulePath . 'assets/icons/config.png'
            ),
            'mycProjects'  => array(
                'tables' => array('tl_mycProjects','tl_mycCustomers','tl_mycCompanies'),
                'icon'   => $modulePath . 'assets/icons/config.png'
            )
        )
    ));

