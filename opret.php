
<?php
require_once('database.php');


//set variabler for det indtastede data.

if(isset($_POST['fornavn'])){
	$fornavn = $_POST['fornavn'];
	$efternavn = $_POST['efternavn'];
	$email = $_POST['email'];
	$pw = $_POST['password'];
	$pwencrypt = md5($pw);
}
//hvis der ikke submitted.
else{
	echo "Noget gik galt, prøv igen.";
}


//tjek om brugeren med valgte email allerede findes
$q = "SELECT * FROM Brugere WHERE email = :email";
$STH = $DBH->prepare($q);
$STH->bindParam(':email', $email);
$STH->execute();
$tjek = $STH->fetch();


if (empty($tjek)){
//indsæt ny bruger i databasen
$nybruger = array( 'fornavn' => $fornavn, 'efternavn' => $efternavn, 'email' => $email, 'pw' => $pwencrypt);

$q = "INSERT INTO Brugere (email, fornavn, efternavn, password) VALUES (:email, :fornavn, :efternavn, :pw)";
$STH = $DBH->prepare($q);
$STH->execute($nybruger);
}
else {
//Hvis brugeren findes allerede.

echo "Email adressen er allerede brugt!";
}



$DBH = null;
?>