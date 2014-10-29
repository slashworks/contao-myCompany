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
     * @since       29.10.14 15:35
     * @package     MyCompany
     *
     */


    namespace MyCompany\CE;


    use MyCompany\EmployeeModel;
    use MyCompany\CompanyModel;

    class Company extends CeMycWrapper
    {

        public function setBackendTemplateData()
        {

            $aCompany     = \MyCompany\CompanyModel::getById($this->mycCompany);
            return array
            (
                'title'   => 'Company Data',
                'content' => $aCompany['name']
            );

        }


        public function setTemplateData()
        {

            $aCompany     = \MyCompany\CompanyModel::getById($this->mycCompany);
            $imgSize    = deserialize($this->size);
            $aData = \MyCompany\Helper\DataMaps::getCompanyData($aCompany,$imgSize, $this);
            $aData['mycAddressBlockRows'] = array();
            $aTmp = deserialize($this->mycAddressBlockRows);

            foreach($aTmp as $key => $row){
                if(stristr($row,":") !== false){
                    $fields = explode(":",$row);
                }else{
                    $fields = array($row);
                }


                foreach($fields as $fieldKey => $field){
                    if(!empty($aData[$field])) {
                        $fields[$fieldKey] = $aData[$field];
                    }else{
                        unset($fields[$fieldKey]);
                    }
                }

                $aData['mycAddressBlockRows'][] = implode(" ",$fields);
            }

            return $aData;
        }

    }