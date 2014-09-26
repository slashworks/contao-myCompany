<?php
 /**
 *
 *          _           _                       _
 *         | |         | |                     | |
 *      ___| | __ _ ___| |____      _____  _ __| | _____
 *     / __| |/ _` / __| '_ \ \ /\ / / _ \| '__| |/ / __|
 *     \__ \ | (_| \__ \ | | \ V  V / (_) | |  |   <\__ \
 *     |___/_|\__,_|___/_| |_|\_/\_/ \___/|_|  |_|\_\___/
 *                                        web development
 *
 *     http://www.slash-works.de </> hallo@slash-works.de
 *
 *
 * @author      rwollenburg
 * @copyright   rwollenburg@slashworks
 * @since       25.09.14 14:41
 * @package     Core
 *
 */
    namespace MyCompany;

class EmployeeModel extends \Model{

    public static function getById($id){
        $oEmployeeResult = \Database::getInstance()->execute('SELECT * FROM tl_mycEmployee WHERE id = "'.$id.'"');

        return $oEmployeeResult->row();
    }
}