
<?php

$host = "http://aalborgevents.lgb.dk/";
$dbname = "aalborgevents";
$user = "aalborgevents";
$pw = "kaffe123";

try{
$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOExeption $e) {
	echo "Ups noget gik galt: " . $e->getMessage();
}

?>