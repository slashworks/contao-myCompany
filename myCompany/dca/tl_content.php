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

    $GLOBALS['TL_DCA']['tl_content']['palettes']['mycEmployee']      = '{type_legend},type,mycCompany,mycEmployee;{image_legend},size;{protected_legend:hide},protected;{expert_legend:hide},mycTemplate,guests,cssID,space;{invisible_legend:hide},invisible,start,stop';
    $GLOBALS['TL_DCA']['tl_content']['palettes']['mycEmployees']     = '{type_legend},type,mycCompany,mycEmployees;{image_legend},size;{protected_legend:hide},protected;{expert_legend:hide},mycTemplate,guests,cssID,space;{invisible_legend:hide},invisible,start,stop';
    $GLOBALS['TL_DCA']['tl_content']['palettes']['mycRoutingButton'] = '{type_legend},type,mycCompany,linkTitle;{protected_legend:hide},protected;{expert_legend:hide},mycTemplate,guests,cssID,space;{invisible_legend:hide},invisible,start,stop';
    $GLOBALS['TL_DCA']['tl_content']['palettes']['mycStaticMap']     = '{type_legend},type,mycCompany,size;{protected_legend:hide},protected;{expert_legend:hide},mycTemplate,guests,cssID,space;{invisible_legend:hide},invisible,start,stop';


    $fields = array
    (
        'mycCompany'          => array
        (
            'label'            => &$GLOBALS['TL_LANG']['tl_content']['mycCompany'],
            'exclude'          => true,
            'filter'           => true,
            'inputType'        => 'select',
            'options_callback' => array('\MyCompany\CompanyModel', 'getAllCompaniesAsArray'),
            'eval'             => array('chosen' => true, 'submitOnChange' => true, 'includeBlankOption' => true),
            'sql'              => "varchar(32) NOT NULL default ''"
        ),

        'mycEmployee'         => array
        (
            'label'            => &$GLOBALS['TL_LANG']['tl_content']['mycEmployee'],
            'exclude'          => true,
            'filter'           => true,
            'inputType'        => 'select',
            'options_callback' => array('myCompany_tl_content', 'getEmployeeByCompany'),
            'eval'             => array('chosen' => true, 'submitOnChange' => true, 'includeBlankOption' => true),
            'sql'              => "varchar(32) NOT NULL default ''"
        ),

        'mycEmployees'        => array
        (
            'label'            => &$GLOBALS['TL_LANG']['tl_content']['mycEmployees'],
            'exclude'          => true,
            'filter'           => true,
            'inputType'        => 'checkboxWizard',
            //            'options_callback' => array('\MyCompany\EmployeeModel', 'getAllEmployeeAsArray'),
            'options_callback' => array('myCompany_tl_content', 'getEmployeeByCompany'),
            'eval'             => array('multiple' => true, 'helpwizard' => true),
            'sql'              => "blob NULL"
        ),

        'mycEmployeeTemplate' => array
        (
            'label'            => &$GLOBALS['TL_LANG']['tl_content']['mycEmployeeTemplate'],
            'exclude'          => true,
            'filter'           => true,
            'inputType'        => 'select',
            'options_callback' => array('myCompany_tl_content', 'getEmployeeTemplates'),
            'eval'             => array('chosen' => true),
            'sql'              => "varchar(64) NOT NULL default ''"
        ),

        'mycTemplate'         => array
        (
            'label'            => &$GLOBALS['TL_LANG']['tl_content']['mycTemplate'],
            'exclude'          => true,
            'filter'           => true,
            'inputType'        => 'select',
            'options_callback' => array('myCompany_tl_content', 'getMyCTemplate'),
            'eval'             => array('chosen' => true),
            'sql'              => "varchar(64) NOT NULL default ''"
        )
    );

    $GLOBALS['TL_DCA']['tl_content']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_content']['fields'], $fields);

    /**
     * Class myCompany_tl_content
     */
    class myCompany_tl_content extends Backend
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
         * @param $dc
         *
         * @return array
         */
        public function getMyCTemplate($dc)
        {

            return $this->getTemplateGroup('ce_' . $dc->activeRecord->type . '_');
        }

    }