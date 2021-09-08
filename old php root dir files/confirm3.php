<?
/*********************************************************************\
 * confirm.php - confirm registration, paypal direct                 *
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
//$id				= $_SESSION['id'];
$release			= $_SESSION['release'];
$phone			= $_SESSION['phone'];
//$_SESSION['hashid'] = forward_hash($id);

if(!$first_name || !$last_name || !$home_addr || !$home_city || !$home_state || !$home_zip || !$birth_year || !$birth_month || !$birth_day || !$grade || !$school || !$email || !$phone) { //something not filled out
// echo print_r($_SESSION);
//	header("Location: index.asp");
//	exit;
}
include("template/top.php");
?>
  <h2 class="txt">
	Registration Step 2: Review Info
	</h2>
<!--<h3 class="txt">Registration Confirmation</h3>-->
<form method="post" action="regconf.php">
  <table class="info">
    <tr>
      <td class="name" width="250" id="name">Name</td>
      <td width="450" class="weh">&nbsp;
          <?= $first_name ?>&nbsp;
			 <?= $last_name ?></td>
    </tr>
    <tr>
      <td class="name" id="home_addr">Home Address </td>
      <td class="weh">&nbsp; <?= $home_addr ?>
      </td>
    </tr>
    <tr>
      <td class="name" id="home_csz">City, State, Zip </td>
      <td class="weh">&nbsp;
          <?= $home_city ?>,
          <?= $home_state ?>
          <?= $home_zip ?></td>
    </tr>
    <tr>
      <td class="name" id="birth">Birth Date</td>
      <td class="weh">&nbsp;
          <?= $birth_year ?> -- <?= $birth_month ?> -- <?= $birth_day ?></td>
    </tr>
	 <tr>
	 	<td class="name" id="grade">Grade</td>
		<td class="weh">&nbsp; (In October 2014): <?= $grade ?></td>
	 </tr>
    <tr>
      <td class="name" id="school">School</td>
      <td class="weh">&nbsp; <?= $school ?></td>
    </tr>
    <tr>
      <td class="name" id="email">Email Address</td>
      <td class="weh">&nbsp; <?= $email ?>
      </td>
    </tr>
    <tr>
      <td class="name" id="phone">Phone Number</td>
      <td class="weh">&nbsp; <?= $phone ?>
      </td>
    </tr>
	 <tr>
      <td class="name" id="release">Release</td>
      <td class="weh">&nbsp; <? echo($release == 1 ? "Authorized" : "Not Authorized"); ?>
      </td>
    </tr>

  </table>
  <center>
<p class="info">If there is an error, <a href="javascript:history.back()" class="emph">Click Here</a> to go back.</p>
<p class="warn">Please do not click "continue to step 3" if you are not ready with payment option or not sure of registration.Website will block you to register later, until we unblock you manually
<p class="info"><b>Confirm:</b><input name="submit" type="submit" value="Continue to Step 3 >>"></p>
  </center>
</form>
<? include("template/bottom.php"); ?>
