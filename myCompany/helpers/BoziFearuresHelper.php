<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2011 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Joe Ray Gregory @ borowiakziehe KG 2012
 * @author     Joe Ray Gregory
 * @package    BoziFeatures
 * @license    LGPL
 * @filesource
 */


/**
 * Class BoziFearuresHelper
 *
 * @copyright  Joe Ray Gregory @ borowiakziehe KG 2012
 * @author     Joe Ray Gregory
 * @package    Controller
 */

class BoziFearuresHelper extends Backend {

    /** Internal Simple Query Helper
     * @param $table
     * @param $fields
     * @return Database_Result
     */
    private function simpleQuery($table,$fields)
    {
        $obj = $this->Database->prepare('SELECT '.$fields.' FROM '.$table)->execute();
        return $obj;
    }

    /** Internal Blob Helper
     * @param $table
     * @param $field
     * @return mixed
     */
    private function getBlob($table,$field)
    {
        $obj = $this->simpleQuery($table,$field);
        $data =  deserialize($obj->$field);
        return $data;
    }

    /** Return all Company Positions
     * @return mixed
     */
    public function getCompanyPositions() {
        return $this->getBlob('tl_mycConfig', 'CompanyPositions');
    }

    /** Return all Qulifactions from Config File
     * @return mixed
     */
    public function getCompanyQualifications()
    {
        return $this->getBlob('tl_mycConfig', 'companyQualifications');
    }

    /**
     * @return array
     */
    public function getNewsJornals()
    {
        $obj = $this->Database->prepare('SELECT id, headline FROM tl_news WHERE pid=?')->execute(2);
        $data =  array();
        while($obj->next())
        {
            $data[$obj->id] = $obj->headline;
        }

        return $data;
    }

    /** Return all Persons
     * @return array
     */
    public function getContactPersons()
    {
        $obj = $this->simpleQuery('tl_mycTeam', 'id,surname,lastname');
        $data =  array();
        while($obj->next())
        {
            $data[$obj->id] = $obj->surname.' '.$obj->lastname;
        }

        return $data;
    }

    /** Return all Projects
     * @return array
     */
    public function getProjects()
    {
        $obj = $this->Database->prepare('SELECT id, title FROM tl_boziPinBoard')->execute();
        $data =  array();
        while($obj->next())
        {
            $data[$obj->id] = $obj->title;
        }
        return $data;
    }
}