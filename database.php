
<?php
// $host = 'aalborgevents.lgb.dk';
// $dbname = "aalborgevents";
// $user = "aalborgevents";
// $pw = "kaffe123";

// try{
// 	$DBH = new PDO("mysql:host=$host;dbname=aalborgevents", $user, $pw);
// 	$dbh = new PDO("mysql:host=$hostname;dbname=aalborgevents", $username, $password);

// 	$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// }
// catch(PDOExeption $e) {
// 	echo "Ups noget gik galt: " . $e->getMessage();
// }


/*** mysql hostname ***/
$hostname = 'aalborgevents.lgb.dk';

/*** mysql username ***/
$username = 'aalborgevents';

/*** mysql password ***/
$password = 'kaffe123';

try {
	$DBH = new PDO("mysql:host=$hostname;dbname=aalborgevents", $username, $password);
	$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	/*** echo a message saying we have connected ***/
	echo 'Connected to database';
}
catch(PDOException $e)
{
	echo $e->getMessage();
}

?>