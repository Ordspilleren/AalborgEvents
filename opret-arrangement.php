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
						
						<form role="form" action="eventsubmit.php" method="post" id="form">
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
										<input type="text" name="eventnavn" id="fornavn" class="form-control input-sm" placeholder="Indtast navnet på arrangementet" required>
									</div>
								</div>
								

								<!-- Navn på arrangør af arrangement -->
								<div class="col-sm-6">
									<div class="form-group">
											<label for="efternavn">Arrangør:</label>
										<div>
											<input type="text" name="efternavn" id="efternavn" class="form-control input-sm" placeholder="Indtast sted" required>
										</div>
									</div>
								</div>

								<!-- dato vælger -->
								<div class="col-sm-6">
									<div class="form-group">
											<label for="dato">Vælg en dato og starttidspunkt:</label>
										<div class="form-inline">
										<?php
										//sæt dato idag til min dato brugeren kan indtaste. 
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
												<input type="date" name="slutdato" id="dato2" class="form-control input-sm" min="<?php echo $datoidag; ?>" max="2020-12-31" required>
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
										<div class="">
											<input type="text" name="adresse" class="form-control input-sm" placeholder="Indtast et vejnavn og nummer">
										</div>
									</div>
								</div>


								<!-- Kategorier (udskift evt. med keywordS?? lave et eller andet her.) -->
								<div class="col-sm-6">
									<div class="form-group">
										<label for="kategori">Vælg en eller flere kategorier:</label>
										<div class="">
											<input type="dropdown" name="kategorier" class="form-control input-sm">
										</div>
									</div>
								</div>



							</div>

							<!--  -->
								<div class="form-group">
									<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Indtast din email" required>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<input type="password" name="password" id="password" class="form-control input-sm" placeholder="Vælg et password" required>
										</div>
									</div>	
									<div class="col-md-6">
										<div class="form-group">
											<input type="password" name="pw2" id="pw2" class="form-control input-sm" placeholder="Bekræft dit password" required>
										</div>
									</div>	
								</div>
							<input type="submit" value="Opret bruger" class="btn btn-block">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
<script>
window.onload = function() {
$( "#sluttid" ).click(function() {
  $( "#slutdato" ).show( "slow" );
  $( "#sluttid" ).hide();
});
};
</script>

<? include('footer.php'); ?>