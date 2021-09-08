<?
include("functions.php");
?>
<p>This is printed by html.<br>
<?= "This is printed by php.  Whodathunk?" ?><br>
1+1=<?= 1+1 ?><br>
<?= "Your mom's face is an asymptote" ?>
<br>
<?php

$i = "This is a secret message";
$j = $_GET['secret'];
?><br>
HTML Thinks the message is: $i<br>
PHP Thinks the message is: <?= $i ?><br>
<?php
if(valid_username($j)) { echo "Success!"; }
else { echo "Failure! j = $j";}
?>
<?

?>
</p>
