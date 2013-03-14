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
namespace Contao;


/**
 * Reads and writes content elements
 *
 * @package   Models
 * @author    Leo Feyer <https://github.com/leofeyer>
 * @copyright Leo Feyer 2005-2013
 */

class MycConfigModel extends \Model
{

    /**
     * Table name
     * @var string
     */
    protected static $strTable = 'tl_mycConfig';

    public static function getAllCompanysAsArray()
    {
        $t = \Database::getInstance()->execute('SELECT id,name FROM tl_mycConfig');

        $data = array();

        while ($t->next())
        {
            $data[$t->id] = $t->name;
        }

        return $data;
    }

    public static function getAllShorthandlesAsArray($shorthandle)
    {
        $t = \Database::getInstance()->prepare("SELECT * from tl_mycConfig WHERE shorthandle = ?")->execute($shorthandle);
        return $t->row();
    }


}