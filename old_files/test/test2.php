<?
phpinfo();
?>


<?
$user = "1mathteam1";
$password = "M@th11";
$database = "mathcomp";

$link = mysql_connect("168.229.7.7", $user, $password);
@mysql_select_db($database, $link) or die("Unable to select database");
#$query = "create table test ( id int, fname varchar(15), lname varchar(15) )";
$query = "insert into test values (1, 'Bob', 'Test')";
$res = mysql_query($query, $link);

echo mysql_errno($link) . ": " . mysql_error($link) . "\n";
mysql_close();
?>
