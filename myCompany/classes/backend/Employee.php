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
     * @since       25.09.14 14:21
     * @package     MyCompany
     *
     */

    namespace MyCompany\Backend;

    use MyCompany\CompanyModel;
    use MyCompany\EmployeeDataModel;
    use MyCompany\EmployeeModel;


    /**
     * Class Employee
     *
     * @package MyCompany
     */
    class Employee extends MyCompanyBase
    {


        /**
         * @param $dc
         *
         * @return array
         */
        public function getEmployeeByCompany($dc)
        {

            return \MyCompany\EmployeeModel::getAllEmployeeByCompanyAsArray($dc->activeRecord->mycCompany);
        }


        /**
         * @return array
         */
        public function getEmployeeTemplates()
        {

            return $this->getTemplateGroup('ce_mycEmployee_');
        }


        /**
         * @param $objRecords
         * @param $strId
         *
         * @return string
         */
        public function generateWizardList($objRecords, $strId)
        {

            $strReturn = "";
            while ($objRecords->next()) {
                $oCompany = CompanyModel::getById($objRecords->company);
                $strReturn .= '<li><b>' . $objRecords->position . '</b> bei ' . $oCompany['name'] . '(ID: ' . $objRecords->id . ')' . '</li>';
            }

            return '<ul id="sort_' . $strId . '">' . $strReturn . '</ul>';
        }


        /**
         * @param $aData
         * @param $sLabel
         * @param $oDca
         *
         * @return string
         */
        public function getListLabel($aData, $sLabel, $oDca)
        {

            $sLabel = "<div style=\"margin:10px 0;font-size:1.1em;\"><strong>" . $aData['firstname'] . " " . $aData['lastname'] . "</strong></div>";
            $sLabel .= "<div style=\"padding:8px 8px 0 8px;margin-bottom:8px;float:none;\">";
            $aEmployeeData = EmployeeDataModel::getDataByEmployee($aData['id']);

            // sort by company
            uasort($aEmployeeData, function ($a, $b) {

                if ($a['company'] == $b['company']) {
                    return 0;
                }

                return ($a['company'] < $b['company']) ? -1 : 1;
            });

            foreach ($aEmployeeData as $aEmployee) {
                $aCompany = CompanyModel::getById($aEmployee['company']);
                $aLogo    = \FilesModel::findByUuid($aEmployee['picture']);
                $path     = \Image::get($aLogo->path, 48, 48, "proportional");
                $sLabel .= <<<LISTITEM
                    <div style="height:21px;float:left;width:56px;padding:0 10px 10px 10px;vertical-align:middle;display:inline-block;text-align:center;">
                        <div style="display:inline-block;height:100%;"></div><img src="{$path}" style="display:inline-block;vertical-align:middle;">
                    </div>
                    <div style="height:56px;float:left; margin-right:10px;padding-right:10px;border-right:1px solid #efefef;">
                        <b>{$aEmployee['position']}</b><br>
                        {$aCompany["name"]} {$aCompany["legalForm"]}<br>
                        <span style="color:#999">Kürzel: {$aEmployee['shorthandle']}</span>
                    </div>
LISTITEM;

            }
            $sLabel .= "</div>";

            return $sLabel;
        }


        public function deleteEmployeeData($oDt)
        {

            // Return if there is no ID
            if (!$oDt->id) {
                return;
            }

            $aChilds = EmployeeDataModel::getByPid($oDt->id);
            EmployeeDataModel::deleteAllByArray($aChilds);
        }


        /**
         * @param $objRecords
         * @param $strId
         *
         * @return string
         */
        public function generateEmployeeListByCompany($objRecords, $strId)
        {

            $strReturn = "";
            while ($objRecords->next()) {
                $aEmployee = EmployeeModel::getById($objRecords->pid);

                $strReturn .= '<li><b>' . $aEmployee['firstname'] . ' ' . $aEmployee['lastname'] . '</b> ' . $objRecords->position . '</li>';
            }

            return '<ul id="sort_' . $strId . '">' . $strReturn . '</ul>';
        }
    }