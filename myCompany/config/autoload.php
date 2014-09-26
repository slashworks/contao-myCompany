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
     * Register the classes
     */
    ClassLoader::addClasses(array
                            (
                                // Classes
                                'MyCompany\Employee'    => 'system/modules/myCompany/classes/backend/Employee.php',
                                'MyCompany\EmployeeData'    => 'system/modules/myCompany/classes/backend/EmployeeData.php',


                                //Content elements

                                // Helpers

                                // Models
                                'MyCompany\EmployeeModel'    => 'system/modules/myCompany/models/EmployeeModel.php',
                                'MyCompany\CompanyModel'    => 'system/modules/myCompany/models/CompanyModel.php',

                                // Modules
                            ));


    /**
     * Register the templates
     */
    TemplateLoader::addFiles(array
                             (
                                 'be_mycConfig'                => 'system/modules/myCompany/templates',
                                 'myc_team_list'               => 'system/modules/myCompany/templates',

                                 'ce_mycwrapper'               => 'system/modules/myCompany/templates/elements',
                                 'ce_mycTeamMember_default'    => 'system/modules/myCompany/templates/elements/teammember',
                                 'ce_mycTeamMember_short'      => 'system/modules/myCompany/templates/elements/teammember',
                                 'ce_mycTeamMembers_default'   => 'system/modules/myCompany/templates/elements/teammember',
                                 'ce_mycRoutingButton_default' => 'system/modules/myCompany/templates/elements/googlemaps',
                                 'ce_mycStaticMap_default'     => 'system/modules/myCompany/templates/elements/googlemaps',

                                 'mod_myc_wrapper'             => 'system/modules/myCompany/templates/modules',
                                 'mycSocialMediaLinks_default' => 'system/modules/myCompany/templates/modules/partials',
                                 'mycCompanyLogo_default'      => 'system/modules/myCompany/templates/modules/partials',
                             ));
