<?php

namespace MyCompany;

use SlashHelper\HelperFile;

class CompanyLogoModule extends \Module
{
    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'mod_myc_wrapper';

    /**
     * No markup
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
        $company = CompanysModel::findByPk($this->mycCompany);

        $imagePath = \Image::get(HelperFile::getPath($company->logo), $imgSize[0], $imgSize[1], $imgSize[2]);

        $logoSize = @getimagesize(TL_ROOT .'/'. $imagePath);


        $itemArr = array
        (
            'logoSrc' => $imagePath,
            'title' => $this->companyLogoTitle,
            'alt' => $this->companyLogoAlt,
            'logoLink' => $this->companyLogoUrl,
            'logoSize' => $logoSize[3]
        );

        // generate the template for the myCompany Module
        $mycModuleTpl = new \FrontendTemplate($this->mycTemplate);

        // Add some template vars
        $mycModuleTpl->setData($itemArr);

        // implement the Template into the myCompany Template Wrapper
        $this->Template->mycModule = $mycModuleTpl->parse();

    }

}
