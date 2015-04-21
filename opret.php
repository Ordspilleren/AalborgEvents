
<?php
require_once('database.php');

$fornavn = $_POST['fornavn'];
$efternavn = $_POST['efternavn'];
$email = $_POST['email'];
$pw = $_POST['password'];

$nybruger = array( 'fornavn' => $fornavn, 'efternavn' => $efternavn, 'email' => $email, 'pw' => $pw);

$STH = $DBH->("INSERT INTO brugere (fornavn)")





$DBH = null;
?>