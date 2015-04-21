
<?php
require_once('database.php');

if(isset($_POST['fornavn'])){
	$fornavn = $_POST['fornavn'];
	$efternavn = $_POST['efternavn'];
	$email = $_POST['email'];
	$pw = $_POST['password'];
}

$nybruger = array( 'fornavn' => $fornavn, 'efternavn' => $efternavn, 'email' => $email, 'pw' => $pw);

$q = "INSERT INTO Brugere (email, fornavn, efternavn, password) VALUES (:email, :fornavn, :efternavn, :pw)";


$STH = $DBH->prepare("INSERT INTO Brugere (email, fornavn, efternavn, password) VALUES (:email, :fornavn, :efternavn, :pw)");

$STH->execute($nybruger);





$DBH = null;
?>