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
     * @since       24.09.14 00:00
     * @package     MyCompany
     *
     */
    namespace MyCompany;

    use Contao\FilesModel;
    use MyCompany\Helper\Text;

    /**
     * Class InsertTagsEmployee
     *
     * @package MyCompany
     */
    class InsertTagsEmployee extends \Frontend
    {

        /**
         * @var
         */
        public $employees;

        /**
         * @var
         */
        public $documentType;


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


        /**
         * @return mixed
         */
        public function getEmployees()
        {

            return $this->employees;
        }


        /**
         * @param mixed $aEmployees
         */
        public function setEmployees($aEmployees)
        {

            $this->employees = $aEmployees;
        }


        /**
         * @param $strTag
         *
         * @return bool|string
         */
        public function generateInsertTags($strTag)
        {

            // check if the insertTag is from type company
            if (strpos($strTag, 'employee_') != 0) {
                return false;
            }


            global $objPage;

            //set pageType
            $this->setDocumentType($objPage->outputFormat);

            $this->_getData($strTag);


            $sReturn  = false;
            $curScope = $this->getEmployees();

            switch ($curScope['getItem']) {
                case 'nameFull':
                case 'fullName':
                    $sReturn = self::_generateFullName($curScope);
                    break;
                case 'name':
                    $sReturn = self::_generateName($curScope);
                    break;
                case 'picture':
                    $sReturn = self::_generatePicture($curScope);
                    break;
                case 'phone':
                    $sReturn = self::_generatePhone($curScope);
                    break;
                case 'fax':
                    $sReturn = self::_generateFax($curScope);
                    break;
                case 'companyPhoneDirectDial':
                    $sReturn = self::_generateCompanyPhoneDirectDial($curScope);
                    break;
                case 'companyPhoneDirect':
                    $sReturn = self::_generateCompanyPhoneDirect($curScope);
                    break;
                case 'companyFaxDirectDial':
                    $sReturn = self::_generateCompanyPhoneDirectDial($curScope);
                    break;
                case 'companyFaxDirect':
                    $sReturn = self::_generateCompanyFaxDirect($curScope);
                    break;
                case 'companyFax':
                    $sReturn = self::_generateCompanyFax($curScope);
                    break;
                case 'companyPhone':
                    $sReturn = self::_generateCompanyPhone($curScope);
                    break;
                case 'companyName':
                    $sReturn = self::_generateCompanyName($curScope);
                    break;
                case 'companyUrl':
                    $sReturn = self::_generateCompanyUrl($curScope);
                    break;
                case 'companyLogo':
                    $sReturn = self::_generateCompanyLogo($curScope);
                    break;
            }


            if ($sReturn === false) {
                if (isset($curScope[$curScope['getItem']])) {
                    $sReturn = $curScope[$curScope['getItem']];
                }
            }


            // HOOK
            if (isset($GLOBALS['TL_HOOKS']['mycEmployeeInsertTag']) && is_array($GLOBALS['TL_HOOKS']['mycEmployeeInsertTag'])) {
                foreach ($GLOBALS['TL_HOOKS']['mycEmployeeInsertTag'] as $callback) {
                    $this->import($callback[0]);
                    $sReturn = $this->$callback[0]->$callback[1]($strTag, $curScope, $this);
                }
            }


            return $sReturn;
        }


        /**
         * @param $el
         */
        private function _getData($el)
        {

            $strip_prefix = str_replace('employee_', '', $el);
            $itagArr      = explode("::", $strip_prefix);
            $shorthandle  = $itagArr[0];

            $t = \MyCompany\EmployeeModel::getAllShorthandlesAsArray($shorthandle);

            if (is_array($t) && count($t) > 0) {
                $t['getItem'] = $itagArr[1];
                $this->setEmployees($t);
            }
        }


        /**
         * @param $item
         *
         * @return string
         */
        private function _generateNameWTitle($item)
        {

            $title = ($item['title']) ? $item['title'] . ' ' : '';

            return $title . self::_generateName($item);
        }


        /**
         * @param $item
         *
         * @return string
         */
        private function _generateName($item)
        {

            return $item['surname'] . ' ' . $item['lastname'];
        }


        /**
         * @param $item
         *
         * @return string
         */
        private function _generateCompanyName($item)
        {

            $aCompany = CompanyModel::getById($item['company']);

            return $aCompany['name'] . ' ' . $aCompany['legalForm'];
        }


        /**
         * @param $item
         *
         * @return string
         */
        private function _generateCompanyPhoneDirectDial($item)
        {

            $aCompany = CompanyModel::getById($item['company']);

            return $aCompany['phoneDirectDial'];
        }


        /**
         * @param $item
         *
         * @return string
         */
        private function _generateCompanyPhoneDirect($item)
        {

            $aCompany = CompanyModel::getById($item['company']);

            return Text::formatPhoneNumber($aCompany['phoneBasic'], $aCompany['phoneDirectDial']);
        }


        /**
         * @param $item
         *
         * @return string
         */
        private function _generateCompanyFaxDirectDial($item)
        {

            $aCompany = CompanyModel::getById($item['company']);

            return $aCompany['faxDirectDial'];
        }


        /**
         * @param $item
         *
         * @return string
         */
        private function _generateCompanyFaxDirect($item)
        {

            $aCompany = CompanyModel::getById($item['company']);

            return Text::formatPhoneNumber($aCompany['faxBasic'], $aCompany['faxDirectDial']);
        }


        /**
         * @param $item
         *
         * @return string
         */
        private function _generateCompanyUrl($item)
        {

            $aCompany = CompanyModel::getById($item['company']);

            return $aCompany['domain'];
        }


        /**
         * @param $item
         *
         * @return string
         */
        private function _generateCompanyPhone($item)
        {

            $aCompany = CompanyModel::getById($item['company']);

            return $aCompany['phoneBasic'];
        }


        /**
         * @param $item
         *
         * @return string
         */
        private function _generateCompanyFax($item)
        {

            $aCompany = CompanyModel::getById($item['company']);

            return $aCompany['faxBasic'];
        }


        /**
         * @param $item
         *
         * @return string
         */
        private function _generatePhone($item)
        {

            $aCompany = CompanyModel::getById($item['company']);

            return Text::formatPhoneNumber($aCompany['phoneBasic'], $item['phoneExt']);
        }


        /**
         * @param $item
         *
         * @return string
         */
        private function _generateFax($item)
        {

            $aCompany = CompanyModel::getById($item['company']);

            return Text::formatPhoneNumber($aCompany['faxBasic'], $item['faxExt']);
        }


        /**
         * @param $item
         *
         * @return string
         */
        private function _generateCompanyLogo($item)
        {

            $aCompany = CompanyModel::getById($item['company']);
            $oFile    = FilesModel::findByUuid($aCompany['logo']);

            return $oFile->path;
        }


        /**
         * @param $item
         *
         * @return string
         */
        private function _generatePicture($item)
        {

            $oFile = FilesModel::findByUuid($item['picture']);

            return $oFile->path;
        }


        /**
         * @param $item
         *
         * @return string
         */
        private function _generateFullName($item)
        {

            return $item['title'] . ' ' . $item['surname'] . ' ' . $item['lastname'];
        }
    }




