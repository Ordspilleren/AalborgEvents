<?php
session_start();
if (isset($_SESSION['fejl'])){
	echo "<script>alert('Forkert password')</script>";
	unset($_SESSION['fejl']);
}
?>
<? include('header.php'); ?>
	<div class="container">
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
	
<? include('footer.php'); ?>