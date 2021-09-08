<?
phpinfo();
?>


<?
$user = "1mathteam1";
$password = "M@th11";
$database = "mathcomp";

mysql_connect("168.229.7.7", $user, $password);
@mysql_select_db($database) or die("Unable to select database");
$query = "create table test ( id int, fname varchar(15), lname varchar(15) )";
mysql_query($query);
mysql_close();
?>