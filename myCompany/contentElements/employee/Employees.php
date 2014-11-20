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
        public function setBackendTemplateData()
        {

            return array
            (
                'title'   => 'Employee List',
                'content' => 'SHOW CHOSEN EMPLOYEES'

            );

        }


        /**
         * @return array
         */
        public function setTemplateData()
        {

            $employees = deserialize($this->mycEmployees);
            $data      = array();

            $imgSize = deserialize($this->size);

            foreach ($employees as $k => $v) {
                $employee   = EmployeeModel::getById($v);
                $curCompany = CompanyModel::findByPk($this->mycCompany);
                if (!empty($curCompany->logo)) {
                    $oLogo            = \FilesModel::findByUuid($curCompany->logo);
                    $sLogoPath        = $oLogo->path;
                    $curCompany->logo = $sLogoPath;
                }

                $curCompany->optionals = deserialize($curCompany->optionals);
                $curCompany->positions = deserialize($curCompany->positions);
                $curCompany->socials   = deserialize($curCompany->socials);

                $data['employees'][] = \MyCompany\Helper\DataMaps::getEmployeeData($employee, $curCompany, $imgSize, $this);
            }


            return $data;
        }

    }