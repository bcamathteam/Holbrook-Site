<?
$errorno = $_REQUEST['errorno'];
include_once("template/functions.php");
if(session_is_registered('id'))
	unregister($_SESSION['id']);
include("template/top.php");
?>
  <br><h2 class="txt">
	Joe Holbrook Memorial Math Competition 2014
	</h2>
<h3 class="txt">Registration failed</h3>
<p>Your registration was not successful.  <b>Please <a href="javascript:history.back()">try again</a></b> or <a href="mailto:1mathteam1@bergen.org">Contact Us</a>.<br></p>
<p class="alert">Error #<?= $errorno ?>: <? ParseErrorCode($errorno); ?>
<? include("template/bottom.php"); ?>
