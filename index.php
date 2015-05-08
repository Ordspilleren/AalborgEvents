<?php
session_start();
include_once('database.php');
include('header.php');

?>

	<div class="container content">
		<div class="row">
			<div class="col-md-12">
				<div class="jumbotron">
					<h1>Om siden</h1>
					<p>Denne side giver dig et overblik over arrangementer i Aalborg, du kan bl.a.:</p>
					<ul>
						<li>Se hvilke arrangementer der bliver afholdt.</li>
						<li>Oprette dit eget arrangement.</li>
						<li>Samle dine foretrukne arrangementer.</li>
						<li>Følge din favorit arrangør.</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
				<h2>Featured arrangementer</h2>
				<ul class="event-list">
					<?php
					$q = "SELECT * from Events inner join brugerfavoritter on brugerfavoritter.eventid=Events.ID ORDER BY eventid DESC LIMIT 5";
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
			<div class="col-md-4">
				<h2>Kategorier</h2>
				<ul class="eventkategorier">
					<li>
						<a href="?kategori=Sport">
							<img src="img/kategorier/sport.png" alt="">
							<h2 class="title">Sport & Motion</h2>
						</a>
					</li>
					<li>
						<a href="?kategori=Musik">
							<img src="img/kategorier/musik.png" alt="">
							<h2 class="title">Musik</h2>
						</a>
					</li>
					<li>
						<a href="?kategori=Fest">
							<img src="img/kategorier/fest.png" alt="">
							<h2 class="title">Fest</h2>
						</a>
					</li>
					<li>
						<a href="?kategori=Foredrag">
							<img src="img/kategorier/foredrag.png" alt="">
							<h2 class="title">Foredrag</h2>
						</a>
					</li>
					<li>
						<a href="?kategori=Familien">
							<img src="img/kategorier/familien.png" alt="">
							<h2 class="title">For hele familien</h2>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>

<?php include('footer.php'); ?>