<? 
include('functions.php');
if(is_int($_POST['id']) && $_POST['id'] > 0) {
	verify($_POST['id']);
}
?>