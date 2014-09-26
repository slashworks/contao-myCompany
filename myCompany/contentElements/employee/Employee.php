<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jrgregory
 * Date: 18.03.13
 * Time: 11:12
 * To change this template use File | Settings | File Templates.
 */

namespace MyCompany\CE;



class Employee extends CeMycWrapper
{

    public function setBeTplArr()
    {

        $employee = \MyCompany\EmployeeModel::getById($this->mycEmployee);
        $employeeName = $employee['surname'].' '.$employee['lastname'];

        return array
        (

            'title' => 'Employee Data',
            'content' => $employeeName

        );

    }


    public function setTplDataArr()
    {

        $employee = \MyCompany\EmployeeModel::getById($this->mycEmployee);
        $curCompany = \MyCompany\CompanyModel::findByPk($this->mycCompany);
        $imgSize = deserialize($this->size);

        $aData = \MyCompany\Helper\DataMaps::getEmployeeData($employee, $curCompany, $imgSize, $this);

        return $aData;
    }

}