
<?php
require_once('database.php');

if(isset($_POST['fornavn'])){
	$fornavn = $_POST['fornavn'];
	$efternavn = $_POST['efternavn'];
	$email = $_POST['email'];
	$pw = $_POST['password'];
	$pwencrypt = md5($pw);
}
else{
	echo "Noget gik galt, prøv igen.";
}


$nybruger = array( 'fornavn' => $fornavn, 'efternavn' => $efternavn, 'email' => $email, 'pw' => $pwencrypt);

$q = "INSERT INTO Brugere (email, fornavn, efternavn, password) VALUES (:email, :fornavn, :efternavn, :pw)";
$STH = $DBH->prepare($q);
$STH->execute($nybruger);





$DBH = null;
?>