<?php include('header.php'); ?>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="index.php">AalborgEvents</a></li>
		<li class="active">Arrangementer</li>
	</ol>
	<div class="row">
		<div class="col-md-3">
			<ul class="eventkategorier">
				<li>
					<img src="img/fest.png" alt="">
					<h2 class="title">Musik</h2>
				</li>
				<li>
					<img src="http://placehold.it/500x100" alt="">
					<h2 class="title">Kategori</h2>
				</li>
			</ul>
		</div>
		<div class="col-md-9">
			<ul class="event-list">
				<li>
					<img alt="Independence Day" src="http://www.claussondberg.dk/wp-content/uploads/25-FAELS-Karneval-18.jpg" />
					<div class="info">
						<span class="date">24/05/2015</span>
						<h2 class="title"><a href="eventside.php">Aalborg Karneval</a></h2>
						<p class="desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto ipsum, earum facilis dignissimos numquam reiciendis omnis sit voluptas, sint.</p>
					</div>
					<div class="social">
						<ul>
							<li class="facebook" style="width:33%;"><a href="#facebook"><span class="fa fa-bookmark"></span></a></li>
							<li class="twitter" style="width:34%;"><a href="#twitter"><span class="fa fa-twitter"></span></a></li>
							<li class="google-plus" style="width:33%;"><a href="#google-plus"><span class="fa fa-google-plus"></span></a></li>
						</ul>
					</div>
				</li>
			</ul>
		</div>
	</div>
</div>

<?php include('footer.php'); ?>