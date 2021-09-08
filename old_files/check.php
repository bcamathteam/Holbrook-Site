<?
/*********************************************************************\
 * check.php - Present info for writing a check to pay               *
 * BCA Math Competition Site                                         *
 * Author: Rajesh Ramakrishnan                                       *
 * Creation Date: 2006-May-25                                        * 
\*********************************************************************/
session_start();
include_once("template/functions.php");

global $base_url, $paypal, $account, $table;
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

if(execute_query("UPDATE $table SET payment=10 WHERE id=$id")) $success = 1;

if(!$first_name || !$last_name || !$home_addr || !$home_city || !$home_state || !$home_zip || !$birth_year 
	|| !$birth_month || !$birth_day || !$grade || !$school || !$email || !$id) { //something not filled out
	header("Location: index.asp");
	exit;
} 
?>
  <h2 class="txt">
	BCA Math Competition 2006
	</h2>
<h3 class="txt">Payment via Check </h3>
<p class="info">Please write a check for <b>$20.00</b> made out to <b>Student Activity Fund - Math Competition</b>.<br>
Please write contestant's last name, <b><?= $last_name ?></b>, and ID, <b><?= $id ?></b>, in the Memo.<br><br>
Mail a printed copy of this form and the check to:<br><br>
<b>&nbsp;&nbsp;Bergen County Academies<br>
&nbsp;&nbsp;C/O Lalitha Ramakrishnan<br>
&nbsp;&nbsp;200 Hackensack Avenue<br>
&nbsp;&nbsp;Hackensack, NJ 07601<br><br></b>
Check must be postmarked by <b>October 8</b>.  No checks will be processed if postmarked after the date.<br>
If you would like a confirmation, send a self-addressed stamped envelope.</p>
  <table class="info">
    <tr>
      <td class="name" width="250" id="name">Name</td>
      <td width="450">&nbsp;
          <?= $first_name ?>&nbsp;
			 <?= $last_name ?></td>
    </tr>
    <tr>
      <td class="name" id="home_addr">Home Address </td>
      <td>&nbsp; <?= $home_addr ?>
      </td>
    </tr>
    <tr>
      <td class="name" id="home_csz">City, State, Zip </td>
      <td>&nbsp;
          <?= $home_city ?>,
          <?= $home_state ?>
          <?= $home_zip ?></td>
    </tr>
    <tr>
      <td class="name" id="birth">Birth Date</td>
      <td>&nbsp;
          <?= $birth_year ?> -- <?= $birth_month ?> -- <?= $birth_day ?></td>
    </tr>
	 <tr>
	 	<td class="name" id="grade">Grade</td>
		<td>&nbsp; (In October 2006): <?= $grade ?></td>
	 </tr>
    <tr>
      <td class="name" id="school">School</td>
      <td>&nbsp; <?= $school ?></td>
    </tr>	 
    <tr>
      <td class="name" id="email">Email Address</td>
      <td>&nbsp; <?= $email ?>
      </td>
    </tr>
	 <tr>
      <td class="name" id="email">Release</td>
      <td>&nbsp; <? echo($release == 1 ? "Authorized" : "Not Authorized"); ?>
      </td>
    </tr> 
  </table>
