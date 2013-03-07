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
 * Fields
 */
$GLOBALS['TL_LANG']['tl_mycConfig']['companyName'] = array('Firmen Name', 'Geben Sie hier den Firmennamen ein');
$GLOBALS['TL_LANG']['tl_mycConfig']['companyPhoneBasic'] = array('Telefonnummer ohne Durchwahl', 'Geben Sie hier die Telefonnummer ohne Durchwahl an! Diese Nummer steht Ihnen dann bei jeder Person Ihres Unternehmens zur Verfügung.');
$GLOBALS['TL_LANG']['tl_mycConfig']['companyPhoneDirectDial'] = array('Durchwahlwahlnummer zur Zentrale', 'Geben Sie hier die Durchwahl zur Zentrale an.');
$GLOBALS['TL_LANG']['tl_mycConfig']['companyFaxDirectDial'] = array('Durchwahlwahlnummer für Ihr Fax', 'Geben Sie hier den Firmennamen ein');
$GLOBALS['TL_LANG']['tl_mycConfig']['companyMainMail'] = array('E-Mail Adresse', 'Die Kontakt E-Mail Adresse');
$GLOBALS['TL_LANG']['tl_mycConfig']['companyLogo'] = array('Firmen Logo', 'Wählen Sie hier ihr Firmenlogo aus. Dieses kann dann für Verschiedene Bereich der Seite verwendet werden.');
$GLOBALS['TL_LANG']['tl_mycConfig']['companyPositions'] = array('Positionen innerhalb der Firma', 'Legen sie hier die Positionen innerhalb Ihrer Firma fest. Diese können Sie dann Ihren Personen im Unternehmen zuweisen. Somit ist es später dann möglich nur die Geschäftsführer auszuwählen.');
$GLOBALS['TL_LANG']['tl_mycConfig']['companyQualifications'] = array('Qualifikationen', 'Legen sie hier die Qualifikationen fest welche Personen später z.B. Personen zugeordnet werden können.');
$GLOBALS['TL_LANG']['tl_mycConfig']['companyStreet'] = array('Straße', 'Die Straße in der Ihr Firmensitz sich befindet inklusive Nummer.');
$GLOBALS['TL_LANG']['tl_mycConfig']['companyZip'] = array('Postleitzahl', 'Die Postleitzahl Ihres Ortes.');
$GLOBALS['TL_LANG']['tl_mycConfig']['companyCity'] = array('Ort', 'Der Ort in dem Ihr Unternehmen sitzt.');
$GLOBALS['TL_LANG']['tl_mycConfig']['companyDomain'] = array('Webseite ohne www und ohne http', 'Tragen sie bitte hier Ihre Webseite ohne http und www ein. Diese kann dann für E-Mails und weitere urls verwendet werden.');
$GLOBALS['TL_LANG']['tl_mycConfig']['facebook'] = array('Link zur Facebook Seite', 'Tragen sie hier den vollständigen Pfad zu Facebook ein.');
$GLOBALS['TL_LANG']['tl_mycConfig']['xing'] = array('Link zur Xing Seite', 'Tragen sie hier den vollständigen Pfad zu xing ein.');
$GLOBALS['TL_LANG']['tl_mycConfig']['googlePlaces'] = array('Link zur Google Places Seite', 'Tragen sie hier den vollständigen Pfad zu Google Places ein.');
$GLOBALS['TL_LANG']['tl_mycConfig']['submit'] = 'Konfiguration Speichern';
$GLOBALS['TL_LANG']['tl_mycConfig']['headline'] = 'Firmen Konfiguration';
/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_boziCustomers'][''] = '';

$GLOBALS['TL_LANG']['tl_mycConfig']['fieldsets']['NameAndAddress'] = 'Name und Anschrift';
$GLOBALS['TL_LANG']['tl_mycConfig']['fieldsets']['PhoneAndFax'] = 'Einstellungen für Telefon und Fax';
$GLOBALS['TL_LANG']['tl_mycConfig']['fieldsets']['MailAndDomains'] = 'Einstellungen für Domains und E-Mails';
$GLOBALS['TL_LANG']['tl_mycConfig']['fieldsets']['Structure'] = 'Einstellungen für Firmenstrukturen';
$GLOBALS['TL_LANG']['tl_mycConfig']['fieldsets']['Syntication'] = 'Unternehmens Syndikationen';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_boziAttainment']['new']    = array('Leistung hinzufügen', 'Einen neuen Kunden hinzufügen');
$GLOBALS['TL_LANG']['tl_boziAttainment']['edit']   = array('Diese Leistung bearbeiten', 'Klicken Sie hier wenn Sie die Leistung bearbeiten wollen');
$GLOBALS['TL_LANG']['tl_boziAttainment']['copy']   = array('Diese Leistung kopieren', 'Klicken Sie hier wenn Sie die Leistung kopieren wollen');
$GLOBALS['TL_LANG']['tl_boziAttainment']['delete'] = array('Diese Leistung löschen', 'Klicken Sie hier wenn Sie die Leistung löschen wollen');
$GLOBALS['TL_LANG']['tl_boziAttainment']['show']   = array('Informationen anzeigen', 'Klicken Sie hier wenn Sie den Information über diese Leistung sehen möchten.');