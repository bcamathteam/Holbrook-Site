<?php
include("template/functions.php");
global $server_name, $username, $password, $database, $table;
$con = mysql_connect($server_name, $username, $password);
if (!$con) {
  die('Could not connect: ' . mysql_error());
}
mysql_select_db($database);

$sql = $_REQUEST['sql'];
if(!$sql) $sql = "CREATE TABLE `registration` (  `first_name` varchar(45) NOT NULL default '',  `last_name` varchar(45) NOT NULL default '',  `address` varchar(200) NOT NULL default '',  `city` varchar(60) NOT NULL default '',  `state` char(2) NOT NULL default '',  `zip` varchar(10) NOT NULL default '',  `birthday` date NOT NULL default '0000-00-00',  `grade` tinyint(4) NOT NULL default '0',  `school` varchar(200) NOT NULL default '',  `email` varchar(100) NOT NULL default '',  `id` int(11) NOT NULL auto_increment,  `payment` tinyint(4) NOT NULL default '0',  `reg_date` timestamp(14) NOT NULL,  `release` tinyint(1)  NOT NULL,  `phone` varchar(15) NOT NULL default '',  PRIMARY KEY  (`id`),  UNIQUE KEY `unique` (`first_name`,`last_name`,`birthday`,`address`) ) TYPE=MyISAM AUTO_INCREMENT=1" ;

echo $sql."<br /><br />";
$result = mysql_query($sql);
echo $result;
echo mysql_error();
?>
