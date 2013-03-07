-- ********************************************************
-- *                                                      *
-- * IMPORTANT NOTE                                       *
-- *                                                      *
-- * Do not import this file manually but use the Contao  *
-- * install tool to create and maintain database tables! *
-- *                                                      *
-- ********************************************************


-- --------------------------------------------------------

-- 
-- Table `tl_boziCustomers`
-- 

-- CREATE TABLE `tl_boziCustomers` (
--  `id` int(10) unsigned NOT NULL auto_increment,
--  `sorting` int(10) unsigned NOT NULL default '0',
--  `tstamp` int(10) unsigned NOT NULL default '0',
--  `name` varchar(255) NOT NULL default '',
--  `logo` varchar(255) NOT NULL default '',
--  `url` varchar(255) NOT NULL default '',
--  `description` text NULL,
--  PRIMARY KEY  (`id`)
--) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

-- 
-- Table `tl_boziCustomerStatements`
-- 

-- CREATE TABLE `tl_boziCustomerStatements` (
--  `id` int(10) unsigned NOT NULL auto_increment,
--  `sorting` int(10) unsigned NOT NULL default '0',
--  `tstamp` int(10) unsigned NOT NULL default '0',
--  `customerId` int(10) unsigned NOT NULL default '0',
--  `cite` text NULL,
--  `author` varchar(255) NOT NULL default '',
--  `authorTitle` varchar(255) NOT NULL default '',
--  PRIMARY KEY  (`id`),
--  KEY `customerId` (`customerId`)
--) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table `tl_attainment`
--

-- CREATE TABLE `tl_boziAttainment` (
--  `id` int(10) unsigned NOT NULL auto_increment,
--  `pid` int(10) unsigned NOT NULL default '0',
--  `sorting` int(10) unsigned NOT NULL default '0',
--  `tstamp` int(10) unsigned NOT NULL default '0',
--  `name` varchar(255) NOT NULL default '',
--  `logo` varchar(255) NOT NULL default '',
--  `teaser` text NULL,
--  PRIMARY KEY  (`id`),
--) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table `tl_mycConfig`
--

CREATE TABLE `tl_mycConfig` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `sorting` int(10) unsigned NOT NULL default '0',
  `tstamp` int(10) unsigned NOT NULL default '0',
  `companyName` varchar(255) NOT NULL default '',
  `companyStreet` varchar(255) NOT NULL default '',
  `companyZip` varchar(10) NOT NULL default '',
  `companyCity` varchar(255) NOT NULL default '',
  `companyPhoneBasic` varchar(255) NOT NULL default '',
  `companyPhoneDirectDial` varchar(255) NOT NULL default '',
  `companyFaxDirectDial` varchar(255) NOT NULL default '',
  `companyMainMail` varchar(255) NOT NULL default '',
  `companyLogo` varchar(255) NOT NULL default '',
  `companyDomain` varchar(255) NOT NULL default '',
  `facebook` varchar(255) NOT NULL default '',
  `xing` varchar(255) NOT NULL default '',
  `googlePlaces` varchar(255) NOT NULL default '',
  `companyPositions` blob NULL,
  `companyQualifications` blob NULL,
  PRIMARY KEY  (`id`),
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table `tl_boziTeam`
-- See dca this one is deprectaded
--

-- --------------------------------------------------------

--
-- Table `tl_boziTeam`
--

--CREATE TABLE `tl_boziPinBoard` (
--  `id` int(10) unsigned NOT NULL auto_increment,
--  `pid` int(10) unsigned NOT NULL default '0',
--  `sorting` int(10) unsigned NOT NULL default '0',
--  `tstamp` int(10) unsigned NOT NULL default '0',
--  `title` varchar(255) NOT NULL default '',
--  `alias` varbinary(128) NOT NULL default '',
--  `type` varchar(32) NOT NULL default '',
--  `customer` varchar(32) NOT NULL default '',
--  `shortDescription` mediumtext NULL,
--  `description` text NULL,
--  `previewPicture` varchar(255) NOT NULL default '',
--  `gallery` blob NULL,
--  `published` char(1) NOT NULL default '',
--  `date` varchar(10) NOT NULL default '',
--  `addContactPerson` char(1) NOT NULL default '',
--  `contactPerson` varchar(32) NOT NULL default '',
--  `addCustomerReview` char(1) NOT NULL default '',
--  `customerReview` int(10) NOT NULL default '0',
--  `addRelatedNews` char(1) NOT NULL default '',
--  `relatedNews` int(10) NOT NULL default '0',
--  `addRelatedProjects` char(1) NOT NULL default '',
--  `relatedProjects` blob NULL,
--  PRIMARY KEY  (`id`),
--  KEY `pid` (`pid`),
--  KEY `alias` (`alias`)
--) ENGINE=MyISAM DEFAULT CHARSET=utf8;