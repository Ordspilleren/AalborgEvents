<?php
session_start();
include_once('database.php');
include('header.php');

$profilid = $_GET['profilid'];
$bruger = getUser($profilid);

if (isset($_GET['follow']) && loggedIn() == true) {
	addFollow($_SESSION['brugerid'], $bruger['ID']);
}
?>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="index.php">AalborgEvents</a></li>
		<li class="active"><?=$bruger['navn'];?></li>
	</ol>
	<?php if (isset($_GET['follow']) && loggedIn() == false) { ?>
	<div class="alert alert-danger" role="alert">Du skal være logget ind for at følge denne arrangør.</div>
	<?php } else if (isset($_GET['follow']) && loggedIn() == true) { ?>
	<div class="alert alert-success" role="alert">Du følger nu denne arrangør. Arrangøren kan nu findes på din side.</div>
	<?php } ?>

	<div class="row">
		<div class="col-md-12">
			<div class="profile">
				<div class="col-md-3">
					<div class="profileimg">
						<img class="img-responsive" src="img/brugerpic/<?=(empty($bruger['profilbanner'])) ? "default.png" : $bruger['profilbanner']?>"/>
					</div>
				</div>

				<div class="col-md-9">
					<div class="follow">
						<a href="?profilid=<?=$profilid;?>&follow" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Følg</a>
					</div>
					<h2 class="profile-title"><?=$bruger['navn'];?></h2>
					<p class="info">
						<?=$bruger['beskrivelse'];?>
					</p>
				</div>
			</div>
		</div>
	</div>
				
	<div class="row">
		<div class="col-md-12">
			<h1>Næste arrangement fra denne arrangør:</h1>
			<ul class="event-list">
            	<?php
				$q = "SELECT * FROM Events WHERE bruger = '$bruger[email]' AND `startdato` >= CURDATE() ORDER BY `startdato` LIMIT 1";
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
			<h1>Kommende arrangementer fra denne arrangør:</h1>
			<ul class="event-list">
            	<?php
				$q = "SELECT * FROM Events WHERE bruger = '$bruger[email]' AND startdato > NOW() - INTERVAL 30 DAY";
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
</div>


<?php 
include('footer.php');
 ?>