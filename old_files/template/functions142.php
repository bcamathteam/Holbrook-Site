<?php
/*********************************************************************\
 * template/functions.php - php to mysql conduit                     *
 * BCA Math Competition Site                                         *
 * Author: Rajesh Ramakrishnan                                       *
 * Creation Date: 2006-May-24                                        *
\*********************************************************************/

//----------------------------------------------------------------------------+
// Constants -- These are the only things that should be changed in this file |
//----------------------------------------------------------------------------+

//mysql stuff
$use_mysql = 1; //enable sql
//$use_mysql = 0; //disable sql

$server_name = "localhost";
$server_name = "127.0.0.1"; // may need to change back to localhost
$username = "1mathteam1";
$password = "M@th11";
$database = "mathcomp";
$table = "registration";

//paypal stuff
$base_url = "http://sites.bergen.org/mathcompetition/"; //trailing '/' necessary
//$paypal = "https://www.sandbox.paypal.com/cgi-bin/webscr"; // use for demo registration
//$paypal = "demo.php"; // use for flat-file registration
$paypal = "https://www.paypal.com/cgi-bin/webscr"; // use for live registration
//$account = "testiness@test.org";

$account = "slpatel@verizon.net";
//--------------------------------------------------------------------+
// First-order Functions -- These may need some tweaking in migration |
//--------------------------------------------------------------------+

/// Connects to mysql to make an SQL query.
/// $query - string containing an SQL query to execute
/// returns: -2 on connection failure
///          -1 on database failure
///           0 on query failure
///    resource on success
function execute_query($query) {
	/// grab the values from above
	global $server_name, $username, $password, $database;
	//echo("$server_name, $username, $password, $database, $table");

	/// set up database handle (suppress errors with @)
	$db_handle = mysql_connect($server_name,$username,$password);
	if(!$db_handle) return -2; //did not connect to mysql server
	if(!(mysql_select_db($database,$db_handle))) return -1; //did not select database

	/// run query
	$result = mysql_query($query,$db_handle);
	if(!$result) return 0; /* failed execution*/
	return $result; //success
}

/// Connects to mysql and gets row count.
/// $resource - mysql resource
/// returns: -1 on fetch failure
///   row count on success
function row_count($resource) {
	return mysql_num_rows($resource);
}

/// Connects to mysql and grabs row to an associative array.
/// $resource - mysql resource
/// returns: -1 on fetch failure
///         row on success
function get_array($resource) {
	return mysql_fetch_array($resource);
}

//--------------------------------------------------------------------------+
// Second-order Functions -- These should not require tweaking in migration |
//--------------------------------------------------------------------------+

function register($fn,$ln,$addr,$city,$state,$zip,$bday,$grade,$school,$email,$release,$phone) {
	/// grab table name
	global $table;

	/// check current records
	$sql = "SELECT * FROM $table WHERE first_name='$fn' AND last_name='$ln' AND birthday='$bday' AND payment!=99";
	$result = execute_query($sql);
	//echo "check 0:" . $result . "--" . row_count($result) ."<br>\n"; //should be a resource id
	if($result <= 0) return 30 - $result;
	if(row_count($result) != 0) return 34;

	/// add new record
	$sql = "INSERT INTO $table (first_name, last_name, address, city, state, zip, birthday, grade, school, email, payment, `release`, `phone`) ";
	$sql .= "VALUES('$fn','$ln','$addr','$city','$state','$zip','$bday','$grade','$school','$email', 99, $release, '$phone')";
	//return $sql;
	$result = execute_query($sql);
   //echo "check 1:" . $result . "\n"; //should be 1
	//if($result <= 0) return 20 - $result;

	/// get auto-generated id
	$sql = "SELECT * FROM $table WHERE first_name='$fn' AND last_name='$ln' AND birthday='$bday' AND payment=99";
	$result = execute_query($sql);
   //echo "check 2:" . $result . "\n"; //should be another resource id
	if($result <= 0) return 10 - $result;
   if(row_count($result) != 1) return 14;
	$result = get_array($result);
	$id = $result['id'];
	return 100*$id;
}

