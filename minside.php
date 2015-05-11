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
	<ol class="breadcrumb">
		<li><a href="index.php">AalborgEvents</a></li>
		<li class="active">Min side</li>
	</ol>
    <div class="row">
        <div class="col-md-6">
            <h2>Gemte arrangmenter</h2>
            <p>Her kan du se de arrangementer du har gemt</p>
            <ul class="event-list">
            	<?php
				foreach (getBrugerEvents($brugerid) as $event) {
					$bruger = getUser($event['bruger']);
				?>
				<li>
					<img alt="<?=$event['eventnavn'];?>" src="img/tnevent/<?=$event['billedsti']?>" />
					<div class="info">
						<span class="date"><?=date("d/m/Y", strtotime($event['startdato']));?></span>
						<h2 class="title"><a href="eventside.php?event=<?=$event['ID'];?>"><?=$event['eventnavn'];?></a></h2>
						<?php if ($bruger['brugerstatus'] == 1) { ?>
						<p class="org"><a href="profil.php?profilid=<?=$bruger['ID']?>"><?=$bruger['navn'];?></a></p>
						<?php } ?>
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
			<h2>Arrangementer fra arrangører du følger:</h2>
			<ul class="event-list">
            	<?php
            	$q = "SELECT * from Brugere inner join brugerfavoritter on brugerfavoritter.following=Brugere.ID WHERE brugerfavoritter.brugerid='$brugerid'";
				$brugere = $DBH->query($q);
				$brugere->execute();
				foreach ($brugere as $bruger) {
					$q = "SELECT * from Events WHERE bruger='$bruger[email]'";
					$events = $DBH->query($q);
					$events->execute();
					foreach ($events as $event) {
				?>
				<li>
					<img alt="<?=$event['eventnavn'];?>" src="img/tnevent/<?=$event['billedsti']?>" />
					<div class="info">
						<span class="date"><?=date("d/m/Y", strtotime($event['startdato']));?></span>
						<h2 class="title"><a href="eventside.php?event=<?=$event['ID'];?>"><?=$event['eventnavn'];?></a></h2>
						<?php if ($bruger['brugerstatus'] == 1) { ?>
						<p class="org"><a href="profil.php?profilid=<?=$bruger['ID']?>"><?=$bruger['navn'];?></a></p>
						<?php } ?>
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
				<?php } } ?>
			</ul>
		</div>	
	</div>
</div>
<?php include('footer.php'); ?>