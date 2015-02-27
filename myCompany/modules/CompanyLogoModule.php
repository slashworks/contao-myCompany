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

    use SlashHelper\HelperFile;

    /**
     * Class CompanyLogoModule
     *
     * @package MyCompany
     */
    class CompanyLogoModule extends \Module
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

            global $objPage;

            $imgSize = deserialize($this->imgSize);
            $company = CompanyModel::findByPk($this->mycCompany);

            $imagePath = \Image::get(HelperFile::getPath($company->logo), $imgSize[0], $imgSize[1], $imgSize[2]);

            $logoSize = @getimagesize(TL_ROOT . '/' . $imagePath);


            $itemArr = array
            (
                'logoSrc'  => $imagePath,
                'title'    => $this->companyLogoTitle,
                'alt'      => $this->companyLogoAlt,
                'logoLink' => $this->companyLogoUrl,
                'logoSize' => $logoSize[3]
            );


            // HOOK
            if (isset($GLOBALS['TL_HOOKS']['mycModifyCompanyLogo']) && is_array($GLOBALS['TL_HOOKS']['mycModifyCompanyLogo'])) {
                foreach ($GLOBALS['TL_HOOKS']['mycModifyCompanyLogo'] as $callback) {
                    $this->import($callback[0]);
                    $this->$callback[0]->$callback[1]($itemArr, $company, $this);
                }
            }

            // generate the template for the myCompany Module
            $mycModuleTpl = new \FrontendTemplate($this->mycTemplate);

            // Add some template vars
            $mycModuleTpl->setData($itemArr);

            // implement the Template into the myCompany Template Wrapper
            $this->Template->mycModule = $mycModuleTpl->parse();

        }

    }
