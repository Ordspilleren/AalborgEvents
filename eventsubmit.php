<?php
session_start();
require_once('database.php');
if(isset($_POST['submitknap'])){
	$eventnavn = $_POST['eventnavn'];
	$afholder = $_POST['afholder'];
	$startdato = $_POST['startdato'];
	$starttid = $_POST['starttid'];
	$slutdato = $_POST['slutdato'];
	$sluttid = $_POST['sluttid'];
	$adresse = $_POST['adresse'];
	$kategorier = $_POST['kategorier'];

	// billedsti skal fikses senere
	$billedsti = 'placeholder';

	$nytevent = array('eventnavn' => $eventnavn, 'afholder' => $afholder, 'startdato' => $startdato, 'starttid' => $starttid, 'slutdato' => $slutdato, 'sluttid' => $sluttid, 'adresse' => $adresse, 'kategorier' => $kategorier, 'billedsti' => $billedsti);

	print_r($nytevent);

	//tjek om der er blevet trykket submit på billedet.
	if (isset($_FILES['billede']) === true){
		//tjek om der er blevet uploadet et tomt billede.
		if (empty($_FILES['billede']['name']) === true){
			echo "vælg venligst et billede";
		}
		elseif (isset($filnavn) && $_FILES['billede']['name'] === $filnavn) {
			echo "Billedet er allerede uploadet";
		}

		// hvis der er blevet trykket submit og billedet ikke allerede er forsøgt uploadet
		else {
			//sæt tilladte filtyper
			$tilladte = array('jpg', 'jpeg', 'png', 'gif');

			//sæt variabel med det midlertidige sted filen bliver gemt.
			$filtemp = $_FILES['billede']['tmp_name'];
			
			//Sæt variabel med navn på fil
			$filnavn = $_FILES['billede']['name'];
			
			//sæt variabel med fil extentionen i lowercase
			$filexp = explode('.', $filnavn);
			$filextn = strtolower(end($filexp));


				//tjek om billedet har en tilladt extention
				if (in_array($filextn, $tilladte)){
					//flyt filen midlertidigt for at lave et thumbnail.
					$tempdst= 'img/tnevent/' . substr(md5(time()), 0, 10) . '.' . $filextn;
					move_uploaded_file($filtemp, $tempdst);

				}
				else {
					echo 'Den uploadede fil er en ikke tilladt. De tilladte billedtyper er: .jpg, .jpeg, .png og .gif';
				}
		}

	}

// tjek om brugeren allerede har oprettet et event med samme navn, for at undgå brugeren kan resubmitte den samme to gange, eller at der kommer to med samme navn.
$q = "SELECT * FROM Events WHERE eventnavn = :eventnavn";
$STH = $DBH->prepare($q);
$STH->bindParam(':eventnavn', $eventnavn);
$STH->execute();
$tjek = $STH->fetch();

if (empty($tjek)){
	//indsæt nyt event i databasen

	$q = "INSERT INTO Events (eventnavn, afholder, startdato, starttid, slutdato, sluttid, adresse, kategorier, billedsti) VALUES (:eventnavn, :afholder, :startdato, :starttid, :slutdato, :sluttid, :adresse, :kategorier, :billedsti)";
	$STH = $DBH->prepare($q);
	$STH->execute($nytevent);

	echo "Great success!";

}
else{

	header("Location: http://localhost:7888/p2/aalborgevents/opret-arrangement.php");
}











}
// hvis der ikke er blevet trykket submit
else {

	//skift headeren senere ved implementering.
	header("Location: http://localhost:7888/p2/aalborgevents/opret-arrangement.php");
}

//set variabler for det indtastede data:

