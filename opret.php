<?php
session_start();
require_once('database.php');


//set variabler for det indtastede data.

if(isset($_POST['fornavn'])){
	$fornavn = $_POST['fornavn'];
	$efternavn = $_POST['efternavn'];
	$email = $_POST['email'];
	$pw = $_POST['password'];
	$pwencrypt = md5($pw);
}

//hvis der ikke submitted.
else {
	// !!!!!skift lokationen her ved implementering senere!!!!!!!
	header("Location: http://localhost:7888/p2/aalborgevents/opretform.php");
}


//tjek om brugeren med valgte email allerede findes
$q = "SELECT * FROM Brugere WHERE email = :email";
$STH = $DBH->prepare($q);
$STH->bindParam(':email', $email);
$STH->execute();
$tjek = $STH->fetch();

//indset ny hvis den ikke findes:
if (empty($tjek)){
//indsæt ny bruger i databasen
$nybruger = array( 'fornavn' => $fornavn, 'efternavn' => $efternavn, 'email' => $email, 'pw' => $pwencrypt);
$q = "INSERT INTO Brugere (email, fornavn, efternavn, password) VALUES (:email, :fornavn, :efternavn, :pw)";
$STH = $DBH->prepare($q);
$STH->execute($nybruger);

//!!!!skift lokation ved implementeringer!!!!
$_SESSION['nybruger'] = "1";
$_SESSION['email'] = $email;
$_SESSION['loggedin'] = "true";
header("Location: http://localhost:7888/p2/aalborgevents/index.php");
}

else {
	//Hvis emailen findes i databasen allerede.
	$_SESSION["fejl"] = "5";
	//!!!!skift lokation ved implementeringer!!!!
	header("Location: http://localhost:7888/p2/aalborgevents/opretform.php");
}


$DBH = null;
?>