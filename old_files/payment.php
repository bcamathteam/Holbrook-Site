<?
/*********************************************************************\
 * payment.php - paypal or check                                     *
 * BCA Math Competition Site                                         *
 * Author: Rajesh Ramakrishnan/edited: Nikita Patel:2014                                      *
 * Creation Date: 2006-May-30                                        *
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
$id            = $_SESSION['id'];
$release       = $_SESSION['release'];
$phone			= $_SESSION['phone'];
$_SESSION['hashid'] = forward_hash($id);

if(!$first_name || !$last_name || !$home_addr || !$home_city || !$home_state || !$home_zip || !$birth_year
   || !$birth_month || !$birth_day || !$grade || !$school || !$email || !$id) { //something not filled out
   header("Location: index.asp");
   exit;
}
include("template/top.php");
?>

  <h2 class="txt">
   Registration Step 3: Payment Info
   </h2>

<form method="post" action="<?= $paypal ?>" onSubmit="return Ack()">
<p class="info"><b>Payment:</b> Credit Card - 
<input name="submit" type="submit" value="Click Here to Pay by Credit Card or PayPal"></p>
<p class="warn">Once you pay for Registration there is NO refund</p>
	<p class="warn">We will not be accepting payment by check.</p>
   <input type="hidden" name="cmd" value="_xclick">
   <input type="hidden" name="business" value="<?= $account ?>">
   <input type="hidden" name="item_name" value="BCA Math Competition Registration">
   <input type="hidden" name="item_number" value="<?= forward_hash($id) ?>">
   <input type="hidden" name="amount" value="40.00">
   <!--<input type="hidden" name="amount" value="00.01">--><!--For testing-->
   <input type="hidden" name="no_shipping" value="1">
   <input type="hidden" name="no_note" value="1">
   <input type="hidden" name="address1" value="<?= $home_addr ?>">
   <input type="hidden" name="city" value="<?= $home_city ?>">
   <input type="hidden" name="state" value="<?= $home_state ?>">
   <input type="hidden" name="zip" value="<?= $home_zip ?>">
   <input type="hidden" name="country" value="US">
   <input type="hidden" name="rm" value="2">
   <input type="hidden" name="notify_url" value="<?= $base_url ?>notify.php">
   <!--<input type="hidden" name="cpp_headerborder_color" value="FFD700">
   <input type="hidden" name="cpp_headerback_color" value="000000">
   <input type="hidden" name="cpp_payflow_color" value="000000">
   <input type="hidden" name="image_url" value="<?= $base_url ?>images/schoollogo.jpg">
   <input type="hidden" name="cpp_header_image" value="<?= $base_url ?>images/mathcompbanner.jpg">-->
   <input type="hidden" name="return" value="<?= $return_url ?>">
   <input type="hidden" name="cancel_return" value="<?= $cancel_url ?>">
   <input type="hidden" name="currency_code" value="USD">
   <input type="hidden" name="bn" value="PP-BuyNowBF">
  <br><!-- Begin Official PayPal Seal --><!--<a href="https://www.paypal.com/us/verified/pal=ramakrishnan%2erama%40gmail%2ecom" target="_blank">--><img src="http://www.paypal.com/en_US/i/icon/verification_seal.gif" border="0" alt="Official PayPal Seal"><!--</A>--><!-- End Official PayPal Seal -->
</form>
<? include("template/bottom.php"); ?>
