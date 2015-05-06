<?php
session_start();
require_once('database.php');
include('header.php'); 

if(!isset($_GET['event'])) {
	echo "Der skal indtastes et eventid min ven";
}
else{
	$eventid = $_GET['event'];
	echo $eventid;
	$event = getEvent($eventid);
	//print_r($event);
}
?>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="index.php">AalborgEvents</a></li>
		<li><a href="eventliste.php">Arrangementer</a></li>
		<li class="active"><?=$event['eventnavn']?></li>
	</ol>
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
				<p><b>Afholder</b><br>
					<?=$event['afholder']?>
				</p>

				<p><strong>Adresse</strong>
				<address>
					<?=$event['adresse']?>
				</address>
				</p>
				
				<p>
					<strong>Starter:</strong><br/>
					<time datetime="<?=$event['startdato']?>"><?=$event['startdato']?> </time><br/>
					<time datetime="<?=$event['starttid']?>"><?=$event['starttid']?></time>
				</p>

				<?php 
				if (!empty($event['slutdato'])){
				?>
				<p>
					<strong>Slutter:</strong><br/>
					<time datetime="<?=$event['slutdato']?>"><?=$event['slutdato']?> </time><br/>
					<time datetime="<?=$event['sluttid']?>"><?=$event['sluttid']?></time>
				</p>
				<?php
				}
				?>



				
				

				<iframe width="100%" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=Studenterhuset%2C%20Gammeltorv%2C%20Aalborg%2C%20Danmark&key=AIzaSyAPR6aYdpgiTTUkNn0qIS8vG0mTUBkDszs"></iframe>
				<button type="button" class="btn btn-info btn-block" disabled="disabled">Køb billet</button>
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
					<li>
						<img alt="Independence Day" src="http://www.claussondberg.dk/wp-content/uploads/25-FAELS-Karneval-18.jpg" />
						<div class="info">
							<h1>Aalborg Karneval</h1>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>

<?php include('footer.php'); ?>