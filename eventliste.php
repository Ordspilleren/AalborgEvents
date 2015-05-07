<?php
session_start();
require_once('database.php');
include('header.php');

if(isset($_GET['kategori'])) {
	$kategori = $_GET['kategori'];
} else {
	$kategori = "Diverse";
}
?>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="index.php">AalborgEvents</a></li>
		<li>Arrangementer</li>
		<li class="active"><?=$kategori?></li>
	</ol>
	<div class="row">
		<div class="col-md-3">
			<ul class="eventkategorier">
				<li>
					<a href="?kategori=Sport">
						<img src="http://placehold.it/500x100" alt="">
						<h2 class="title">Sport & Motion</h2>
					</a>
				</li>
				<li>
					<a href="?kategori=Musik">
						<img src="http://placehold.it/500x100" alt="">
						<h2 class="title">Musik</h2>
					</a>
				</li>
				<li>
					<a href="?kategori=Hygge">
						<img src="http://placehold.it/500x100" alt="">
						<h2 class="title">Hygge</h2>
					</a>
				</li>
				<li>
					<a href="?kategori=Kunst">
						<img src="http://placehold.it/500x100" alt="">
						<h2 class="title">Kunst & Kultur</h2>
					</a>
				</li>
				<li>
					<a href="?kategori=Mad">
						<img src="http://placehold.it/500x100" alt="">
						<h2 class="title">Mad & Drikke</h2>
					</a>
				</li>
				<li>
					<a href="?kategori=Natur">
						<img src="http://placehold.it/500x100" alt="">
						<h2 class="title">Natur</h2>
					</a>
				</li>
				<li>
					<a href="?kategori=Fest">
						<img src="img/fest.png" alt="">
						<h2 class="title">Fest</h2>
					</a>
				</li>
				<li>
					<a href="?kategori=Foredrag">
						<img src="http://placehold.it/500x100" alt="">
						<h2 class="title">Foredrag</h2>
					</a>
				</li>
				<li>
					<a href="?kategori=Familien">
						<img src="http://placehold.it/500x100" alt="">
						<h2 class="title">For hele familien</h2>
					</a>
				</li>
				<li>
					<a href="?kategori=Diverse">
						<img src="http://placehold.it/500x100" alt="">
						<h2 class="title">Diverse</h2>
					</a>
				</li>
			</ul>
		</div>
		<div class="col-md-9">
			<ul class="event-list">
				<?php
				$q = "SELECT * FROM Events WHERE kategorier = '$kategori'";
				$events = $DBH->query($q);
				$events->execute();
				foreach ($events as $event) {
				?>
				<li>
					<img alt="Independence Day" src="http://www.claussondberg.dk/wp-content/uploads/25-FAELS-Karneval-18.jpg" />
					<div class="info">
						<span class="date"><?=date("d/m/Y", strtotime($event['startdato']));?></span>
						<h2 class="title"><a href="eventside.php?event=<?=$event['ID'];?>"><?=$event['eventnavn'];?></a></h2>
						<p class="desc"><?=truncate($event['beskrivelse']);?></p>
					</div>
					<div class="social">
						<ul>
							<li class="facebook" style="width:33%;"><a href="#facebook"><span class="fa fa-bookmark"></span></a></li>
							<li class="twitter" style="width:34%;"><a href="#twitter"><span class="fa fa-twitter"></span></a></li>
							<li class="google-plus" style="width:33%;"><a href="#google-plus"><span class="fa fa-google-plus"></span></a></li>
						</ul>
					</div>
				</li>
				<?php } ?>
			</ul>
		</div>
	</div>
</div>

<?php include('footer.php'); ?>