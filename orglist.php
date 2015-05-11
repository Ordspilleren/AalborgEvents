<?php
session_start();
require_once('database.php');
include('header.php');
?>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="index.php">AalborgEvents</a></li>
		<li class="active">Arrangører</li>
	</ol>
	<div class="row">
		<div class="col-md-12">
			<h1>Arrangører</h1>
			<ul class="event-list-small">
				<?php
				$q = "SELECT * FROM Brugere WHERE brugerstatus = 1";
				$orgs = $DBH->query($q);
				$orgs->execute();
				foreach ($orgs as $org) {
				?>
				<li>
					<img alt="<?=$org['navn'];?>" src="img/brugerpic/<?=(empty($org['profilbanner'])) ? "default.png" : $org['profilbanner']?>" />
					<div class="info">
						<h1><a href="profil.php?profilid=<?=$org['ID'];?>"><?=$org['navn'];?></a></h1>
					</div>
				</li>
					<?php } ?>
			</ul>
		</div>
	</div>
</div>

<?php include('footer.php'); ?>