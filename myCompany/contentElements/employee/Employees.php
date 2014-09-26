<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jrgregory
 * Date: 18.03.13
 * Time: 11:12
 * To change this template use File | Settings | File Templates.
 */

namespace MyCompany\CE;


use MyCompany\CompanyModel;
use MyCompany\EmployeeModel;

/**
 * Class TeamMembers
 *
 * @package MyCompany\CE
 */
class Employees extends CeMycWrapper
{

    /**
     * @return array
     */
    public function setBeTplArr()
    {

        return array
        (
            'title' => 'Employee List',
            'content' => 'SHOW CHOSEN EMPLOYEES'

        );

    }


    /**
     * @return array
     */
    public function setTplDataArr()
    {

        $employees = deserialize($this->mycEmployees);
        $data = array();

        $imgSize = deserialize($this->size);

        foreach($employees as $k => $v) {

            $employee = EmployeeModel::getById($v);
            $curCompany = CompanyModel::findByPk($employee->company);
            $data['employees'][] = \MyCompany\Helper\DataMaps::getEmployeeData($employee, $curCompany, $imgSize, $this);
        }

        return $data;
    }

}