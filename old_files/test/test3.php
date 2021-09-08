<HTML>

<?
$user = "1mathteam1";
$password = "M@th11";
$database = "mathcomp";

mysql_connect("168.229.7.7", $user, $password);
@mysql_select_db($database) or die("Unable to select database");
#$query = "create table test ( id int, fname varchar(15), lname varchar(15) )";
#$query = "insert into test ( 1, 'Bob', 'Test')";
$query = "select * from test";
$result = mysql_query($query);

$num = mysql_numrows($result);
mysql_close();

$i = 0;

echo $num;
while ($i < $num) {
$id = mysql_result($result, $i, "id");
$fname = mysql_result($result, $i, "fname");
$lname = mysql_result($result, $i, "lname");
$i++;

echo "ID: $id\pFirst Name: $fname\pLast Name: $lname";
}

?>
</HTML>
