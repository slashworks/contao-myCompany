<?php

namespace MyCompany;

class InsertTagsMember extends \Frontend
{

    public $memberArr;
    public $documentType;

    public function generateInsertTags($strTag)
    {
        // check if the insertTag is from type company
        if(strpos($strTag, 'cmember_') != 0) {
            return false;
        }



        global $objPage;

        //set pageType
        $this->documentType = $objPage->outputFormat;

        $this->_getData($strTag);

        return $this->_memberActions();
    }

    /**
     * Actions for company insert tags
     * @return bool|string
     */
    private function _memberActions()
    {
        $_r = false;
        $curScope = $this->memberArr;

        switch($curScope['getItem'])
        {
            case 'nameFull':
                $_r = self::_generateNameWTitle($curScope);
                break;
            case 'name':
                $_r = self::_generateName($curScope);
                break;
            case 'surname':
                $_r = self::_generateName($curScope);
                break;
            case 'lastname':
                $_r = self::_generateName($curScope);
                break;
            case 'title':
                $_r = self::_generateName($curScope);
                break;
            case 'about':
                $_r = self::_generateName($curScope);
                break;
            case 'phone':
                $_r = self::_generateName($curScope);
                break;
            case 'mail':
                $_r = self::_generateName($curScope);
                break;
        }

        return $_r;
    }

    private function _getData($el)
    {
        $strip_prefix = str_replace('cmember_', '', $el);
        $itagArr = explode("::", $strip_prefix);
        $shorthandle = $itagArr[0];

        $t = \MyCompany\TeamMembersModel::getAllShorthandlesAsArray($shorthandle);


        if(is_array($t) && count($t) > 0)
        {
            $this->memberArr = $t;
            $this->memberArr['getItem'] = $itagArr[1];
        }
    }

    private function _generateNameWTitle($item)
    {
        $title = ($item['title']) ? $item['title'] . ' ': '';
        return $title.self::_generateName($item);
    }

    private function _generateName($item)
    {
        return $item['surname'] . ' ' . $item['lastname'];
    }
}
