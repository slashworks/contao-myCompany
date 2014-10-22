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

    namespace MyCompany;

    /**
     * Class EmployeeListModule
     *
     * @package MyCompany
     */
    class EmployeeListModule extends \Module
    {

        /**
         * Template
         *
         * @var string
         */
        protected $strTemplate = 'myc_employee_list';

        /**
         * No markup
         *
         * @var boolean
         */
        protected $blnNoMarkup = false;


        /**
         * Generate the module
         */
        protected function compile()
        {

            global $objPage;

            $employeeIds = deserialize($this->mycEmployee);
            $imgSize     = deserialize($this->imgSize);

            $employeeData = \MyCompany\EmployeeModel::findMembersByIdAsArray($employeeIds);
            $curCompany   = \MyCompany\CompanyModel::getById($this->mycCompany);

            $aEmployees = array();

            foreach ($employeeData as $employee) {
                $aEmployees[] = \MyCompany\Helper\DataMaps::getEmployeeData($employee, $curCompany, $imgSize);
            }

            // HOOK
            if (isset($GLOBALS['TL_HOOKS']['mycModifyEmployeeList']) && is_array($GLOBALS['TL_HOOKS']['mycModifyEmployeeList']))
            {
                foreach ($GLOBALS['TL_HOOKS']['mycModifyEmployeeList'] as $callback)
                {
                    $this->import($callback[0]);
                    $this->$callback[0]->$callback[1]($aEmployees, $employeeData, $curCompany, $employeeIds, $imgSize, $this);
                }
            }


            $this->Template->employees = $aEmployees;
            $this->Template->company   = $curCompany;

        }

    }
