<?php
require_once('functions.php');
function echoActiveClassIfRequestMatches($requestUri)
{
  $current_file_name = basename($_SERVER['REQUEST_URI']);

  if ($current_file_name == $requestUri)
    echo 'class="active"';
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>EventIT</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>

	<div class="container header">
		<div class="logo"></div>
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
					<li <?=echoActiveClassIfRequestMatches("index.php")?>> 
						<a href="index.php">Forside</a>
					</li>
					<li <?=echoActiveClassIfRequestMatches("eventliste.php")?>> 
						<a href="eventliste.php">Arrangementer</a>
					</li>
					<li <?=echoActiveClassIfRequestMatches("loginform.php")?>> 
						<a href="login.php"><?=(loggedIn() == true) ? "Log ud" : "Log ind"?></a>
					</li>
					<li <?=echoActiveClassIfRequestMatches("opretform.php")?> <?=echoActiveClassIfRequestMatches("minside.php")?>>
						<a href="opretform.php"><?=(loggedIn() == true) ? "Min side" : "Opret bruger"?></a>
					</li>
					<li	<?=echoActiveClassIfRequestMatches("opret-arrangement.php")?>> 
						<a href="opret-arrangement.php">Opret arrangement</a>
					</li>
					
				</ul>
				<form class="navbar-form navbar-right">
					<input type="text" placeholder="Søg" class="form-control" disabled="disabled">
					<button type="submit" class="btn btn-success" disabled="disabled">Søg</button>
				</form>
			</div><!--/.navbar-collapse -->
		</nav>
	</div>
