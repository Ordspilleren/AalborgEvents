<?php
session_start();
require_once('database.php');

//sæt variabler fra brugerens indtastede data
if(isset($_POST['submitknap'])){
	$eventnavn = $_POST['eventnavn'];
	(isset($_POST['afholder'])) ? $afholder = $_POST['afholder'] : $afholder = '';
	$startdato = $_POST['startdato'];
	$starttid = $_POST['starttid'];
	$slutdato = $_POST['slutdato'];
	$sluttid = $_POST['sluttid'];
	$adresse = $_POST['adresse'];
	$kategorier = $_POST['kategorier'];
	$beskrivelse = $_POST['beskrivelse'];
	$bruger = $_SESSION['email'];


	// billedsti skal fikses senere
	$billedsti = 'kappa.jpg';


// tjek om brugeren allerede har oprettet et event med samme navn, for at undgå brugeren kan resubmitte den samme to gange, eller at der kommer to med samme navn.
$q = "SELECT * FROM Events WHERE eventnavn = :eventnavn";
$STH = $DBH->prepare($q);
$STH->bindParam(':eventnavn', $eventnavn);
$STH->execute();
$tjek = $STH->fetch();

if (empty($tjek)){

	//tjek om der er blevet trykket submit på billedet.
	if (isset($_FILES['billede']) === true){
		//tjek om der er blevet uploadet et tomt billede.
		if (empty($_FILES['billede']['name']) === true){
			echo "vælg venligst et billede";
		}
		//hvis billedet ikke er tomt:
		else {
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
					$dst = 'img/tnevent/' . $dstdb;
					
					//flyt filen:
					move_uploaded_file($filtemp, $dst);

					//skift variablen billedsti til det uploadede billede
					$billedsti = $dstdb;

				}
				//hvis filen ikke har en tilladt extention:
				else {
					echo 'Den uploadede fil er en ikke tilladt. De tilladte billedtyper er: .jpg, .jpeg, .png og .gif';
				}
		}

	}



$nytevent = array('eventnavn' => $eventnavn, 'afholder' => $afholder, 'startdato' => $startdato, 'starttid' => $starttid, 'slutdato' => $slutdato, 'sluttid' => $sluttid, 'adresse' => $adresse, 'kategorier' => $kategorier, 'billedsti' => $billedsti, 'beskrivelse' => $beskrivelse, 'bruger' => $bruger);


	//indsæt nyt event i databasen

	$q = "INSERT INTO Events (eventnavn, afholder, startdato, starttid, slutdato, sluttid, adresse, kategorier, billedsti, beskrivelse, bruger) VALUES (:eventnavn, :afholder, :startdato, :starttid, :slutdato, :sluttid, :adresse, :kategorier, :billedsti, :beskrivelse, :bruger)";
	$STH = $DBH->prepare($q);
	$STH->execute($nytevent);

	//bind eventetid'et til brugerid'et
	//start med at finde ud af hvilket ID eventet har fået i databasen
	$q = "SELECT ID FROM Events WHERE eventnavn = :eventnavn";
	$STH = $DBH->prepare($q);
	$STH->bindParam(':eventnavn', $eventnavn);
	$STH->execute();
	$EID = $STH->fetch();


	$brugerid = $_SESSION['brugerid'];
	$createdid = $EID['ID'];

	//opdater brugerfavoritter tabel med brugerid og eventid
	$q = "INSERT INTO brugerfavoritter (brugerid, createdid) VALUES (:brugerid, :createdid)";
	$STH = $DBH->prepare($q);
	$STH->bindParam(':brugerid', $brugerid);
	$STH->bindParam(':createdid', $createdid);
	$STH->execute();

	header("Location: ./eventside.php?opret&event=" . $createdid);

}
else{
	echo "Der findes allerede et event med dette navn";
	//header("Location: http://localhost:7888/p2/aalborgevents/opret-arrangement.php");
}











}
// hvis der ikke er blevet trykket submit
else {

	//skift headeren senere ved implementering.
	header("Location: http://localhost:7888/p2/aalborgevents/opret-arrangement.php");
}

//set variabler for det indtastede data:

