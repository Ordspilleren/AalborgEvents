<?php
session_start();
include('header.php');

if (isset($_SESSION['fejl'])){
	echo "<script>alert('Forkert password')</script>";
	unset($_SESSION['fejl']);
}
?>
	<div class="container">
		<?php if (isset($_GET['opret']) && loggedIn() == false) { ?>
		<div class="alert alert-success" role="alert">Din bruger er oprettet. Du kan nu logge ind her.</div>
		<?php } ?>
		<ol class="breadcrumb">
			<li><a href="index.php">AalborgEvents</a></li>
			<li class="active">Log ind</li>
		</ol>
		<div class="row min-form">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3>Login</h3>
					</div>
					<div class="panel-body">
						<form action="login.php" method="post">
							
								<div class="form-group">
									<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Indtast din email" required>
								</div>
								
								<div class="form-group">
									<input type="password" name="password" id="password" class="form-control input-sm" placeholder="Skriv dit password" required>
								</div>
								
							<input type="submit" value="Login" class="btn btn-block">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	
<?php include('footer.php'); ?>