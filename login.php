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



//print_r($r);
}
else
{
	header("Location: http://localhost:8888/p2/aalborgevents/loginform.php");
}
//tjek om password passer 
if ("$r[password]" == $pw){
	$_SESSION['loggedin']="true";
	$_SESSION['email']=$email;
	header("Location: http://localhost:8888/p2/aalborgevents/index.php");
}
else{
	header("Location: http://localhost:8888/p2/aalborgevents/loginform.php");
}



//luk databasen
$DBH = null;
?>


