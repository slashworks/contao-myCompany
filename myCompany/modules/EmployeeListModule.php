<?php

namespace MyCompany;

class EmployeeListModule extends \Module
{
    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'myc_employee_list';

    /**
     * No markup
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
        $imgSize = deserialize($this->imgSize);

        $employeeData = \MyCompany\EmployeeModel::findMembersByIdAsArray($employeeIds);
        $curCompany = \MyCompany\CompanyModel::getById($this->mycCompany);

        $aEmployees = array();

        foreach($employeeData as $employee)
        {
            $aEmployees[] = \MyCompany\Helper\DataMaps::getEmployeeData($employee, $curCompany, $imgSize);
        }

        $this->Template->employees = $aEmployees;
        $this->Template->company = $curCompany;

    }

}
