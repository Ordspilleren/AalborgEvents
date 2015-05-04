<?php
include ('header.php');
?>

<div class="container">	    

	<?php


	//tjek om der er blevet trykket submit på billedet.
	if (isset($_FILES['billede']) === true){
		//tjek om der er blevet uploadet et tomt billede.
		if (empty($_FILES['billede']['name']) === true){
			echo "vælg venligst et billede";
		}
		elseif (isset($filnavn) && $_FILES['billede']['name'] === $filnavn) {
			echo "Billedet er allerede uploadet";
		}

		// hvis der er blevet trykket submit og billedet ikke allerede er forsøgt uploadet
		else {
			//sæt tilladte filtyper
			$tilladte = array('jpg', 'jpeg', 'png', 'gif');

			//sæt variabel med det midlertidige sted filen bliver gemt.
			$filtemp = $_FILES['billede']['tmp_name'];
			
			//Sæt variabel med navn på fil
			$filnavn = $_FILES['billede']['name'];
			
			//sæt variabel med fil extentionen i lowercase
			$filexp = explode('.', $filnavn);
			$filextn = strtolower(end($filexp));


				//tjek om billedet har en tilladt extention
				if (in_array($filextn, $tilladte)){
					//flyt filen midlertidigt for at lave et thumbnail.
					$tempdst= 'img/tnevent/' . substr(md5(time()), 0, 10) . '.' . $filextn;
					move_uploaded_file($filtemp, $tempdst);

				}
				else {
					echo 'Den uploadede fil er en ikke tilladt. De tilladte billedtyper er: .jpg, .jpeg, .png og .gif';
				}
		}
	}
	?>
	
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">	
				<div id="image-preview" style="display: block">
					<?php 
					if (empty($tempdst) === true){
						echo '<img id="preview-img" class="img-responsive" src="img/opretthumbnail.jpeg">';
					}
					else {
						echo '<img id="preview-img" class="img-responsive" src="' . $tempdst . '">';
					}
					?>

				</div>


				<form id="upload-image" action="" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<input type="file" name="billede" id="billede">
					</div>
					<div class="form-group">
						<input type="submit" class="btn btn-default" value="Upload billede">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>



<?php
include ('footer.php');
?>