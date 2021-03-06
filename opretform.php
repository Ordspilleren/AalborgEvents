<?php
session_start();
require_once('functions.php');

if (loggedIn() == true) {
	header('Location: ./minside.php');
}

include('header.php');

if (isset($_SESSION['fejl'])){
	echo "<script>alert('Email addressen er allerede brugt')</script>";
	unset($_SESSION['fejl']);
}
?>
	<div class="container">
		<ol class="breadcrumb">
			<li><a href="index.php">AalborgEvents</a></li>
			<li class="active">Opret bruger</li>
		</ol>


		<div class="row min-form">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3>Opret bruger</h3>
					</div>
					<div class="panel-body">
						



					<!-- Hvis man vil oprette en normal profil -->
					<?php
					if (!isset($_GET['ORG']))
					{
					?>
						<form action="opret.php" method="post" id="form">
							
								<div class="form-group">
									<label for="fornavn">Fornavn:</label>
									<input type="text" name="fornavn" id="fornavn" class="form-control input-sm" placeholder="Indtast dit fornavn" required>
								</div>

								<div class="form-group" id="efternavn">
									<label for="efternavn">Efternavn:</label>
									<input type="text" name="efternavn" class="form-control input-sm" placeholder="Indtast dit efternavn" required>
								</div>

								<div class="form-group">
									<label for="email">E-mail adresse:</label>
									<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Indtast din email" required>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="password">Adgangskode:</label>
											<input type="password" name="password" id="password" class="form-control input-sm" placeholder="Vælg et password" required>
										</div>
									</div>	
									<div class="col-md-6">
										<div class="form-group">
											<label for="pw2">Bekræft adgangskode:</label>
											<input type="password" name="pw2" id="pw2" class="form-control input-sm" placeholder="Bekræft dit password" required>
										</div>
									</div>
								</div>

								<input type="submit" value="Opret bruger" class="btn btn-block">
								<br/>

						
							<div class="row">
								<div class="col-md-6">
									<a class="btn btn-info btn-xs" id="nbruger" href="./opretform.php?ORG">Lav en organisationsprofil</a>
								</div>
							</div>

						</form>





				
					<!-- Hvis man vil oprette en organisationsprofil -->
						<?php 
					}
					else 
					{
					?>
					<form action="opret.php" method="post" id="form" enctype="multipart/form-data">
							

								<div class="form-group">
									<label for="orgnavn">Organisationsnavn:</label>
									<input type="text" name="orgnavn" id="orgnavn" class="form-control input-sm" placeholder="Indtast navnet på din organisation" required>
								</div>
								
								<div class="form-group">
									<label for="beskrivelse">Beskrivelse af organisation:</label>
									<input type="text" class="form-control input-sm" name="beskrivelse" placeholder="Lav en kort beskrivelse af din organisation"></input>
								</div>
							
								<div class="form-group">
									<label for="email">E-mail adresse:</label>
									<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Indtast en email" required>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="password">Adgangskode:</label>
											<input type="password" name="password" id="password" class="form-control input-sm" placeholder="Vælg et password" required>
										</div>
									</div>	
									<div class="col-md-6">
										<div class="form-group">
											<label for="pw2">Bekræft adgangskode:</label>
											<input type="password" name="pw2" id="pw2" class="form-control input-sm" placeholder="Bekræft dit password" required>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="billede">Tilføj et profilbillede:</label>
											<input type="file" name="billede" id="billede" class="input-sm">
										</div>
									</div>
								</div>
								
								<input type="hidden" name="orgprofil" value="1">

								<input type="submit" value="Opret organisationsprofil" class="btn btn-block">
								<br/>

						
							<div class="row">
								<div class="col-md-6">
								<a class="btn btn-info btn-xs" id="nbruger" href="./opretform.php">Lav en normal brugerprofil</a>
								</div>
							</div>

						
						</form>
					<?php }
					?>

					</div>
				</div>
			</div>
		</div>
	</div>

	<script type='text/javascript'>
	$("#form").submit(function(){
    	if($("#password").val()!=$("#pw2").val())
     		{
       	  		alert("password skal være det samme");
        		return false;
     		}
 			});
	</script>
	
	
<?php include('footer.php'); ?>