function unregister($id) {
	global $table;
//	return execute_query("DELETE FROM $table WHERE id=$id AND payment=99");
return execute_query("UPDATE $table SET deleted='Y' WHERE id=$id AND payment=99");
}

function verify($id) {
	global $table;
	return execute_query("UPDATE $table SET payment=1 WHERE id=$id");
}

function forward_hash($id) {
	return $id;
}

function verify_hash($id,$hash) {
	return $hash == forward_hash($id);
}

function ParseErrorCode($ErrorCode) {
	$Mantissa = int(floor($ErrorCode / 10));
	if($Mantissa == 5)
		echo( "Unable to verify payment." );
	if($Mantissa == 4)
		echo( "Payment Canceled." );
	if($Mantissa == 3)
		echo( "Unable to generate new student ID -- " );
	if($Mantissa == 2)
		echo( "Unable to add to registration database -- " );
   if($Mantissa == 1)
      echo( "Unable to check current registrants -- " );


	$Mantissa = $ErrorCode - 10 * $Mantissa;
   if($Mantissa == 0)
   	echo( "Could not execute query. ");
   if($Mantissa == 1)
      echo( "Could not select database.");
   if($Mantissa == 2)
      echo( "Could not connect to server.");
   if($Mantissa == 4)
		echo( "Duplicate record exists.");

}

/*********************************************************************'
'* template/functions2.php - Dynamic Registration Form Factories     *'
'* Adapted from: template/functions.asp                              *'
'* BCA Math Competition Site                                         *'
'* Author: Rajesh Ramakrishnan                                       *'
'* Translator: Jordan Moldow                                         *'
'* Creation Date: 2006-May-23                                        *'
'*********************************************************************'
' To keep a persisted file log, keep the above banner and add a comment below this line if you are editing the page '
' Be sure to add an apostrophe at the end of the line, as non-VIM editors will try to match as quotes, not comments '


' Make 3 Drop-down boxes corresponding to YMD, with validation '*/
function MakeDateWithValidation($YearVar, $MonthVar, $DayVar, $StartYear, $EndYear, $YearMonthDelim, $MonthDayDelim, $MonthAbbreviated, $MonthWithNumeric, $TabIndex) {
	MakeYearWithValidation($YearVar, $MonthVar, $DayVar, $StartYear, $EndYear, $TabIndex);
	echo $YearMonthDelim;
	MakeMonthWithValidation($YearVar, $MonthVar, $DayVar, $StartYear, $EndYear, $TabIndex+1, $MonthAbbreviated, $MonthWithNumeric);
	echo $MonthDayDelim;
	MakeDayWithValidation($YearVar, $MonthVar, $DayVar, $StartYear, $EndYear, $TabIndex+2);
}

// Make Month Drop-down box, with Validation '
function MakeMonthWithValidation($YearVar, $MonthVar, $DayVar, $StartYear, $EndYear, $TabIndex, $MonthAbbreviated, $MonthWithNumeric) {
	echo '<select name="'.$MonthVar.'" onChange="Update('.$YearVar.', '.$MonthVar.', '.$DayVar.')" tabindex="'.$TabIndex.'">';
	$TempMonthNameDisplay=' ';
	for ($i = 1; $i <=12; ++$i) {
		$TempMonthName = date(($MonthAbbreviated?'M':'F'), mktime(0,0,0,$i+1,0,0)); //MonthName($i, $MonthAbbreviated) // August vs Aug'
		if($MonthWithNumeric) {
			$TempMonthNameDisplay =  $i . " - " . $TempMonthName; //' Month starts from January = 1 '
		}
		else {
			$TempMonthNameDisplay = $TempMonthName;
		}
		echo '<option '.((6 == $i) ? 'selected="selected" ' : ' ').'value="'.$i.'">'.$TempMonthNameDisplay.'</option>';
	}
	echo '</select>';
}

