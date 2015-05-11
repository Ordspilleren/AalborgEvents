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
	/*
		$_SESSION['nybruger'] = "1";
		$_SESSION['email'] = $email;
		$_SESSION['loggedin'] = "true";
	*/
		header("Location: ./loginform.php?opret");
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
	$billedsti = '';
	$brugerstatus = 1;


	//tjek om brugeren med valgte email allerede findes
	$q = "SELECT * FROM Brugere WHERE email = :email";
	$STH = $DBH->prepare($q);
	$STH->bindParam(':email', $email);
	$STH->execute();
	$tjek = $STH->fetch();

	//indset ny hvis den ikke findes:
	if (empty($tjek)){

		//hvis der er uploadet et billede og det ikke er tomt
		if (!empty($_FILES['billede'])){
			//sæt en variabel med tilladte filtyper
				$tilladte = array('jpg', 'jpeg', 'png', 'gif');

			//sæt variabel med det midlertidige sted filen bliver gemt.
				$filtemp = $_FILES['billede']['tmp_name'];

			//Sæt variabel med navn på fil
				$filnavn = $_FILES['billede']['name'];

			//sæt variabel med fil extentionen - Ved at explode filnavnet med . - Derefter sættes den sidste del (extention) til lovercase.
				$filexp = explode('.', $filnavn);
				$filextn = strtolower(end($filexp));


				//tjek om billedet har en tilladt extention
				if (in_array($filextn, $tilladte)){
					
					//flyt filen for at gemme den.
					//sæt først det nye navn og sti som filen skal have (bruger md5 på tiden til at lave et random filnavn):
					$dstdb = substr(md5(time()), 0, 10) . '.' . $filextn;
					$dst = 'img/brugerpic/' . $dstdb;
					
					//flyt filen:
					move_uploaded_file($filtemp, $dst);

					//skift variablen billedsti til det uploadede billede
					$billedsti = $dstdb;
				}
			}




	//indsæt ny bruger i databasen
		$nyorg = array( 'navn' => $orgnavn, 'beskrivelse' => $beskrivelse, 'email' => $email, 'pw' => $pwencrypt, 'brugerstatus' => $brugerstatus, 'profilbanner' => $billedsti);
		$q = "INSERT INTO Brugere (navn, beskrivelse, email, password, brugerstatus, profilbanner) VALUES (:navn, :beskrivelse, :email, :pw, :brugerstatus, :profilbanner)";
		$STH = $DBH->prepare($q);
		$STH->execute($nyorg);



		$q = "SELECT * FROM Brugere WHERE email = :email";
		$STH = $DBH->prepare($q);
		//sæt parameter der skal tjekkes efter.
		$STH->bindParam(':email', $email);
		$STH->execute();
		$r = $STH->fetch();


	// sæt session og smid brugeren til forside
	/*
		$_SESSION['nybruger'] = "1";
		$_SESSION['email'] = $email;
		$_SESSION['loggedin'] = "true";
		$_SESSION['brugerid']=$r['ID'];
	*/
		header("Location: ./loginform.php?opret");
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
	//send tilbage til opret
	header("Location: ./opretform.php");
}



$DBH = null;
?>