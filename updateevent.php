<?php
session_start();
require_once('database.php');
require_once('functions.php');

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
	$id = $_POST['ID'];

$updateevent = array('eventnavn' => $eventnavn, 'afholder' => $afholder, 'startdato' => $startdato, 'starttid' => $starttid, 'slutdato' => $slutdato, 'sluttid' => $sluttid, 'adresse' => $adresse, 'kategorier' => $kategorier, 'beskrivelse' => $beskrivelse, 'id' => $id);
	
	$q = "UPDATE Events SET eventnavn=:eventnavn, afholder=:afholder, startdato=:startdato, starttid=:starttid, slutdato=:slutdato, sluttid=:sluttid, adresse=:adresse, kategorier=:kategorier, beskrivelse=:beskrivelse WHERE id=:id";
	$STH = $DBH->prepare($q);
	$STH->execute($updateevent);

	header("Location: ./eventside.php?event=" . $id);

}
else{
	header("Location: ./index.php");
}
?>