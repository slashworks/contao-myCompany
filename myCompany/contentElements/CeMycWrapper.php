<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jrgregory
 * Date: 10.10.13
 * Time: 13:49
 * To change this template use File | Settings | File Templates.
 */

namespace MyCompany\CE;


use Contao\ContentElement;
use Contao\FrontendTemplate;
use SlashHelper\HelperTemplate;

abstract class CeMycWrapper extends ContentElement {

    protected $strTemplate = 'ce_mycwrapper';

    abstract public function setTplDataArr();

    abstract public function setBeTplArr();

    public function compile()
    {


        if (TL_MODE == 'BE')
        {
            $varsArr = $this->setBETplArr();
            $this->Template = HelperTemplate::wildCard($varsArr['content'], $varsArr['title']);

        }

        else

        {

            // generate the template for the myCompany Module
            $partial = new FrontendTemplate($this->mycTemplate);

            // Add some template vars
            $partial->setData($this->setTplDataArr());

            // implement the Template into the myCompany Template Wrapper


            $this->Template->partial = $partial->parse();
        }

    }

    public function getLabel($item) {
        return $GLOBALS['TL_LANG']['myC'][$item];
    }

}