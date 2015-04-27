<?php
session_start();



if ($_SESSION['loggedin'] = "true"){

	echo "Hej " . $_SESSION['email'] . " du er nu logget ind, yay!";
}
else{
	echo "du er ikke logget ind";
}



?>