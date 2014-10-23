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

    namespace MyCompany\CE;


    class Employee extends CeMycWrapper
    {

        public function setBeTplArr()
        {

            $employee     = \MyCompany\EmployeeModel::getById($this->mycEmployee);
            $employeeName = $employee['surname'] . ' ' . $employee['lastname'];

            return array
            (

                'title'   => 'Employee Data',
                'content' => $employeeName

            );

        }


        public function setTplDataArr()
        {

            $employee   = \MyCompany\EmployeeModel::getById($this->mycEmployee);
            $curCompany = \MyCompany\CompanyModel::findByPk($this->mycCompany);
            $imgSize    = deserialize($this->size);

            $aData = \MyCompany\Helper\DataMaps::getEmployeeData($employee, $curCompany, $imgSize, $this);


            return $aData;
        }

    }