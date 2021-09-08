<?
//phpinfo();
include("template/functions.php");
print_r($_REQUEST);
print_r($_SESSION);

//echo execute_query("DROP TABLE IF EXISTS `registration`");
echo execute_query("CREATE TABLE IF NOT EXISTS `registration` (  `first_name` varchar(45) NOT NULL default '',  `last_name` varchar(45) NOT NULL default '',  `address` varchar(200) NOT NULL default '',  `city` varchar(60) NOT NULL default '',  `state` char(2) NOT NULL default '',  `zip` varchar(10) NOT NULL default '',  `birthday` date NOT NULL default '0000-00-00',  `grade` tinyint(4) NOT NULL default '0',  `school` varchar(200) NOT NULL default '',  `email` varchar(100) NOT NULL default '',  `id` int(11) NOT NULL auto_increment,  `payment` tinyint(4) NOT NULL default '0',  `reg_date` timestamp(14) NOT NULL,  `phone` varchar(15) NOT NULL default '',  PRIMARY KEY  (`id`),  UNIQUE KEY `unique` (`first_name`,`last_name`,`birthday`,`address`) ) TYPE=MyISAM AUTO_INCREMENT=1");
//echo execute_query("CREATE TABLE IF NOT EXISTS `registration` (`first_name` varchar(45) NOT NULL default '', `last_name` varchar(45) NOT NULL default '', `address` varchar(200) NOT NULL default '', `city` varchar(60) NOT NULL default '', `state` char(2) NOT NULL default '', `zip` varchar(10) NOT NULL default '', `birthday` date NOT NULL default '0000-00-00', `grade` tinyint(4) NOT NULL default '0', `school` varchar(200) NOT NULL default '', `email` varchar(100) NOT NULL default '', `id` int(11) NOT NULL auto_increment, `payment` tinyint(4) NOT NULL default '0', `reg_date` timestamp(14) NOT NULL, PRIMARY KEY  (`id`), UNIQUE KEY `unique` (`first_name`,`last_name`,`birthday`,`address`) ) TYPE=MyISAM AUTO_INCREMENT=1");



?>
