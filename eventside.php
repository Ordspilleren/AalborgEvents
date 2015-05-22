<?php
session_start();
require_once('database.php');
include('header.php'); 

if(!isset($_GET['event'])) {
	echo "Der skal indtastes et eventid min ven";
}
else{
	$eventid = $_GET['event'];
	$event = getEvent($eventid);
	//print_r($event);	
	$bruger = getUser($event['bruger']);

if (isset($_GET['addevent']) && loggedIn() == true) {
	addFavorite($_SESSION['brugerid'], $eventid);
} 
?>
<div class="container">
	<ol class="breadcrumb">
		<li><a href="index.php">AalborgEvents</a></li>
		<li><a href="eventliste.php">Arrangementer</a></li>
		<li class="active"><?=$event['eventnavn']?></li>
	</ol>
	<?php if (isset($_GET['addevent']) && loggedIn() == false) { ?>
	<div class="alert alert-danger" role="alert">Du skal være logget ind for at tilføje dette arrangement til din side.</div>
	<?php } else if (isset($_GET['addevent']) && loggedIn() == true) { ?>
	<div class="alert alert-success" role="alert">Dette arrangement er nu tilføjet til din side.</div>
	<?php } if (isset($_GET['opret'])) { ?>
	<div class="alert alert-success" role="alert">Dit arrangement er nu blevet oprettet. Dette er siden for dit arrangement.</div>
	<?php } ?>
	<div class="row">
		<div class="col-md-4">
			<div class="event-info">
				<div class="social">
					<ul>
						<li class="facebook" style="width:25%;"><a href="#facebook"><span class="fa fa-facebook"></span></a></li>
						<li class="twitter" style="width:25%;"><a href="#twitter"><span class="fa fa-twitter"></span></a></li>
						<li class="google-plus" style="width:25%;"><a href="#google-plus"><span class="fa fa-google-plus"></span></a></li>
						<li class="instagram" style="width:25%;"><a href="#instagram"><span class="fa fa-instagram"></span></a></li>
					</ul>
				</div>
				<img src="img/tnevent/<?=$event['billedsti']?>" class="img-responsive" alt="">
				
				<?php
				$q = "SELECT * from brugerfavoritter WHERE `eventid` = $eventid";
				$tilmeldte = $DBH->query($q);
				$tilmeldte->execute();

				if ($tilmeldte->rowCount() == 0){
					echo "Ingen brugere har tilføjet dette arrangement til deres side.";
				} else {
					echo $tilmeldte->rowCount() . " brugere har tilføjet dette arrangement til deres side.";
				}

				//hvis det ikke er organisationsbruger
				if ($bruger['brugerstatus'] == 0){
				?>

				<p><strong>Arrangør:</strong><br>
					<?=$event['afholder']?>
				</p>
				<p><strong>Oprettet af:</strong><br>
					<?=$bruger['fornavn'] . " " . $bruger['efternavn'];?>
				<?php
				}
				else{
					//hvis det er organisationsbruger
				?>
				<p><strong>Arrangør</strong><br>
					<a href="./profil.php?profilid=<?=$bruger['ID']?>">
					<?=$bruger['navn'];?></a>
				</p>
				<?php
				}
				?>



				<p><strong>Adresse</strong><br>
				<?=$event['adresse']?>
				</p>
				
				<p>
					<strong>Starter:</strong><br/>
					<time datetime="<?=$event['startdato']?>"><?=date("d/m/Y", strtotime($event['startdato']));?></time><br/>
					<time datetime="<?=$event['starttid']?>"><?=$event['starttid']?></time>
				</p>

				<?php 
				if ($event['slutdato'] !== "0000-00-00"){
				?>
				<p>
					<strong>Slutter:</strong><br/>
					<time datetime="<?=$event['slutdato']?>"><?=date("d/m/Y", strtotime($event['slutdato']));?></time><br/>
					<time datetime="<?=$event['sluttid']?>"><?=$event['sluttid']?></time>
				</p>
				<?php
				}
				?>
				
				
				<!-- Google maps API, (bruger urlencode på den indtastede addresse fra databasen) -->
				<iframe width="100%" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAPR6aYdpgiTTUkNn0qIS8vG0mTUBkDszs&q=<?=urlencode($event['adresse'])?>"></iframe>
				<button type="button" class="btn btn-info btn-block" disabled="disabled">Køb billet</button>
				<a href="?event=<?=$eventid;?>&addevent" class="btn btn-success btn-block">Tilføj til min side</a>
				<?php 
				//hvis eventID på arrangementet passer overens med brugerID på den bruger der ser siden, så kan arrangementet ændres.
				if (isset($_SESSION['email']) && $event['bruger'] == $_SESSION['email']){
				?>
				<a href="./changeevent.php?ID=<?=$eventid;?>" class="btn btn-danger btn-block">Ændre i dette event</a>
				<?php
				}
				?>
			</div>
		</div>

	<!-- midter kolonne med info -->
		<div class="col-md-4">
			<div class="event-desc">
				<h1><?=$event['eventnavn']?></h1>
				<p><?=$event['beskrivelse']?></p>
			</div>
		</div>

	<!-- Lignende events kolonne -->
		<div class="col-md-4">
			<div class="featured-events">
				<h1>Lignende events</h1>
				<ul class="event-list-small">
					<?php
					$q = "SELECT * FROM Events WHERE kategorier = '$event[kategorier]'";
					$events = $DBH->query($q);
					$events->execute();
					foreach ($events as $event) {
					?>
					<li>
						<img alt="<?=$event['eventnavn'];?>" src="img/tnevent/<?=$event['billedsti']?>" />
						<div class="info">
							<h1><a href="eventside.php?event=<?=$event['ID'];?>"><?=$event['eventnavn'];?></a></h1>
						</div>
					</li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</div>
</div>
<?php
}
?>


<?php include('footer.php'); ?>