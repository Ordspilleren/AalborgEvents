<?php
function loggedIn(){
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === "true") {
		return true;
	} else {
		return false;
	}
}

function getEvent($id){
	$q = "SELECT * FROM Events WHERE id = :id";
	$STH = $DBH->prepare($q);
	$STH->bindParam(':id', $id);
	$STH->execute();
	$result = $STH->fetch(PDO::FETCH_ASSOC);

	return $result;
}

function getUser(){

}