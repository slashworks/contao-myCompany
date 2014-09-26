<?php

namespace MyCompany;

class InsertTagsCompany extends \Frontend
{
    public $companies;

    public $documentType;


    /**
     * @return mixed
     */
    public function getCompany()
    {

        return $this->companies;
    }


    /**
     * @param mixed $companies
     */
    public function setCompany($companies)
    {

        $this->companies = $companies;
    }


    /**
     * @return mixed
     */
    public function getDocumentType()
    {

        return $this->documentType;
    }


    /**
     * @param mixed $documentType
     */
    public function setDocumentType($documentType)
    {

        $this->documentType = $documentType;
    }


    public function generateInsertTags($strTag)
    {

        // check if the insertTag is from type company
        if(strpos($strTag, 'company_') != 0) {
            return false;
        }

        global $objPage;

        //set pageType
        $this->setDocumentType($objPage->outputFormat);

        $this->_getData($strTag);

        return $this->_companyActions($strTag);
    }

    /**
     * Actions for company insert tags
     * @return bool|string
     */
    private function _companyActions($strTag)
    {
        $_r = false;
        $curScope = $this->getCompany();

        switch($curScope['getItem'])
        {
            case 'zip':
                $_r = $curScope['zip'];
                break;
            case 'name':
                $_r = $curScope['name'];
                break;
            case 'street':
                $_r = $curScope['street'];
                break;
            case 'city':
                $_r = $curScope['city'];
                break;
            case 'mail':
                $_r = $this->_getEmail();
                break;
            case 'mailPlain':
                $_r = $this->_getEmail(true);
                break;
            case 'phone':
                $_r = $this->_getPhoneBasic($curScope['phoneDirectDial']);
                break;
            case 'fax':
                $_r = $this->_getPhoneBasic($curScope['faxDirectDial']);
                break;
            case 'address':
                $_r = $this->_getAddress();
                break;
            case 'contactNoLabel':
                $_r = $this->_getContact();
                break;
            case 'contact':
                $_r = $this->_getContact(true);
                break;
        }

        if(strpos($curScope['getItem'], 'opt_') === 0 && strpos($strTag, 'company_') === 0)
        {

            $optionals = deserialize($curScope['optionals']);
            $value = str_replace('opt_', '', $curScope['getItem']);

            foreach($optionals as $k => $v)
            {
                if($v['label'] === $value) {
                    $_r = $v['optiontext'];
                    break;
                }

            }
        }

        return $_r;
    }

    private function _getData($el)
    {
        $strip_prefix = str_replace('company_', '', $el);
        $itagArr = explode("::", $strip_prefix);
        $shorthandle = $itagArr[0];

        $t = \MyCompany\CompanyModel::getAllShorthandlesAsArray($shorthandle);

        if(is_array($t) && count($t) > 0)
        {
            $t['getItem'] = $itagArr[1];
            $this->setCompany($t);
        }
    }

    /**
     * address getter
     * @return string
     */
    private function _getAddress()
    {
        $_cfg = $this->getCompany();
        $itemsArr = array
        (
            'companyName'       => $_cfg['name'],
            'companyStreet'     => $_cfg['street'],
            'companyZipCity'    => $_cfg['zip'].' '.$_cfg['city']
        );
        $out = $this->blockBuilder($itemsArr);
        return $out;
    }

    /**
     * @param bool $useLabel
     * @return string
     */
    private function _getContact($useLabel = false)
    {
        $_cfg = $this->getCompany();
        $itemsArr = array
        (
            'companyEmail'       => $this->_getEmail(),
            'companyPhone'       => $this->_getPhoneBasic($_cfg['phoneDirectDial']),
            'companyFax'         => $this->_getPhoneBasic($_cfg['faxDirectDial'])
        );
        $out = $this->blockBuilder($itemsArr, $useLabel);
        return $out;
    }

    /**
     * email getter
     * @param bool $plain
     * @return bool|string
     */
    private function _getEmail($plain = false)
    {
        $_r = false;

        // get the Data Array
        $_cfg = $this->getCompany();

        //build the mail string
        $_mail = $_cfg['email'];

        //check if is plain or not
        if($plain === true)
        {
            $_r = $_mail;
        } else {
            $_r = '<a href="mailto:'.$_mail.'">'.$_mail.'</a>';
        }

        return $_r;
    }

    /**
     * phone getter
     * @param bool $number
     * @return string
     */
    private function _getPhoneBasic($number)
    {
        $_cfg = $this->getCompany();
        return $_cfg['phoneBasic']."-".$number;
    }

    /**
     * Helper for html building
     * @param $arr
     * @param bool $useLabel
     * @param string $wrap
     * @param string $seperator
     * @return string
     * @throws Exception
     */
    private function blockBuilder($arr, $useLabel = false, $wrap = 'span', $seperator = 'br')
    {
        if(is_array($arr))
        {
            if($this->getDocumentType() == 'xhtml')
            {
                $seperator .= ' /';
            }

            $_out = '';
            foreach($arr as $key=>$item)
            {
                if($useLabel)
                {
                    $_out .= '<'.$wrap.' class="'.$key.'-label">'.$GLOBALS['TL_LANG']['MSC']['company'][$key].'</'.$wrap.'>';
                }
                $_out .= '<'.$wrap.' class="'.$key.'">'.$item.'</'.$wrap.'><'.$seperator.'>';
            }
            return $_out;
        } else {
            throw new Exception("Parameter 1 must be an array!");
        }
    }
}
