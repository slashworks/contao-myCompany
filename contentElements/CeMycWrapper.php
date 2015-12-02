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


    use Contao\ContentElement;
    use Contao\FrontendTemplate;
    use SlashHelper\HelperTemplate;

    /**
     * Class CeMycWrapper
     *
     * @package MyCompany\CE
     */
    abstract class CeMycWrapper extends ContentElement
    {

        /**
         * @var string
         */
        protected $strTemplate = 'ce_mycwrapper';


        /**
         * @return mixed
         */
        abstract public function setTemplateData();


        /**
         * @return mixed
         */
        abstract public function setBackendTemplateData();


        /**
         *
         */
        public function compile()
        {


            if (TL_MODE == 'BE') {

                $tplname        = 'be_wildcard';
                $varsArr        = $this->setBackendTemplateData();
                $tpl            = new \BackendTemplate($tplname);
                $tpl->wildcard  = '### ' . $varsArr['title'] . ' ###';
                $tpl->title     = $varsArr['content'];
                $this->Template = $tpl;

            } else {

                // generate the template for the myCompany Module
                $partial = new FrontendTemplate($this->mycTemplate);

                // Add some template vars
                $partial->setData($this->setTemplateData());

                // implement the Template into the myCompany Template Wrapper
                $this->Template->partial = $partial->parse();
            }
        }


        /**
         * @param $item
         *
         * @return mixed
         */
        public function getLabel($item)
        {

            return $GLOBALS['TL_LANG']['myC'][$item];
        }

    }