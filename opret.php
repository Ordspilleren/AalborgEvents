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
	$brugerstatus = 0;


	//tjek om brugeren med valgte email allerede findes
	$q = "SELECT * FROM Brugere WHERE email = :email";
	$STH = $DBH->prepare($q);
	$STH->bindParam(':email', $email);
	$STH->execute();
	$tjek = $STH->fetch();

	//indset ny hvis den ikke findes:
	if (empty($tjek)){
	//indsæt ny bruger i databasen
		$nybruger = array( 'fornavn' => $fornavn, 'efternavn' => $efternavn, 'email' => $email, 'pw' => $pwencrypt, 'brugerstatus' => $brugerstatus);
		$q = "INSERT INTO Brugere (email, fornavn, efternavn, password, brugerstatus) VALUES (:email, :fornavn, :efternavn, :pw, :brugerstatus)";
		$STH = $DBH->prepare($q);
		$STH->execute($nybruger);

	//!!!!skift lokation ved implementeringer!!!!
		$_SESSION['nybruger'] = "1";
		$_SESSION['email'] = $email;
		$_SESSION['loggedin'] = "true";
		header("Location: ./index.php");
	}
	else {
	//Hvis emailen findes i databasen allerede.
		$_SESSION["fejl"] = "5";
	//!!!!skift lokation ved implementeringer!!!!
		header("Location: ./opretform.php");

	}
}



elseif (isset($_POST['orgnavn'])){
	$orgnavn = $_POST['orgnavn'];
	$beskrivelse = $_POST['beskrivelse'];
	$email = $_POST['email'];
	$pw = $_POST['password'];
	$pwencrypt = md5($pw);
	$brugerstatus = 1;

	//tjek om brugeren med valgte email allerede findes
	$q = "SELECT * FROM Brugere WHERE email = :email";
	$STH = $DBH->prepare($q);
	$STH->bindParam(':email', $email);
	$STH->execute();
	$tjek = $STH->fetch();

	//indset ny hvis den ikke findes:
	if (empty($tjek)){
	//indsæt ny bruger i databasen
		$nyorg = array( 'navn' => $orgnavn, 'beskrivelse' => $beskrivelse, 'email' => $email, 'pw' => $pwencrypt, 'brugerstatus' => $brugerstatus);
		$q = "INSERT INTO Brugere (navn, beskrivelse, email, password, brugerstatus) VALUES (:navn, :beskrivelse, :email, :pw, :brugerstatus)";
		$STH = $DBH->prepare($q);
		$STH->execute($nyorg);

	//!!!!skift lokation ved implementeringer!!!!
		$_SESSION['nybruger'] = "1";
		$_SESSION['email'] = $email;
		$_SESSION['loggedin'] = "true";
		header("Location: ./index.php");
	}
	else {
	//Hvis emailen findes i databasen allerede.
		$_SESSION["fejl"] = "5";
	//!!!!skift lokation ved implementeringer!!!!
		header("Location: ./opretform.php");

	}




}
//hvis der ikke submitted.
else {
	// !!!!!skift lokationen her ved implementering senere!!!!!!!
	header("Location: ./opretform.php");
}



$DBH = null;
?>