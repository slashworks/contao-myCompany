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

class MycTeamModel extends \Model
{

    /**
     * Table name
     * @var string
     */
    protected static $strTable = 'tl_mycTeam';

    public static function getAllMemberAsArray()
    {
        $t = \Database::getInstance()->execute('SELECT id,surname,lastname FROM tl_mycTeam');

        $data = array();

        while ($t->next())
        {
            $data[$t->id] = $t->surname.' '.$t->lastname;
        }

        return $data;
    }

    public static function findMembersByIdAsArray($memberArr)
    {
        if(is_array($memberArr))
        {
            $membersStr = implode($memberArr, ',');

            $t = \Database::getInstance()->prepare("SELECT * FROM tl_mycTeam WHERE id IN(".$membersStr.")")->execute();

            $data = array();

            while ($t->next())
            {
                $data[] = $t->row();
            }

            return $data;
        }

        return array();
    }
}