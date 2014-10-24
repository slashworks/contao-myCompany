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

    namespace MyCompany;

    use Contao\FrontendTemplate;

    /**
     * Class SocialMediaLinks
     *
     * @package MyCompany
     */
    class SocialMediaLinks extends \Module
    {

        /**
         * Template
         *
         * @var string
         */
        protected $strTemplate = 'mod_myc_wrapper';

        /**
         * No markup
         *
         * @var boolean
         */
        protected $blnNoMarkup = false;


        /**
         * Generate the module
         */
        protected function compile()
        {

            // get current company and all social fields
            $company = CompanysModel::findByPk($this->mycCompany);
            $socials = deserialize($company->socials);

            // new data array to collect the new items
            $dataArr = array();

            // get and convert the Module social links data
            $companySocialLinksArr = deserialize($this->companySocialLinks);

            /**
             * Workaround to compare multicolumn wizard blob data
             */

            foreach ($companySocialLinksArr as $s) {

                foreach ($socials as $social) {

                    // Match the chosen items with all company fields and get data like urls etc.
                    if ($s == $social['name']) {
                        $dataArr[] = array
                        (
                            'name'     => $social['name'],
                            'url'      => $social['url'],
                            'cssClass' => 'myc_social_' . standardize($social['name'])
                        );
                    }
                }

            }

            // Add first and last css class
            $dataArr[0]['cssClass'] .= ' first';
            $dataArr[count($dataArr) - 1]['cssClass'] .= ' last';


            // HOOK
            if (isset($GLOBALS['TL_HOOKS']['mycModifySocialMediaLinks']) && is_array($GLOBALS['TL_HOOKS']['mycModifySocialMediaLinks'])) {
                foreach ($GLOBALS['TL_HOOKS']['mycModifySocialMediaLinks'] as $callback) {
                    $this->import($callback[0]);
                    $this->$callback[0]->$callback[1]($dataArr, $companySocialLinksArr, $company, $this);
                }
            }


            // generate the template for the myCompany Module
            $mycModuleTpl = new FrontendTemplate($this->mycTemplate);

            // Add some template vars
            $mycModuleTpl->links = $dataArr;

            // implement the Template into the myCompany Template Wrapper
            $this->Template->mycModule = $mycModuleTpl->parse();

        }

    }
