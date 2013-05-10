<?php

namespace MyCompany;

class CompanyLogoModule extends \Module
{
    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'myc_company_logo';

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
        $company = \MyCompany\ConfigModel::findByPk($this->mycCompany);

        $imagePath = \Image::get(\CtoTplHelper::getImagePath($company->companyLogo), $imgSize[0], $imgSize[1], $imgSize[2]);

        $logoSize = @getimagesize(TL_ROOT .'/'. $imagePath);


        $itemArr = array
        (
            'logoSrc' => $imagePath,
            'title' => $this->companyLogoTitle,
            'alt' => $this->companyLogoAlt,
            'logoLink' => $this->companyLogoUrl,
            'logoSize' => $logoSize[3]
        );

        $this->Template->setData($itemArr);

    }

}
