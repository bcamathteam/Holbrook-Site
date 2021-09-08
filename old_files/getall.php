TABLES:<br>
<?php
mysql_connect("localhost", "1mathteam1", "M@th11");
$result = mysql_list_tables("mathcomp");
$num_rows = mysql_num_rows($result);
for ($i = 0; $i < $num_rows; $i++) {
   echo "Table: ", mysql_tablename($result, $i), "<br>\n";
}

mysql_free_result($result);
?> 
<br>REGISTRATION:<br>
<?
include('functions.php');
$result = execute_query("EXPLAIN mathcomp");
if (mysql_num_rows($result) > 0) {
   while ($row = mysql_fetch_assoc($result)) {
       print_r($row);
   }
} else echo "bad table";
?>
<br>DATA:<br>
<?
$result = execute_query("select * from registration");
echo mysql_num_rows($result);
while($row = mysql_fetch_array($result)) {
	print(nl2br(print_r($row)));
	echo "<br>";
}

?>
<br>INSERT:<br>
<?
$result = execute_query("INSERT INTO $table (first_name, last_name, address, city, state, zip, birthday, grade, school, email, payment, release) VALUES('test','test','test','test','NJ','08080','2009-09-09','6','test','test@test.org', 99, 1)");
echo "INSERT INTO $table (first_name, last_name, address, city, state, zip, birthday, grade, school, email, payment, release) VALUES('test','test','test','test','NJ','08080','2009-09-09','6','test','test@test.org', 99, 1)";
echo mysql_num_rows($result);
while($row = mysql_fetch_array($result)) {
	print(nl2br(print_r($row)));
	echo "<br>";
}

?>