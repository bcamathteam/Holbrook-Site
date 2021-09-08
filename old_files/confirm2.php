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
$id				= $_SESSION['id']; 
$release			= $_SESSION['release'];
$_SESSION['hashid'] = forward_hash($id);

if(!$first_name || !$last_name || !$home_addr || !$home_city || !$home_state || !$home_zip || !$birth_year 
	|| !$birth_month || !$birth_day || !$grade || !$school || !$email || !$id) { //something not filled out
	header("Location: index.asp");
	exit;
}
include("template/top.php"); 
?>
  <h2 class="txt">
	BCA Math Competition 2006
	</h2>
<h3 class="txt">Registration Confirmation</h3>
<p class="info">If there is an error, <a href="javascript:history.back()" class="emph">Click Here</a> to go back.</p>
<p class="info">If you would like to pay by check, <a href="check.php" class="emph" target="_blank">Click Here</a> for details.</p>
<form method="post" action="<?= $paypal ?>" onSubmit="return Ack()">
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
		<td class="weh">&nbsp; <b>(In October 2006)</b>: <?= $grade ?></td>
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
      <td class="name" id="email">Release</td>
      <td class="weh">&nbsp; <? echo($release == 1 ? "Authorized" : "Not Authorized"); ?>
      </td>
    </tr>
	 
  </table>
  <center>
	<input name="submit" type="submit" value="Pay by Credit Card">
	<input type="hidden" name="cmd" value="_xclick">
	<input type="hidden" name="business" value="<?= $account ?>">
	<input type="hidden" name="item_name" value="BCA Math Competition Registration">
	<input type="hidden" name="item_number" value="<?= forward_hash($id) ?>">
	<input type="hidden" name="amount" value="00.01">
	<input type="hidden" name="no_shipping" value="1">
	<input type="hidden" name="no_note" value="1">
	<input type="hidden" name="address1" value="<?= $home_addr ?>">
	<input type="hidden" name="city" value="<?= $home_city ?>">
	<input type="hidden" name="state" value="<?= $home_state ?>">
	<input type="hidden" name="zip" value="<?= $home_zip ?>">
	<input type="hidden" name="country" value="US">
	<input type="hidden" name="rm" value="2">
	<input type="hidden" name="notify_url" value="<?= $base_url ?>notify.php">
	<input type="hidden" name="cpp_headerborder_color" value="FFD700">
	<input type="hidden" name="cpp_headerback_color" value="000000">
	<input type="hidden" name="cpp_payflow_color" value="000000">
	<input type="hidden" name="image_url" value="<?= $base_url ?>images/schoollogo.jpg">
	<input type="hidden" name="cpp_header_image" value="<?= $base_url ?>images/mathcompbanner.jpg">
	<input type="hidden" name="return" value="<?= $return_url ?>">
	<input type="hidden" name="cancel_return" value="<?= $cancel_url ?>">
	<input type="hidden" name="currency_code" value="USD">
	<input type="hidden" name="bn" value="PP-BuyNowBF">
  <br><!-- Begin Official PayPal Seal --><a href="https://www.paypal.com/us/verified/pal=ramakrishnan%2erama%40gmail%2ecom" target="_blank"><img src="http://www.paypal.com/en_US/i/icon/verification_seal.gif" border="0" alt="Official PayPal Seal"></A><!-- End Official PayPal Seal -->
  </center>
</form>
<? include("template/bottom.php"); ?>
