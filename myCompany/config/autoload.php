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
                                'MyCompany\Company'           => 'system/modules/myCompany/classes/backend/Company.php',
                                'MyCompany\Employee'           => 'system/modules/myCompany/classes/backend/Employee.php',
                                'MyCompany\EmployeeData'       => 'system/modules/myCompany/classes/backend/EmployeeData.php',
                                'MyCompany\InsertTagsCompany'  => 'system/modules/myCompany/classes/frontend/InsertTagsCompany.php',
                                'MyCompany\InsertTagsEmployee' => 'system/modules/myCompany/classes/frontend/InsertTagsEmployee.php',
                                'MyCompany\InsertTagsCustomer' => 'system/modules/myCompany/classes/frontend/InsertTagsCustomer.php',
                                'MyCompany\InsertTagsProject'  => 'system/modules/myCompany/classes/frontend/InsertTagsProject.php',


                                //Content elements
                                'MyCompany\CE\Employee'        => 'system/modules/myCompany/contentElements/employee/Employee.php',
                                'MyCompany\CE\Employees'       => 'system/modules/myCompany/contentElements/employee/Employees.php',
                                'MyCompany\CE\RoutingButton'   => 'system/modules/myCompany/contentElements/googlemaps/RoutingButton.php',
                                'MyCompany\CE\CeMycWrapper'    => 'system/modules/myCompany/contentElements/CeMycWrapper.php',
                                'MyCompany\CE\StaticMap'       => 'system/modules/myCompany/contentElements/googlemaps/StaticMap.php',

                                // Helpers
                                'MyCompany\Helper\DataMaps'    => 'system/modules/myCompany/helpers/DataMaps.php',
                                'MyCompany\Helper\Text'    => 'system/modules/myCompany/helpers/Text.php',

                                // Models
                                'MyCompany\EmployeeModel'      => 'system/modules/myCompany/models/EmployeeModel.php',
                                'MyCompany\EmployeeDataModel'  => 'system/modules/myCompany/models/EmployeeDataModel.php',
                                'MyCompany\CompanyModel'       => 'system/modules/myCompany/models/CompanyModel.php',

                                // Modules
                                'MyCompany\EmployeeListModule' => 'system/modules/myCompany/modules/EmployeeListModule.php',
                                'MyCompany\CompanyLogoModule'  => 'system/modules/myCompany/modules/CompanyLogoModule.php',
                                'MyCompany\SocialMediaLinks'   => 'system/modules/myCompany/modules/SocialMediaLinks.php',
                            ));


    /**
     * Register the templates
     */
    TemplateLoader::addFiles(array
                             (
                                 'be_mycConfig'                => 'system/modules/myCompany/templates',
                                 'myc_team_list'               => 'system/modules/myCompany/templates',

                                 'ce_mycwrapper'               => 'system/modules/myCompany/templates/elements',
                                 'ce_mycEmployee_default'      => 'system/modules/myCompany/templates/elements/employee',
                                 'ce_mycEmployee_short'        => 'system/modules/myCompany/templates/elements/employee',
                                 'ce_mycEmployees_default'     => 'system/modules/myCompany/templates/elements/employee',
                                 'ce_mycRoutingButton_default' => 'system/modules/myCompany/templates/elements/googlemaps',
                                 'ce_mycStaticMap_default'     => 'system/modules/myCompany/templates/elements/googlemaps',

                                 'mod_myc_wrapper'             => 'system/modules/myCompany/templates/modules',
                                 'mycSocialMediaLinks_default' => 'system/modules/myCompany/templates/modules/partials',
                                 'mycCompanyLogo_default'      => 'system/modules/myCompany/templates/modules/partials',
                             ));
