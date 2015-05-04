<?php
session_start();
include ('header.php'); ?>

<div class="container">
		<div class="row min-form">
			<div class="col-sm-12">
				<div class="panel panel-default">
					<div class="panel-heading">
							<h3>Opret et nyt arrangement</h3>
					</div>
					<div class="panel-body">
						<div>
							<p>Her kan du oprette et arrangement på siden. Arrangementet vil være synligt for alle efter mellem 20-24 timer.</p>
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
								<div class="col-sm-6">
									<div class="form-group">
											<label for="afholder">Arrangør:</label>
										<div>
											<input type="text" name="afholder" id="afholder" class="form-control input-sm" placeholder="Indtast sted" required>
										</div>
									</div>
								</div>

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

											<button class="btn btn-info btn-xs" id="sluttid">Tilføj sluttidspunkt</button>
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
											<input type="text" name="adresse" class="form-control input-sm" placeholder="Indtast et vejnavn og nummer">
										</div>
									</div>
								</div>


								<!-- Kategorier (udskift evt. med keywordS?? lave et eller andet her.) -->
								<div class="col-sm-6">
									<div class="form-group">
										<label for="kategori">Vælg en eller flere kategorier:</label>
										<div class="">
											<select name="kategorier" id="kategori" class="form-control input-sm" multiple>
												<option value="Aalborg" selected="selected">Aalborg</option>
												<option value="Musik">Musik</option>
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


	<!-- script til at vise sluddato hvis det vælges -->
<script>
window.onload = function() {
$( "#sluttid" ).click(function() {
  $( "#slutdato" ).show( "slow" );
  $( "#sluttid" ).hide();
});
};
</script>

<? include('footer.php'); ?>