<?php
function loggedIn(){
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === "true") {
		return true;
	} else {
		return false;
	}
}

function getEvent($id){
	global $DBH;
	$q = "SELECT * FROM Events WHERE id = :id";
	$STH = $DBH->prepare($q);
	$STH->bindParam(':id', $id);
	$STH->execute();
	$result = $STH->fetch(PDO::FETCH_ASSOC);

	return $result;
}

function getUser($email){
	global $DBH;

	if (is_numeric($email)){
		$q = "SELECT * FROM Brugere WHERE ID = :email";
	} else {
		$q = "SELECT * FROM Brugere WHERE email = :email";
	}

	$STH = $DBH->prepare($q);
	$STH->bindParam(':email', $email);
	$STH->execute();
	$result = $STH->fetch(PDO::FETCH_ASSOC);

	return $result;
}

// Funktion som returner brugerstatus for en bruger med en angiven email
function getUserstatus($email){
	global $DBH;
	$q = "SELECT brugerstatus FROM Brugere WHERE email = :email";
	$STH = $DBH->prepare($q);
	$STH->bindParam(':email', $email);
	$STH->execute();
	$result = $STH->fetch();
	$resultat = $result['brugerstatus'];
	return $resultat;
}

function addFavorite($brugerid, $eventid){
	global $DBH;
	$q = "SELECT * FROM brugerfavoritter WHERE brugerid = :brugerid AND eventid = :eventid";
	$STH = $DBH->prepare($q);
	$STH->bindParam(':brugerid', $brugerid);
	$STH->bindParam(':eventid', $eventid);
	$STH->execute();
	$tjek = $STH->fetch();

	if (empty($tjek)){
		$addevent = array('brugerid' => $brugerid, 'eventid' => $eventid);
		$q = "INSERT INTO brugerfavoritter (brugerid, eventid) VALUES (:brugerid, :eventid)";
		$STH = $DBH->prepare($q);
		$STH->execute($addevent);
	}
}

function addFollow($brugerid, $follow){
	global $DBH;
	$q = "SELECT * FROM brugerfavoritter WHERE brugerid = :brugerid AND following = :follow";
	$STH = $DBH->prepare($q);
	$STH->bindParam(':brugerid', $brugerid);
	$STH->bindParam(':follow', $follow);
	$STH->execute();
	$tjek = $STH->fetch();

	if (empty($tjek)){
		$addfollow = array('brugerid' => $brugerid, 'follow' => $follow);
		$q = "INSERT INTO brugerfavoritter (brugerid, following) VALUES (:brugerid, :follow)";
		$STH = $DBH->prepare($q);
		$STH->execute($addfollow);
	}
}

function getBrugerEvents($brugerid){
	global $DBH;
	$q = "SELECT * from Events inner join brugerfavoritter on brugerfavoritter.eventid=Events.ID WHERE brugerfavoritter.brugerid='$brugerid'";
	$events = $DBH->query($q);
	$events->execute();

	return $events;
}

function truncate($string,$length=150,$append="&hellip;") {
	$string = trim($string);

	if(strlen($string) > $length) {
		$string = wordwrap($string, $length);
		$string = explode("\n", $string, 2);
		$string = $string[0] . $append;
	}

	return $string;
}
