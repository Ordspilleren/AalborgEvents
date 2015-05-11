<?php
session_start();
require_once('database.php');
require_once('functions.php');

include ('header.php'); 

//hent info fra db om event der skal ændres:
$id = $_GET['ID'];
$event = getEvent($id);

//tjek om den loggede-ind bruger er den person som har lavet eventet.
if ($event['bruger'] == $_SESSION['email']) {

?>
<div class="container">
		<div class="row min-form">
			<div class="col-sm-12">
				<div class="panel panel-default">
					<div class="panel-heading">
							<h3>Ændre dit arrangement</h3>
					</div>
					<div class="panel-body">
						<div>
							<p>Her kan du ændre dit arrangement på siden.</p>
							<br>
						</div>
						
						<form action="updateevent.php" method="post" enctype="multipart/form-data">
							<div class="row">
								<!-- sæt en hidden med ID -->
								<input type="hidden" name="ID" value="<?=$id?>">


								<!-- Navn på arrangementet -->
								<div class="col-sm-6">
									<div class="form-group">
										<label for="eventnavn">Navn på event:</label>
										<input type="text" name="eventnavn" id="eventnavn" class="form-control input-sm" placeholder="Indtast navnet på arrangementet" value="<?=$event['eventnavn']?>" required>
									</div>
								</div>
								

								<!-- Navn på arrangør af arrangement -->
								<div class="col-sm-6">
									<div class="form-group">
											<label for="afholder">Arrangør:</label>
										<div>
											<input type="text" name="afholder" id="afholder" class="form-control input-sm" placeholder="Indtast sted" value="<?=$event['afholder']?>">
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
										<!-- Startdato -->
										<span class="inner-addon">
											<i class="glyphicon glyphicon-calendar"></i>
											<input type="date" name="startdato" id="dato" class="form-control input-sm" min="<?php echo $datoidag; ?>" max="2020-12-31" value="<?=$event['startdato']?>" required>
										</span>
					
										
										<span class="inner-addon">
											<i class="glyphicon glyphicon-time"></i>
											<input type="time" name="starttid" id="starttid" class="form-control input-sm" value="<?=$event['starttid']?>" required>
										</span>

										</div>
									</div>
								</div>
							
								
								<!-- Slutdato-->
								<div class="col-sm-6" id="slutdato">
									<div class="form-group">
											<label for="dato">Vælg slutdato og sluttidspunkt:</label>
										<div class="form-inline">
											<span class="inner-addon">
												<i class="glyphicon glyphicon-calendar"></i>
												<input type="date" name="slutdato" id="dato2" class="form-control input-sm" min="<?php echo $datoidag; ?>" max="2020-12-31" value="<?=$event['slutdato']?>">
											</span>

											<span class="inner-addon">
												<i class="glyphicon glyphicon-time"></i>
												<input type="time" name="sluttid" id="tid2" class="form-control input-sm" value="<?=$event['sluttid']?>">
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
											<input type="text" name="adresse" class="form-control input-sm" placeholder="Indtast et vejnavn og nummer" value="<?=$event['adresse']?>" required>
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
										<textarea name="beskrivelse" id="beskrivelse" cols="30" rows="4" class="form-control" placeholder="Tilføj en beskrivelse af arrangementet:"><?=$event['beskrivelse']?></textarea>
									</div>
								</div>
								
								<!-- Submit knap -->
								<div class="col-sm-4 col-sm-offset-4">
									<input type="submit" name="submitknap" value="Ændre arrangement" class="btn btn-block">
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
	echo "Du har ikke tilladelse til at ændre dette arrangment";
}
?>



<? include('footer.php'); ?>