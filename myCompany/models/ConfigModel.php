<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2013 Leo Feyer
 *
 * @package Core
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace MyCompany;


/**
 * Reads and writes content elements
 *
 * @package   Models
 * @author    Leo Feyer <https://github.com/leofeyer>
 * @copyright Leo Feyer 2005-2013
 */

class ConfigModel extends \Model
{

    /**
     * Table name
     * @var string
     */
    protected static $strTable = 'tl_mycConfig';

    public static function getAllCompaniesAsArray()
    {
        $t = \Database::getInstance()->execute('SELECT id,companyName FROM tl_mycConfig');

        $data = array();

        while ($t->next())
        {
            $data[$t->id] = $t->companyName;
        }

        return $data;
    }

    public static function getAllPositionsAsArray()
    {
        // select company id from active member
        $c = \Database::getInstance()->prepare('SELECT company FROM tl_mycTeam WHERE id=?')->execute(\Input::get('id'));

        while ($c->next())
        {
            $companyId = $c->company;
        }

        // if member has no company (e. g. when creating a new member), get first company id
        if(!$companyId)
        {
            $objCompanyId = \Database::getInstance()->execute('SELECT id FROM tl_mycConfig LIMIT 1');
            while ($objCompanyId->next())
            {
                $companyId = $objCompanyId->id;
            }
        }

        // get all positions from the company
        $objPositions = \Database::getInstance()->prepare('SELECT companyPositions FROM tl_mycConfig WHERE id=?')->execute($companyId);
        $arrPositions = array();

        while ($objPositions->next())
        {
            $arrPositions = deserialize($objPositions->companyPositions);
        }

        return $arrPositions;
    }

    public static function getAllShorthandlesAsArray($shorthandle)
    {
        $t = \Database::getInstance()->prepare("SELECT * from tl_mycConfig WHERE shorthandle = ?")->execute($shorthandle);
        return $t->row();
    }


}