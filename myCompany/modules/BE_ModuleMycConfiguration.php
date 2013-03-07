<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2012 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Leo Feyer 2005-2012
 * @author     Leo Feyer <http://www.contao.org>
 * @package    TaskCenter
 * @license    LGPL
 * @filesource
 */


/**
 * Class ModuleTasks
 *
 * Back end module "BE_ModuleBoziConfiguration".
 * @copyright  Joe Ray Gregory 2012 @ borowiakziehe KG
 * @author     Joe Ray Gregory @ borowiakziehe KG <http://www.borowiakziehe.de>
 * @package    Controller
 */
class BE_ModuleMycConfiguration extends BackendModule
{
    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'be_mycConfig';

    /**
     * Generate the module
     */
    protected function compile()
    {
        $this->import('BackendUser', 'User');
        $this->import('Files');
        $this->loadLanguageFile('tl_mycConfig');
        $this->buildForm();
    }

    /** buildForm
     *
     */
    private function buildForm() {

        $getValues = $this->Database->prepare("SELECT * FROM tl_mycConfig")
            ->execute();

        /* Create a data Aaray to Automate the progress */
        $formElements = array
        (
            'NameAndAddress' => array
            (
                'fieldset' => $GLOBALS['TL_LANG']['tl_mycConfig']['fieldsets']['NameAndAddress'],
                'data' => array
                (
                    'companyName' => $this->textField('companyName', $getValues->companyName, array('mandatory', true)),
                    'companyStreet' => $this->textField('companyStreet', $getValues->companyStreet, array('mandatory', true)),
                    'companyZip' => $this->textField('companyZip', $getValues->companyZip, array('mandatory', true)),
                    'companyCity' => $this->textField('companyCity', $getValues->companyCity, array('mandatory', true)),
                    'companyLogo' => $this->generateFilePicker('companyLogo', $getValues->companyLogo),
                )
            ),
            'PhoneAndFax' => array
            (
                'fieldset' => $GLOBALS['TL_LANG']['tl_mycConfig']['fieldsets']['PhoneAndFax'],
                'data' => array
                (
                    'companyPhoneBasic' => $this->textField('companyPhoneBasic', $getValues->companyPhoneBasic, array('mandatory', true)),
                    'companyPhoneDirectDial' => $this->textField('companyPhoneDirectDial', $getValues->companyPhoneDirectDial, array('mandatory', true)),
                    'companyFaxDirectDial' => $this->textField('companyFaxDirectDial', $getValues->companyFaxDirectDial, array('mandatory', true))
                )
            ),
            'MailAndDomains' => array
            (
                'fieldset' => $GLOBALS['TL_LANG']['tl_mycConfig']['fieldsets']['MailAndDomains'],
                'data' => array
                (
                    'companyDomain' => $this->textField('companyDomain', $getValues->companyDomain, array('mandatory', true)),
                    'companyMainMail' => $this->textField('companyMainMail', $getValues->companyMainMail, array('mandatory', true)),
                )

            ),
            'Structure' => array
            (
                'fieldset' => $GLOBALS['TL_LANG']['tl_mycConfig']['fieldsets']['Structure'],
                'data' => array
                (
                    'companyPositions' => $this->generateTeamPositions('companyPositions', $getValues->companyPositions),
                    'companyQualifications' => $this->generateTeamPositions('companyQualifications', $getValues->companyQualifications)
                )
            ),
            'Syntication' => array
            (
                'fieldset' => $GLOBALS['TL_LANG']['tl_mycConfig']['fieldsets']['Syntication'],
                'data' => array
                (
                    'facebook' => $this->textField('facebook', $getValues->facebook, array('mandatory', true)),
                    'xing' => $this->textField('xing', $getValues->xing, array('mandatory', true)),
                    'googlePlaces' => $this->textField('googlePlaces', $getValues->googlePlaces, array('mandatory', true)),
                )
            )
        );

        $this->Template->FormElements = $formElements;


        $this->Template->submit = $GLOBALS['TL_LANG']['tl_mycConfig']['submit'];
        $this->Template->headline = $GLOBALS['TL_LANG']['tl_mycConfig']['headline'];
        $this->Template->request = ampersand($this->Environment->request, true);

        if($this->Input->post('FORM_SUBMIT') == 'tl_mycConfig')
        {
            /*
             * Dynamic config update via the data array
             */
            $options = array();
            foreach($formElements as $k => $v) {
                foreach(array_keys($v['data']) as $val)
                {
                    $options[$val] = $this->Input->post($val);
                }
            }

            Database::getInstance()->prepare("UPDATE tl_mycConfig %s")->set($options)->execute($options);
            $this->redirect('contao/main.php?do=mycConfiguration');
        }
    }


    /** generate textField
     * @param $field
     * @param null $value
     * @param bool $options
     * @return string
     */
    protected function textField($field, $value=null, $options = false)
    {
        $widget = new TextField();

        $widget->id = $field;
        $widget->name = $field;
        $widget->value = $value;

        if($options && is_array($options)) {
            foreach($options as $key=>$val) {
                $widget->$key = $val;
            }
        }

        $widget->label = $GLOBALS['TL_LANG']['tl_mycConfig'][$field][0];

        // Valiate input
        if ($this->Input->post('FORM_SUBMIT') == 'tl_mycConfig')
        {
            $widget->validate();

            if ($widget->hasErrors())
            {
                $this->blnSave = false;
            }
        }
        $out = '<div class="w50">
        <h3>'.$widget->generateLabel().'</h3>
        '.$widget->generateWithError().'
        <p class="tl_help tl_tip">'.$GLOBALS['TL_LANG']['tl_mycConfig'][$field][1].'</p>
        </div>';

        return $out;
    }

    /** generate filepicker field
     * @param $field
     * @param null $value
     * @param bool $options
     * @return string
     */
    protected function generateFilePicker($field, $value=null, $options = false)
    {
        $widget = new Upload();
        $widget->id = $field;
        $widget->name = $field;
        $widget->value = $value;
        $widget->tl_class = 'clr';
        //echo $widget->strTable;

        $widget->label = $GLOBALS['TL_LANG']['tl_mycConfig'][$field][0];
        $out = '<div class="long">
        <h3>'.$widget->generateLabel().'</h3>
        '.$widget->generateWithError().'
        <p class="tl_help tl_tip">'.$GLOBALS['TL_LANG']['tl_mycConfig'][$field][1].'</p>
        </div>';
        return $out;
    }

    /** generates a List wizard to add multiple positions for the company
     * @param $field
     * @param null $value
     * @param bool $options
     * @return string
     */
    protected function generateTeamPositions($field, $value=null, $options = false)
    {
        $widget = new ListWizard();
        $widget->id = $field;
        $widget->name = $field;
        $widget->value = $value;
        $widget->tl_class = 'clr';

        //print_r($widget);
        $widget->label = $GLOBALS['TL_LANG']['tl_mycConfig'][$field][0];
        $out = '<div class="clr long wizard">
        <h3>'.$widget->generateLabel().'</h3>
        '.$widget->generateWithError().'
        <p class="tl_help tl_tip">'.$GLOBALS['TL_LANG']['tl_mycConfig'][$field][1].'</p>
        </div>';
        return $out;
    }
}