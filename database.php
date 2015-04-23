
<?php

/*** mysql addresse ***/
$hostname = 'aalborgevents.lgb.dk';

/*** mysql brugernavn ***/
$username = 'aalborgevents';

/*** mysql pass ***/
$password = 'kaffe123';

try {
	$DBH = new PDO("mysql:host=$hostname;dbname=aalborgevents", $username, $password);
	$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	/*** echo en besked som siger der er oprettet ***/
	echo 'Connected to database';
}
catch(PDOException $e)
{
	echo $e->getMessage();
}

?>