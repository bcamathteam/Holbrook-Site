<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="en-us" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>BCA Math Competition 2016</title>
</head>

<body>

<?
session_start();
include_once("template/functions.php");

// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';

foreach ($_POST as $key => $value) {
$value = urlencode(stripslashes($value));
$req .= "&$key=$value";
}

// post back to PayPal system to validate
$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
$fp = fsockopen ('www.paypal.com', 80, $errno, $errstr, 30);

$id = $_POST['item_number'];

if (!$fp) {
	// HTTP ERROR
} else {
	fputs ($fp, $header . $req);
	while (!feof($fp)) {
		$res = fgets ($fp, 1024);
		if (strcmp ($res, "VERIFIED") == 0) {
			// check the payment_status is Completed
			// check that txn_id has not been previously processed
			// check that receiver_email is your Primary PayPal email
			// check that payment_amount/payment_currency are correct
			// process payment
		} else if (strcmp ($res, "INVALID") == 0) {
			// log for manual investigation
		}
	}
	fclose ($fp);
}

verify($id);
exit;	
	
?>
<?
session_start();
include_once("template/functions.php");

// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';

foreach ($_POST as $key => $value) {
$value = urlencode(stripslashes($value));
$req .= "&$key=$value";
}

// post back to PayPal system to validate
$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
$fp = fsockopen ('www.paypal.com', 80, $errno, $errstr, 30);

$id = $_POST['item_number'];

if (!$fp) {
	// HTTP ERROR
} else {
	fputs ($fp, $header . $req);
	while (!feof($fp)) {
		$res = fgets ($fp, 1024);
		if (strcmp ($res, "VERIFIED") == 0) {
			// check the payment_status is Completed
			// check that txn_id has not been previously processed
			// check that receiver_email is your Primary PayPal email
			// check that payment_amount/payment_currency are correct
			// process payment
		} else if (strcmp ($res, "INVALID") == 0) {
			// log for manual investigation
		}
	}
	fclose ($fp);
}

verify($id);
exit;	
	
?>
<br />
<h2 class="txt">BCA Math Competition 2016</h2>
<h3 class="txt">Registration failed</h3>
<p>Your registration was not successful. <b>Please
<a href="javascript:history.back()">try again</a></b> or
<a href="mailto:1mathteam1@bergen.org">Contact Us</a>.<br />
</p>
<p class="alert">Error #<%= Request("errorno") %>: </p>
<%= ParseErrorCode(Request("errorno")) %>
<!--#include file="template/bottom.asp"-->

</body>

</html>
