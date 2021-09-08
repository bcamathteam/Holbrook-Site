<?php
include('template/functions.php');
global $server_name, $username, $password, $database, $table;
$tname = ((isset($_GET["table"])) ? $_GET["table"] : $table);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Backup Table <?php echo $tname; ?></title>
</head>
<body>
<h1>Backup Table <?php echo $tname; ?></h1><br />
<?php
include 'config.php';
include 'opendb.php';

$con = mysql_connect($server_name, $username, $password);
if (!$con) {
  die('Could not connect: ' . mysql_error());
}

mysql_select_db($database);

$backupFile = $tname.'.sql';
$query = "SELECT * FROM ".$tname." INTO OUTFILE '".$backupFile."'";
$result = mysql_query($query);
echo mysql_error()."<br />";
echo $result;
include 'closedb.php';
?> 
</body>
</html>
