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
     * @since       22.10.14 15:58
     * @package     MyCompany
     *
     */


    namespace MyCompany\Backend;


    /**
     * Class Employee
     *
     * @package MyCompany
     */
    class MyCompanyBase extends \Backend
    {


        /**
         * @param $dc
         *
         * @return array
         */
        public function getMyCTemplate($dc)
        {

            $aTemplateGroup = $this->getTemplateGroup('ce_' . $dc->activeRecord->type . '_');
            foreach($aTemplateGroup as $key => $value){
                $aTemplateGroup[$key] = &$GLOBALS['TL_LANG']['MSC']['MyCompany']['template'][$value];
            }

            return $aTemplateGroup;
        }
    }