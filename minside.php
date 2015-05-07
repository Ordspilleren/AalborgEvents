<?php
session_start();
require_once('database.php');
include('header.php');

if (loggedIn() == false) {
	header("Location: ./loginform.php");
}

$brugerid = $_SESSION['brugerid'];
$brugermail = $_SESSION['email'];
?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>Tilmeldte arrangmenter</h2>
            <p>Dette er din personlige side hvor du kan se de arrangementer du er tilmeldt til</p>
            <ul class="event-list">
            	<?php
				foreach (getBrugerEvents($brugerid) as $event) {
				?>
				<li>
					<img alt="<?=$event['eventnavn'];?>" src="img/tnevent/<?=$event['billedsti']?>" />
					<div class="info">
						<span class="date"><?=date("d/m/Y", strtotime($event['startdato']));?></span>
						<h2 class="title"><a href="eventside.php?event=<?=$event['ID'];?>"><?=$event['eventnavn'];?></a></h2>
						<p class="desc"><?=truncate($event['beskrivelse']);?></p>
					</div>
					<div class="social">
						<ul>
							<li class="bookmark" style="width:33%;"><a href="eventside.php?event=<?=$event['ID'];?>&addevent"><span class="fa fa-bookmark"></span></a></li>
							<li class="facebook" style="width:33%;"><a href="#facebook"><span class="fa fa-facebook"></span></a></li>
							<li class="twitter" style="width:34%;"><a href="#twitter"><span class="fa fa-twitter"></span></a></li>
						</ul>
					</div>
				</li>
				<?php } ?>
			</ul>   
		</div>
		
        <div class="col-md-6">
			<h2>Oprettede arrangementer</h2>
			<p>Her kan du se de arrangementer du selv har oprettet</p>
			<ul class="event-list">
				<?php
				$q = "SELECT * FROM Events WHERE bruger = '$brugermail'";
				$events = $DBH->query($q);
				$events->execute();
				foreach ($events as $event) {
				?>
				<li>
					<img alt="<?=$event['eventnavn'];?>" src="img/tnevent/<?=$event['billedsti']?>" />
					<div class="info">
						<span class="date"><?=date("d/m/Y", strtotime($event['startdato']));?></span>
						<h2 class="title"><a href="eventside.php?event=<?=$event['ID'];?>"><?=$event['eventnavn'];?></a></h2>
						<p class="desc"><?=truncate($event['beskrivelse']);?></p>
					</div>
					<div class="social">
						<ul>
							<li class="bookmark" style="width:33%;"><a href="eventside.php?event=<?=$event['ID'];?>&addevent"><span class="fa fa-bookmark"></span></a></li>
							<li class="facebook" style="width:33%;"><a href="#facebook"><span class="fa fa-facebook"></span></a></li>
							<li class="twitter" style="width:34%;"><a href="#twitter"><span class="fa fa-twitter"></span></a></li>
						</ul>
					</div>
				</li>
				<?php } ?>
			</ul>
        </div>
	</div>
	<div class="row">			
		<div class="col-md-12">
			<h2>Arrangører du følger:</h2>
			<p>Lorem ipsum dolar sit amet</p>
			<ul class="event-list">
				<li>
					<img alt="Independence Day" src="http://www.claussondberg.dk/wp-content/uploads/25-FAELS-Karneval-18.jpg" />
					<div class="info">
						<span class="date">24/05/2015</span>
						<h2 class="title">Studenterhuset</h2>
						<p class="desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto ipsum, earum facilis dignissimos numquam reiciendis omnis sit voluptas, sint.</p>
					</div>
					<div class="social">
						<ul>
							<li class="bookmark" style="width:33%;"><a href="#bookmark"><span class="fa fa-bookmark"></span></a></li>
							<li class="facebook" style="width:33%;"><a href="#facebook"><span class="fa fa-facebook"></span></a></li>
							<li class="twitter" style="width:34%;"><a href="#twitter"><span class="fa fa-twitter"></span></a></li>
							
						</ul>
					</div>
				</li>
			</ul>
		</div>	
	</div>
</div>
<?php include('footer.php'); ?>