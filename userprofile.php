<?php
include ('header.php');

if (isset($_SESSION['email']))
$mail = $_SESSION['email'];
getuser($email);
?>







<?php
include ('footer.php');
?>