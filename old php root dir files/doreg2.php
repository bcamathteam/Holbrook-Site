<?php
/*********************************************************************\
 * doreg.php - backend initial registration callback                 *
 * BCA Math Competition Site                                         *
 * Author: Rajesh Ramakrishnan                                       *
 * Creation Date: 2006-May-24                                        * 
\*********************************************************************/

//sessions are used to hand off variables to confirm.php
session_start();
include("template/functions.php");

//check if the record is still there
if(session_is_registered('id')) unregister($_SESSION['id']);
global $use_mysql;
$first_name 	= $_POST['first_name'];
$last_name  	= $_POST['last_name'];
$home_addr  	= $_POST['home_addr'];
$home_city  	= $_POST['home_city'];
$home_state 	= $_POST['home_state'];
$home_zip  		= $_POST['home_zip'];
$birth_year 	= $_POST['birth_year'];
$birth_month 	= $_POST['birth_month'];
$birth_day  	= $_POST['birth_day'];
$grade 			= $_POST['grade'];
$school 			= $_POST['school'];
$email 			= $_POST['email'];
$release			= isset($_POST['release']) ? 1 : 0;
//if($release == "on" || $release == 1) $release = 1;
//else $release = 0;
// Make appropriate birthday string (ensuring that we append zeroes when necessary)
if(strlen("'" . $birth_month . "'") == 3) $birth_month = "0" . $birth_month;
if(strlen("'" . $birth_day . "'") == 3) $birth_day = "0" . $birth_day;
$birthday = "" . $birth_year . "-" . $birth_month . "-" . $birth_day;

if($use_mysql) $res = register($first_name, $last_name, $home_addr, $home_city, $home_state, $home_zip, $birthday, $grade, $school, $email, $release);
else $res = 100;
//echo $res;

if($res < 100) { //failure
	header("Location: failure.asp?errorno=$res");
	exit;
}
else { //success
	$_SESSION['first_name'] 	= $first_name;
	$_SESSION['last_name'] 		= $last_name;
	$_SESSION['home_addr'] 		= $home_addr;
	$_SESSION['home_city'] 		= $home_city;
	$_SESSION['home_state'] 	= $home_state;
	$_SESSION['home_zip'] 		= $home_zip;
	$_SESSION['birth_year'] 	= $birth_year;
	$_SESSION['birth_month'] 	= $birth_month;
	$_SESSION['birth_day'] 		= $birth_day;
	$_SESSION['grade'] 			= $grade;
	$_SESSION['school'] 			= $school;
	$_SESSION['email'] 			= $email;
	$_SESSION['release']			= $release;
	$_SESSION['id'] 				= ($res / 100); 
	header("Location: confirm2.php");
	exit;	
}
?>
