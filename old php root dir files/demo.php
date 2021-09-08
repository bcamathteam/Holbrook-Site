<?
/*********************************************************************\
 * demo.php - confirm that paypal would receive correct variables    *
 * BCA Math Competition Site                                         *
 * Author: Rajesh Ramakrishnan                                       *
 * Creation Date: 2006-May-26                                        * 
\*********************************************************************/
session_start();
include_once("template/functions.php");

//these session variables will be with us after paypal
$first_name 	= $_SESSION['first_name'];
$last_name  	= $_SESSION['last_name'];
$home_addr  	= $_SESSION['home_addr'];
$home_city  	= $_SESSION['home_city'];
$home_state 	= $_SESSION['home_state'];
$home_zip  		= $_SESSION['home_zip'];
$birth_year 	= $_SESSION['birth_year'];
$birth_month 	= $_SESSION['birth_month'];
$birth_day  	= $_SESSION['birth_day'];
$grade 			= $_SESSION['grade'];
$school 			= $_SESSION['school'];
$email 			= $_SESSION['email'];
$id				= $_SESSION['id']; 
$release			= $_SESSION['release'];
//$_SESSION['hashid'] = forward_hash($id);

if(!$first_name || !$last_name || !$home_addr || !$home_city || !$home_state || !$home_zip || !$birth_year 
	|| !$birth_month || !$birth_day || !$grade || !$school || !$email || !$id) { //something not filled out
	header("Location: index.asp");
	exit;
}
$IP = $_SERVER["REMOTE_ADDR"];
$file = fopen("log.csv","a");
$dat = date("Y-m-d,H:i:s");
fwrite($file, "$dat,$IP,$last_name,$first_name,$home_addr,$home_city,$home_state,$home_zip,$birth_year,$birth_month,$birth_day,$grade,$school,$email,$id,$release\n");
include("template/top.php"); 

?>
  <br>
  <h2 class="txt">
	BCA Math Competition 2008	</h2>
<h3 class="txt">Demo Confirmation</h3>
<p class="info">This is a demo confirmation.  The live version of the site would direct you to PayPal for the payment.  Your information is logged.</p>
<!--The session variables are:<br><?= nl2br(print_r($_SESSION,true)); ?><br>
The request variables are:<br><?= nl2br(print_r($_REQUEST,true)); ?>-->
<? include("template/bottom.php"); ?>
