<?
/*********************************************************************\
 * regconf.php - confirm registration, persist field                 *
 * BCA Math Competition Site                                         *
 * Author: Rajesh Ramakrishnan                                       *
 * Creation Date: 2006-May-25                                        *
\*********************************************************************/
session_start();
include_once("template/functions.php");

global $base_url, $paypal, $account;
$return_url = $base_url . "verify.php?success=1";
$cancel_url = $base_url . "verify.php?success=0";
//these session variables will be with us after paypal
$first_name    = $_SESSION['first_name'];
$last_name     = $_SESSION['last_name'];
$home_addr     = $_SESSION['home_addr'];
$home_city     = $_SESSION['home_city'];
$home_state    = $_SESSION['home_state'];
$home_zip      = $_SESSION['home_zip'];
$birth_year    = $_SESSION['birth_year'];
$birth_month   = $_SESSION['birth_month'];
$birth_day     = $_SESSION['birth_day'];
$grade         = $_SESSION['grade'];
$school        = $_SESSION['school'];
$email         = $_SESSION['email'];
//$id          = $_SESSION['id'];
$phone			= $_SESSION['phone'];
$release       = $_SESSION['release'];
//$_SESSION['hashid'] = forward_hash($id);

if(!$first_name || !$last_name || !$home_addr || !$home_city || !$home_state || !$home_zip || !$birth_year || !$birth_month || !$birth_day || !$grade || !$school || !$email || !$phone) { //something not filled out
   header("Location: index.asp");
   exit;
}

if(strlen("'" . $birth_month . "'") == 3) $birth_month = "0" . $birth_month;
if(strlen("'" . $birth_day . "'") == 3) $birth_day = "0" . $birth_day;
$birthday = "" . $birth_year . "-" . $birth_month . "-" . $birth_day;

if($use_mysql) $res = register($first_name, $last_name, $home_addr, $home_city, $home_state, $home_zip, $birthday, $grade, $school, $email, $release, $phone);
else $res = 100;
//echo $res;

if($res < 100) { //failure
 header("Location: failure.asp?errorno=$res");
 exit;
}
else { //success
   $_SESSION['id']             = ($res / 100);
   header("Location: payment.php");
   exit;
}
?>
