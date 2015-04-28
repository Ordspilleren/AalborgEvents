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
		//
		else {
			//sæt tilladte filtyper
			$tilladte = array('jpg', 'jpeg', 'png', 'gif');
			//Sæt variabel med navn på fil
			$filnavn = $_FILES['billede']['name'];
			//sæt variabel med fil extentionen i lowercase
			$filexp = explode('.', $filnavn);
			$filextn = strtolower(end($filexp));
			//sæt variabel med det midlertidige sted filen bliver gemt.
			$filtemp = $_FILES['billede']['tmp_name'];

			//tjek om billedet har en tilladt extention
			if (in_array($filextn, $tilladte)){
				//sæt thumbnail.
				$thumbnail = $filtemp;
				echo $thumbnail;
			}
			else {
				echo 'Den uploadede fil er en ikke tilladt. De tilladte billedtyper er: .jpg, .jpeg, .png og .gif';
			}
		}
	}

	?>
	<div class="thumbnail">
		<div id="image-preview" style="display: block">
			<?php 
				if (empty($thumbnail) === true){
					echo '<img id="preview-img" src="img/opretthumbnail.jpeg">';
				}
				else {
					echo '<img id="preview-img" src="' . $thumbnail . '">';
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



<?php
include ('footer.php');
?>