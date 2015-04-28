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
						</div>
						<form action="eventsubmit.php" method="post" id="form">
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label for="1"></label>
										<input type="text" name="fornavn" id="fornavn" class="form-control input-sm" placeholder="Indtast dit fornavn" required>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<input type="text" name="efternavn" id="efternavn" class="form-control input-sm" placeholder="Indtast dit efternavn" required>
									</div>
								</div>
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


<? include('footer.php'); ?>