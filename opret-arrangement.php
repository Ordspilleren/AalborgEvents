<?php
session_start();
require_once('database.php');
require_once('functions.php');



include ('header.php'); 
if (loggedIn() == true) {
	//tjekker om det er en organisation eller normalbruger
	$email = $_SESSION['email'];
	$status = getUserstatus($email);
?>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="index.php">AalborgEvents</a></li>
		<li class="active">Opret arrangement</li>
	</ol>
		<div class="row min-form">
			<div class="col-sm-12">
				<div class="panel panel-default">
					<div class="panel-heading">
							<h3>Opret et nyt arrangement</h3>
					</div>
					<div class="panel-body">
						<div>
							<p>Her kan du oprette et arrangement på siden.</p>
							<br>
						</div>
						
						<form action="eventsubmit.php" method="post" enctype="multipart/form-data">
							<div class="row">
								

								<!-- Billede upload (lav preview senere) -->
								<div class="form-group col-sm-6">
									<div id="image-preview" style="display: block">
										<img id="preview-img" class="img-responsive img-thumbnail" src="img/opretthumbnail.jpeg">
									</div>
									<input type="file" name="billede" id="billede">
								</div>
								
								<!-- Navn på arrangementet -->
								<div class="col-sm-6">
									<div class="form-group">
										<label for="eventnavn">Navn på event:</label>
										<input type="text" name="eventnavn" id="eventnavn" class="form-control input-sm" placeholder="Indtast navnet på arrangementet" required>
									</div>
								</div>
								

								<!-- Navn på arrangør af arrangement -->
								<?php 
								if ($status == '0'){
								?>
								<div class="col-sm-6">
									<div class="form-group">
										<label for="afholder">Arrangør:</label>
										<div>
											<input type="text" name="afholder" id="afholder" class="form-control input-sm" placeholder="Indtast arrangør" required>
										</div>
									</div>
								</div>
								<?php
								}
								?>
								<!-- dato vælger -->
								<div class="col-sm-6">
									<div class="form-group">
											<label for="dato">Vælg en dato og starttidspunkt:</label>
										<div class="form-inline">
										<?php
										//sæt dato idag til minimum dato som brugeren kan indtaste. 
										$datoidag = date('Y-m-d');
										?>

										<span class="inner-addon">
											<i class="glyphicon glyphicon-calendar"></i>
											<input type="date" name="startdato" id="dato" class="form-control input-sm" min="<?php echo $datoidag; ?>" max="2020-12-31" required>
										</span>
											<!-- valgfrit om man vil tilhøje en tid ??-->
										
										<span class="inner-addon">
											<i class="glyphicon glyphicon-time"></i>
											<input type="time" name="starttid" id="starttid" class="form-control input-sm">
										</span>

											<span class="btn btn-info btn-xs" id="sluttid">Tilføj sluttidspunkt</span>
										</div>
									</div>
								</div>
							
								
								<!-- Hvis slutdato skal vælges - er gemt som standart -->
								<div class="col-sm-6" id="slutdato" style="display: none">
									<div class="form-group">
											<label for="dato">Vælg slutdato og sluttidspunkt:</label>
										<div class="form-inline">
							
											<span class="inner-addon">
												<i class="glyphicon glyphicon-calendar"></i>
												<input type="date" name="slutdato" id="dato2" class="form-control input-sm" min="<?php echo $datoidag; ?>" max="2020-12-31">
											</span>

											<span class="inner-addon">
												<i class="glyphicon glyphicon-time"></i>
												<input type="time" name="sluttid" id="tid2" class="form-control input-sm">
											</span>
										</div>
									</div>
								</div>
								
								<!-- addresse på arrangementet -->
								<div class="col-sm-6">
									<div class="form-group">
										<label for="adresse">Indtast adresse hvor arrangementet afholdes:</label>

										<div class="inner-addon">
											<i class="glyphicon glyphicon-map-marker"></i>
											<input type="text" name="adresse" class="form-control input-sm" placeholder="Indtast et vejnavn og nummer" required>
										</div>
									</div>
								</div>


								<!-- Kategorier (udskift evt. med keywordS?? lave et eller andet her.) -->
								<div class="col-sm-6">
									<div class="form-group">
										<label for="kategori">Vælg en kategori:</label>
										<div class="">
											<select name="kategorier" id="kategori" class="form-control input-sm" required>
												<option value="Diverse">Diverse</option>
												<option value="Familien">For hele familien</option>
												<option value="Fest">Fest</option>
												<option value="Foredrag">Foredrag</option>
												<option value="Hygge">Hygge</option>
												<option value="Kunst">Kunst & kultur</option>
												<option value="Mad">Mad & Drikke</option>
												<option value="Musik">Musik</option>
												<option value="Natur">Natur</option>
												<option value="Sport">Sport & motion</option>
											</select>
										</div>
									</div>
								</div>

								

								<!-- beskrivelse -->
								<div class="col-sm-6">
									<div class="form-group">
										<label for="beskrivelse">Beskrivelse:</label>
										<textarea name="beskrivelse" id="beskrivelse" cols="30" rows="4" class="form-control" placeholder="Tilføj en beskrivelse af arrangementet:"></textarea>
									</div>
								</div>
								
								<!-- Submit knap -->
								<div class="col-sm-4 col-sm-offset-4">
									<input type="submit" name="submitknap" value="Opret arrangement" class="btn btn-block">
								</div>

							</div>
						</form>

					</div>
				</div>
			</div>
		</div>
	</div>
<?php
}
else {
?>
<div class="container">
Du skal være <a href="./loginform.php">logget ind</a> for at oprette et arrangement.
</div>
<?php
}
?>



	<!-- script til at vise sluddato hvis det vælges -->
<script>
window.onload = function() {
$( "#sluttid" ).click(function() {
  $( "#slutdato" ).show( "slow" );
  $( "#sluttid" ).hide();
});
};
</script>

<?php include('footer.php'); ?>