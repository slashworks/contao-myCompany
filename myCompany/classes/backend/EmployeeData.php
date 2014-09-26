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
 * @since       25.09.14 11:53
 * @package     MyCompany
 *
 */

namespace MyCompany;


use Contao\DataContainer;

class EmployeeData extends \Backend {

    public function generateWizardList($objRecords, $strId){
        $strReturn = "
<style>
    .mycEmployeeListItem{
        padding:8px 8px 0 8px;
        margin-bottom:8px;
        border-bottom:1px solid #efefef;
        float:none;

    }

    .mycEmployeeDataColumn{
        height:56px;

    }

    .mycEmployeeDataImageColumn{
        width:56px;
        padding:0 10px 10px 10px;
        float:left;

    }
</style>";


        while ($objRecords->next()) {
            $oCompany = CompanyModel::getById($objRecords->company);
            $aLogo = \FilesModel::findByUuid($oCompany['logo']);
            $path = \Image::get($aLogo->path,48,48,"proportional");
            $strReturn .= <<<LISTITEM
            <li class="mycEmployeeListItem">
                <div class="mycEmployeeDataColumn mycEmployeeDataImageColumn">
                    <img src="{$path}">
                </div>
                <div class="mycEmployeeDataColumn">
                    <b>{$objRecords->position}</b><br>
                    {$oCompany["name"]} {$oCompany["legalForm"]}<br>
                    <span style="color:#999">Kürzel: {$objRecords->shorthandle}</span>
                </div>
            </li>
LISTITEM;

        }

        return '<ul id="sort_' . $strId . '">' . $strReturn . '</ul>';
    }


    public function filterList(){
        $company = \Input::get("filter");
        $id = \Input::get('id');
        if(!empty($id) && !empty($company)) {
//            $GLOBALS['TL_DCA']["tl_mycEmployeeData"]['list']['sorting']['filter'][] = array('company=?', $id);
        }
    }


    public function getLabel($row, $label){


        $iColWidth = 70;
        return "<div style='padding:10px 0;'><b>".$row['position']."</b><br><span style='color:#888;display:inline-block;width:".$iColWidth."px;margin-top:5px;'>E-Mail:</span><a style='color:#888;' href='mailto:".$row['email']."'>".$row['email']."</a><br><span style='color:#888;display:inline-block;width:".$iColWidth."px;'>Durchwahl:</span><span style='color:#888'>".$row['phoneExt']."</span><br><span style='color:#888;display:inline-block;width:".$iColWidth."px;'>Kürzel.:</span><span style='color:#888;display:inline-block;'> ".$row['shorthandle']."</span></div>";
    }


    public function getGroupLabel($group, $mode, $field, $row){
        $oCompany = CompanyModel::getById($row['company']);
        $aLogo = \FilesModel::findByUuid($oCompany['logo']);
        $path = \Image::get($aLogo->path,128,48,"proportional");

        $html = "<div style='padding:16px;overflow: hidden;'>
            <div style='background:transparent url(".$path.") center center no-repeat; float:left;margin-right: 10px;display:table-cell;vertical-align:middle;height:48px;'><img src='".$path."' style='visibility:hidden;'></div>
            <div style='font-size:1.4em;display:table-cell;vertical-align:middle;height:48px;'>".$oCompany['name']." ".$oCompany['legalForm']."</div>
            </div>
        ";



        return $html;
    }



    public function getTableName(){
        return "tl_mycEmployeeData";
    }

    public function getPositionsByCompany(DataContainer $oDc){
        $aPositions = array();

        if(!empty($oDc->activeRecord->company)){
            $oCompany = CompanyModel::getById($oDc->activeRecord->company);
            $aTmpPositions = deserialize($oCompany['positions']);
            foreach($aTmpPositions as $pos){
                $aPositions[] = $pos['name'];
            }
        }else{
            $aPositions[''] = $GLOBALS['TL_LANG']['tl_mycEmployeeData']['position_default'];
        }
        return $aPositions;
    }

} 