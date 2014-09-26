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
 * @package     Core
 *
 */

namespace MyCompany;


class Employee extends \Backend {

    public function generateWizardList($objRecords, $strId){
        $strReturn = "";
        while ($objRecords->next()) {
            $oCompany = CompanyModel::getById($objRecords->company);
            $strReturn .= '<li><b>' . $objRecords->position . '</b> bei '.$oCompany['name'].'(ID: ' . $objRecords->id . ')' . '</li>';
        }

        return '<ul id="sort_' . $strId . '">' . $strReturn . '</ul>';
    }



   public function generateEmployeeListByCompany($objRecords, $strId){
       $strReturn = "";
        while($objRecords->next()){
            $aEmployee = EmployeeModel::getById($objRecords->pid);

            $strReturn .= '<li><b>' . $aEmployee['surname']. ' '.$aEmployee['lastname'].'</b> '.$objRecords->position. '</li>';
        }

       return '<ul id="sort_' . $strId . '">' . $strReturn . '</ul>';
    }



} 