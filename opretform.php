<?php
session_start();
if (isset($_SESSION['fejl'])){
	echo "<script>alert('Email addressen er allerede brugt')</script>";
	unset($_SESSION['fejl']);
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Aalborg Events</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/bootstrap-theme.css">
	<link rel="stylesheet" href="css/merecss.css">
	<script src="js/bootstrap.min.js" type="text/javascript" charset="utf-8" async defer></script>
</head>
<body>
	<div class="container">
		<div class="row min-form">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3>Opret bruger</h3>
					</div>
					<div class="panel-body">
						<form action="opret.php" method="post">
							
								<div class="form-group">
									<input type="text" name="fornavn" id="fornavn" class="form-control input-sm" placeholder="Indtast dit fornavn" required>
								</div>

								<div class="form-group">
									<input type="text" name="efternavn" id="efternavn" class="form-control input-sm" placeholder="Indtast dit efternavn" required>
								</div>

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
  		$("#form").submit(function(){
    if($("#password").val()!=$("#pw2").val())
     	{
       	  	alert("password should be same");
        	return false;
     	}
 		})
	</script>
	
</body>
</html>