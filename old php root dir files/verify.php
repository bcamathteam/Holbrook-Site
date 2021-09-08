<?
session_start();
include_once("template/functions.php");
$success = $_GET['success'];

if(!session_is_registered('id') || !session_is_registered('hashid')) { //no ID
	header("Location: failure.asp?errorno=54");
	exit;
}
$id = $_SESSION['id']; $hashid = $_SESSION['hashid'];
if(!(verify_hash($id, $hashid))) { //no ID
	unregister($id);
	header("Location: failure.asp?errorno=54");
	exit;
}
if($success != 1) { //error - wipe and return
	unregister($id);
	header("Location: failure.asp?errorno=49");
	exit;	
}
verify($id);
header("Location: success.asp");
exit;	
	
?>