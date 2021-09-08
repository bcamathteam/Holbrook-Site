<?php
include('../template/functions.php');

$regdate = ($_GET['regdate']) ?  $_GET['regdate']:'2010-6-20 01:02:03';
$sql = "select * from registration where reg_date > DATE('$regdate')";
if(isset($_GET['view'])) {
	switch($_GET['view']) {
		case "unpaid": $sql .= " and payment=99"; break;
		case "paypal": $sql .= " and payment=1"; break;
		case "check": $sql .= " and payment=10"; break;
		case "all": break;
		default: break;
	}
}
$sql .= " order by reg_date asc";

$result = execute_query($sql);
// echo "<!-- $sql -->\n";

//echo "<br>\n";
//echo mysql_num_rows($result);
header("Content-Type:text/csv");
header("Content-Disposition:attachment; filename=bcamc2010.csv");
echo "ID,Paid,Last Name,First Name,Address,City,State,Zip,Birthday,Grade,School,Email,Phone,Reg Date,Release\n";
while($row = mysql_fetch_array($result)) {
	echo $row['id'] . ",";
	//echo ($row['payment']==99 ? "no" : "yes") . ",";
	switch($row['payment']) {
	case 99: echo "no,"; break;
	case 1: echo "paypal,"; break;
	case 10: echo "check,"; break;
	default: echo "unknown,"; break;
	}
	echo $row['last_name'] . ",";
	echo $row['first_name'] . ",";
	echo str_replace(",","|",$row['address']) . ",";
	echo $row['city'] . ",";
	echo $row['state'] . ",";
	echo $row['zip'] . ",";
	echo $row['birthday'] . ",";
	echo $row['grade'] . ",";
	echo str_replace(",","|",$row['school']) . ",";
	echo $row['email'] . ",";
	echo $row['phone'] . ",";
	echo $row['reg_date'] . ",";
	echo ($row['release']==1 ? "yes" : "no") . "\n";
}
?>
