<?php
session_start();
require_once('database.php');

if (isset($_POST['email']) and isset($_POST['password'])){
$email = $_POST['email'];
$pw = md5($_POST['password']);



//MySQL query
$q = "SELECT * FROM Brugere WHERE email = :email";

$STH = $DBH->prepare($q);
//sæt parameter der skal tjekkes efter.
$STH->bindParam(':email', $email);
$STH->execute();

//hent brugerens data ned i et array.
$r = $STH->fetch();

echo "<br>";


//print_r($r);
}

//tjek om password passer 
if ("$r[password]" == $pw){
	$_SESSION['loggedin']="true";
	$_SESSION['email']=$email;
	echo "den er dope!";
	echo "<br>";
	echo '<a class="btn" href="nextside.php">Gå videre</a>';

}
else{
	echo "shit forkert password, noget er helt galt her";
}



//luk databasen
$DBH = null;
?>


