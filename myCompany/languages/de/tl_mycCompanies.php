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


    /**
     * Fields
     */
    $GLOBALS['TL_LANG']['tl_mycCompanies']['name'][0]            = 'Firmenname';
    $GLOBALS['TL_LANG']['tl_mycCompanies']['name'][1]            = 'Geben Sie hier den Firmennamen ein.';
    $GLOBALS['TL_LANG']['tl_mycCompanies']['legalForm'][0]       = 'Rechtsform';
    $GLOBALS['TL_LANG']['tl_mycCompanies']['legalForm'][1]       = 'Tragen Sie hier die Rechtsform des Unternehmens ein. Z.B. GmbH, GbR, OHG, KG';
    $GLOBALS['TL_LANG']['tl_mycCompanies']['shorthandle'][0]     = 'Abkürzung';
    $GLOBALS['TL_LANG']['tl_mycCompanies']['shorthandle'][1]     = 'Geben Sie hier die Abkürzung Ihrer Firma ein.';
    $GLOBALS['TL_LANG']['tl_mycCompanies']['country'][0]         = 'Land';
    $GLOBALS['TL_LANG']['tl_mycCompanies']['country'][1]         = 'Wählen Sie das Land aus in dem ihre Firma ansässig ist.';
    $GLOBALS['TL_LANG']['tl_mycCompanies']['phoneBasic'][0]      = 'Telefonnummer ohne Durchwahl';
    $GLOBALS['TL_LANG']['tl_mycCompanies']['phoneBasic'][1]      = 'Geben Sie hier die Telefonnummer (ohne Durchwahl!) an. Diese Nummer steht Ihnen dann bei jeder Person Ihres Unternehmens zur Verfügung.';
    $GLOBALS['TL_LANG']['tl_mycCompanies']['phoneDirectDial'][0] = 'Durchwahlwahlnummer zur Zentrale';
    $GLOBALS['TL_LANG']['tl_mycCompanies']['phoneDirectDial'][1] = 'Geben Sie hier die Durchwahl zur Zentrale an.';
    $GLOBALS['TL_LANG']['tl_mycCompanies']['faxDirectDial'][0]   = 'Durchwahlwahlnummer für Ihr Fax';
    $GLOBALS['TL_LANG']['tl_mycCompanies']['faxDirectDial'][1]   = 'Geben Sie hier die Durchwahlnummer für Fax ein.';
    $GLOBALS['TL_LANG']['tl_mycCompanies']['mainMail'][0]        = 'E-Mail-Adresse';
    $GLOBALS['TL_LANG']['tl_mycCompanies']['mainMail'][1]        = 'Geben Sie hier die Kontakt E-Mail-Adresse';
    $GLOBALS['TL_LANG']['tl_mycCompanies']['logo'][0]            = 'Firmenlogo';
    $GLOBALS['TL_LANG']['tl_mycCompanies']['logo'][1]            = 'Wählen Sie hier Ihr Firmenlogo aus. Dieses kann dann in Verschiedenen Bereichen der Seite verwendet werden.';
    $GLOBALS['TL_LANG']['tl_mycCompanies']['positions'][0]       = 'Positionen innerhalb der Firma';
    $GLOBALS['TL_LANG']['tl_mycCompanies']['positions'][1]       = 'Legen sie hier die Positionen innerhalb Ihrer Firma fest. Diese können Sie dann  Personen im Unternehmen zuweisen. Dadurch ist es später möglich, nur einzelne Positionen (z. B. Buchführung) auszuwählen.';
    $GLOBALS['TL_LANG']['tl_mycCompanies']['qualifications'][0]  = 'Qualifikationen';
    $GLOBALS['TL_LANG']['tl_mycCompanies']['qualifications'][1]  = 'Legen sie hier die Qualifikationen fest, später Personen zugeordnet werden können.';
    $GLOBALS['TL_LANG']['tl_mycCompanies']['street'][0]          = 'Straße';
    $GLOBALS['TL_LANG']['tl_mycCompanies']['street'][1]          = 'Die Straße, in der Ihr Firmensitz sich befindet, inklusive Nummer.';
    $GLOBALS['TL_LANG']['tl_mycCompanies']['zip'][0]             = 'Postleitzahl';
    $GLOBALS['TL_LANG']['tl_mycCompanies']['zip'][1]             = 'Die Postleitzahl Ihres Ortes.';
    $GLOBALS['TL_LANG']['tl_mycCompanies']['city'][0]            = 'Ort';
    $GLOBALS['TL_LANG']['tl_mycCompanies']['city'][1]            = 'Der Ort, in dem Ihr Unternehmen sitzt.';
    $GLOBALS['TL_LANG']['tl_mycCompanies']['domain'][0]          = 'Webseite ohne www und ohne http';
    $GLOBALS['TL_LANG']['tl_mycCompanies']['domain'][1]          = 'Tragen Sie bitte hier Ihre Webseite ohne http und www ein. Diese kann dann für E-Mails und weitere URLs verwendet werden.';
    $GLOBALS['TL_LANG']['tl_mycCompanies']['socials'][0]         = 'Link zu vernetzten Seiten';
    $GLOBALS['TL_LANG']['tl_mycCompanies']['socials'][1]         = 'Tragen Sie hier den Namen und die Url zur Sozialen Vernetzung ein. Xing, Twitter, Facebook, Google+ etc.';
    $GLOBALS['TL_LANG']['tl_mycCompanies']['socials']['name']    = 'Name';
    $GLOBALS['TL_LANG']['tl_mycCompanies']['socials']['url']     = 'Link (url)';
    $GLOBALS['TL_LANG']['tl_mycCompanies']['submit']             = 'Konfiguration Speichern';
    $GLOBALS['TL_LANG']['tl_mycCompanies']['headline']           = 'Firmen Konfiguration';


    /**
     * Legends
     */
    $GLOBALS['TL_LANG']['tl_mycCompanies']['address_legend']       = 'Adressdaten';
    $GLOBALS['TL_LANG']['tl_mycCompanies']['address_logo']         = 'Firmenlogo';
    $GLOBALS['TL_LANG']['tl_mycCompanies']['contact_legend']       = 'Kontaktdaten';
    $GLOBALS['TL_LANG']['tl_mycCompanies']['mailAndDomain_legend'] = 'Internetadresse und E-Mail';
    $GLOBALS['TL_LANG']['tl_mycCompanies']['structure_legend']     = 'Interne Strukturen';
    $GLOBALS['TL_LANG']['tl_mycCompanies']['syndications_legend']  = 'Social Media Links';

    /**
     * Reference
     */
    $GLOBALS['TL_LANG']['tl_boziCustomers'][''] = '';

    $GLOBALS['TL_LANG']['tl_mycCompanies']['fieldsets']['NameAndAddress'] = 'Name und Anschrift';
    $GLOBALS['TL_LANG']['tl_mycCompanies']['fieldsets']['PhoneAndFax']    = 'Einstellungen für Telefon und Fax';
    $GLOBALS['TL_LANG']['tl_mycCompanies']['fieldsets']['MailAndDomains'] = 'Einstellungen für Domains und E-Mails';
    $GLOBALS['TL_LANG']['tl_mycCompanies']['fieldsets']['Structure']      = 'Einstellungen für Firmenstrukturen';
    $GLOBALS['TL_LANG']['tl_mycCompanies']['fieldsets']['Syndication']    = 'Unternehmens Syndikationen';


    /**
     * Buttons
     */
    $GLOBALS['TL_LANG']['tl_mycCompanies']['new'][0]      = 'Neue Firmenonfiguration';
    $GLOBALS['TL_LANG']['tl_mycCompanies']['new'][1]      = 'Eine neue Firmenkonfiguration hinzufügen.';
    $GLOBALS['TL_LANG']['tl_boziAttainment']['new'][0]    = 'Leistung hinzufügen';
    $GLOBALS['TL_LANG']['tl_boziAttainment']['new'][1]    = 'Einen neuen Kunden hinzufügen';
    $GLOBALS['TL_LANG']['tl_boziAttainment']['edit'][0]   = 'Diese Leistung bearbeiten';
    $GLOBALS['TL_LANG']['tl_boziAttainment']['edit'][1]   = 'Klicken Sie hier wenn Sie die Leistung bearbeiten wollen';
    $GLOBALS['TL_LANG']['tl_boziAttainment']['copy'][0]   = 'Diese Leistung kopieren';
    $GLOBALS['TL_LANG']['tl_boziAttainment']['copy'][1]   = 'Klicken Sie hier wenn Sie die Leistung kopieren wollen';
    $GLOBALS['TL_LANG']['tl_boziAttainment']['delete'][0] = 'Diese Leistung löschen';
    $GLOBALS['TL_LANG']['tl_boziAttainment']['delete'][1] = 'Klicken Sie hier wenn Sie die Leistung löschen wollen';
    $GLOBALS['TL_LANG']['tl_boziAttainment']['show'][0]   = 'Informationen anzeigen';
    $GLOBALS['TL_LANG']['tl_boziAttainment']['show'][1]   = 'Klicken Sie hier wenn Sie den Information über diese Leistung sehen möchten.';