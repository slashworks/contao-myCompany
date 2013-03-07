<?php

namespace Contao;

class MycInsertTags extends Frontend
{
    public $companysArr;
    public $documentType;

    public function generateInsertTags($strTag)
    {
        global $objPage;

        //set pageType
        $this->documentType = $objPage->outputFormat;

        $this->_getData($strTag);

        return $this->_companyActions();
    }

    /**
     * Actions for company insert tags
     * @return bool|string
     */
    private function _companyActions()
    {
        $_r = false;
        $curScope = $this->companysArr;

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
            case 'phoneBase':
                $_r = $this->_getPhoneBasic();
                break;
            case 'fax':
                $_r = $this->_getPhoneBasic($curScope['FaxDirectDial']);
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

        return $_r;
    }

    private function _getData($el)
    {
        $strip_prefix = str_replace('c_', '', $el);
        $itagArr = explode("::", $strip_prefix);
        $shorthandle = $itagArr[0];

        $t = MycConfigModel::getAllShorthandlesAsArray($shorthandle);

        if(is_array($t) && count($t) > 0)
        {
            $this->companysArr = $t;
            $this->companysArr['getItem'] = $itagArr[1];
        }
    }

    /**
     * address getter
     * @return string
     */
    private function _getAddress()
    {
        $_cfg = $this->companysArr;
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
        $_cfg = $this->companysArr;
        $itemsArr = array
        (
            'companyEmail'       => $this->_getEmail(),
            'companyPhone'       => $this->_getPhoneBasic($_cfg['phoneDirectDial']),
            'companyFax'         => $this->_getPhoneBasic($_cfg['FaxDirectDial'])
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
        $_cfg = $this->companysArr;

        // at symbol
        $_at = '@';

        //build the mail string
        $_mail = $_cfg['companyMainMail'].$_at.$_cfg['companyDomain'];

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
    private function _getPhoneBasic($number = false)
    {
        $_cfg = $this->companysArr;
        return $_cfg['phoneBasic'].'-'.$number;
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
            if($this->documentType == 'xhtml')
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