//' Make Year Drop-down box, with Validation '
function MakeYearWithValidation($YearVar, $MonthVar, $DayVar, $StartYear, $EndYear, $TabIndex) {
	echo '<select name="'.$YearVar.'" onChange="Update('.$YearVar.', '.$MonthVar.', '.$DayVar.')" tabindex="'.$TabIndex.'">';
	$i;
	for ($i = $StartYear; $i <= $EndYear; ++$i) #' Display all years from start to end '
		echo '<option '.(($StartYear + $EndYear)/2 == $i || ($StartYear + $EndYear+1)/2 == $i ? 'selected="selected" ' : ' ').'value="'.$i.'">'.$i.'</option>';
	echo '</select>';
}

//' Make Day Drop-down box, with Validation '
function MakeDayWithValidation($YearVar, $MonthVar, $DayVar, $StartYear, $EndYear, $TabIndex) {
	echo '<select name="'.$DayVar.'" onChange="Update('.$YearVar.', '.$MonthVar.', '.$DayVar.')" tabindex="'.$TabIndex.'">';
	$i;
    	for($i = 1; $i <= 31; ++$i) //' Display 31 days for now, so that users without javascript are not incapable of submitting '
        	echo '<option '.(15==$i ? 'selected="selected" ' : ' ').'value="'.$i.'">'.$i.'</option>';
	echo '</select>';
}

//' Make a list of 50 States '
function MakeState($Name, $TabIndex) {
	echo '<select name="'.$Name.'" tabindex="'.$TabIndex.'">
		<option value="AL">Alabama</option>
		<option value="AK">Alaska</option>
		<option value="AZ">Arizona</option>
		<option value="AR">Arkansas</option>
		<option value="CA">California</option>
		<option value="CO">Colorado</option>
		<option value="CT">Connecticut</option>
		<option value="DE">Delaware</option>
		<option value="DC">District of Columbia</option>
		<option value="FL">Florida</option>
		<option value="GA">Georgia</option>
		<option value="HI">Hawaii</option>
		<option value="ID">Idaho</option>
		<option value="IL">Illinois</option>
		<option value="IN">Indiana</option>
		<option value="IA">Iowa</option>
		<option value="KS">Kansas</option>
		<option value="KY">Kentucky</option>
		<option value="LA">Louisiana</option>
		<option value="ME">Maine</option>
		<option value="MD">Maryland</option>
		<option value="MA">Massachusetts</option>
		<option value="MI">Michigan</option>
		<option value="MN">Minnesota</option>
		<option value="MS">Mississippi</option>
		<option value="MO">Missouri</option>
		<option value="MT">Montana</option>
		<option value="NE">Nebraska</option>
		<option value="NV">Nevada</option>
		<option value="NH">New Hampshire</option>
		<option value="NJ" selected>New Jersey</option>
		<option value="NM">New Mexico</option>
		<option value="NY">New York</option>
		<option value="NC">North Carolina</option>
		<option value="ND">North Dakota</option>
		<option value="OH">Ohio</option>
		<option value="OK">Oklahoma</option>
		<option value="OR">Oregon</option>
		<option value="PA">Pennsylvania</option>
		<option value="RI">Rhode Island</option>
		<option value="SC">South Carolina</option>
		<option value="SD">South Dakota</option>
		<option value="TN">Tennessee</option>
		<option value="TX">Texas</option>
		<option value="UT">Utah</option>
		<option value="VT">Vermont</option>
		<option value="VA">Virginia</option>
		<option value="WA">Washington</option>
		<option value="WV">West Virginia</option>
		<option value="WI">Wisconsin</option>
		<option value="WY">Wyoming</option>';
	echo '</select>';
}

//' Make Month Drop-Down - not validated'
function MakeMonth($Name, $IsAbbreviated, $IncludeNumeric) {
	echo '<select name="'.$Name.'">';
	$TempMonthNameDisplay = ' ';
	for($i = 1; $i <= 12; ++$i) {
		$TempMonthName = MonthName($i, $IsAbbreviated);
		if ($IncludeNumeric)
		    $TempMonthNameDisplay =  $i . " - " . $TempMonthName;
		else
		    $TempMonthNameDisplay = $TempMonthName;
		echo '<option '.(date('n')==$i ? 'selected="selected" ' : ' ').'value="'.$i.'">'.$TempMonthNameDisplay.'</option>';
	}
	echo '</select>';
}

?>
<?php $_POST[]; ?>