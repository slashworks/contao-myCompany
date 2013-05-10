<?php



$GLOBALS['TL_DCA']['tl_module']['palettes']['mycTeam'] = '{title_legend},name,headline,type;mycCompany,mycTeamMember,imgSize;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_module']['palettes']['mycCompanyLogo'] = '{title_legend},name,headline,type;mycCompany,imgSize,companyLogoUrl,companyLogoTitle,companyLogoAlt;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';

/*$GLOBALS['TL_DCA']['tl_module']['palettes']['boziPinboradByGroup'] = '{title_legend},name,headline,type;boziPinBoardGroup';
$GLOBALS['TL_DCA']['tl_module']['palettes']['boziCustomerList'] = '{title_legend},name,headline,type;imgSize';
$GLOBALS['TL_DCA']['tl_module']['palettes']['boziPinboardSortable'] = '{title_legend},name,headline,type;imgSize,boziPinBoardItems';*/

$fields = array
(
    'mycCompany' => array
    (
        'label'                   => &$GLOBALS['TL_LANG']['tl_module']['mycCompany'],
        'exclude'                 => true,
        'inputType'               => 'select',
        'options_callback'        => array('\MyCompany\ConfigModel', 'getAllCompaniesAsArray'),
        'eval'                    => array('includeBlankOption'=>true, 'submitOnChange' => true),
        'sql'                     => "varchar(32) NOT NULL default ''"
    ),

    'mycTeamMember' => array
    (
        'label'                   => &$GLOBALS['TL_LANG']['tl_module']['mycTeamMember'],
        'exclude'                 => true,
        'inputType'               => 'checkboxWizard',
        'options_callback'        => array('tl_mycModule', 'getTeamMembersByCompany'),
        'eval'                    => array('multiple'=>true),
        'sql'                     => "blob NULL"
    ),

    'companyLogoUrl' => array
    (
        'label'                   => &$GLOBALS['TL_LANG']['MSC']['url'],
        'exclude'                 => true,
        'search'                  => true,
        'inputType'               => 'text',
        'eval'                    => array('mandatory'=>true, 'rgxp'=>'url', 'decodeEntities'=>true, 'maxlength'=>255, 'fieldType'=>'radio', 'tl_class'=>'w50 wizard'),
        'wizard' => array
        (
            array('tl_mycModule', 'pagePicker')
        ),
        'sql'                     => "varchar(255) NOT NULL default ''"
    ),

    'companyLogoTitle' => array
    (
        'label'                   => &$GLOBALS['TL_LANG']['tl_content']['title'],
        'exclude'                 => true,
        'search'                  => true,
        'inputType'               => 'text',
        'sql'                     => "varchar(255) NOT NULL default ''"
    ),

    'companyLogoAlt' => array
    (
        'label'                   => &$GLOBALS['TL_LANG']['tl_content']['alt'],
        'exclude'                 => true,
        'search'                  => true,
        'inputType'               => 'text',
        'sql'                     => "varchar(255) NOT NULL default ''"
    )
);

$GLOBALS['TL_DCA']['tl_module']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_module']['fields'], $fields);

class tl_mycModule extends Backend
{
    public function getTeamMembersByCompany($dc)
    {
        $t = \MyCompany\TeamModel::getAllMemberByCompanyAsArray($dc->activeRecord->mycCompany);

        if(count($t) > 0) {
            return \MyCompany\TeamModel::getAllMemberByCompanyAsArray($dc->activeRecord->mycCompany);
        }

    }

    /**
     * Return the link picker wizard
     * @param \DataContainer
     * @return string
     */
    public function pagePicker(DataContainer $dc)
    {
        return ' <a href="contao/page.php?do='.Input::get('do').'&amp;table='.$dc->table.'&amp;field='.$dc->field.'&amp;value='.str_replace(array('{{link_url::', '}}'), '', $dc->value).'" title="'.specialchars($GLOBALS['TL_LANG']['MSC']['pagepicker']).'" onclick="Backend.getScrollOffset();Backend.openModalSelector({\'width\':765,\'title\':\''.specialchars(str_replace("'", "\\'", $GLOBALS['TL_LANG']['MOD']['page'][0])).'\',\'url\':this.href,\'id\':\''.$dc->field.'\',\'tag\':\'ctrl_'.$dc->field . ((Input::get('act') == 'editAll') ? '_' . $dc->id : '').'\',\'self\':this});return false">' . $this->generateImage('pickpage.gif', $GLOBALS['TL_LANG']['MSC']['pagepicker'], 'style="vertical-align:top;cursor:pointer"') . '</a>';
    }
}