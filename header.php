<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Aalborg Events</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>

	<div class="container header">
		<div class="logo">

		</div>
		<nav class="navbar navbar-default">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href="#">Forside</a></li>
					<li><a href="#contact">Arrangementer</a></li>
					<li><a href="loginform.php">Log ind / Log ud</a></li>
					<li><a href="opretform.php">Min side / Opret bruger</a></li>
				</ul>
				<form class="navbar-form navbar-right">
					<input type="text" placeholder="Søg" class="form-control">
					<button type="submit" class="btn btn-success">Søg</button>
				</form>
			</div><!--/.navbar-collapse -->
		</nav>
	</div>
