<?php
	if((isset($_POST['submit_register'])) && (empty($_POST['voornaam']) || empty($_POST['achternaam']) || empty($_POST['email']) || empty($_POST['telefoon']) || empty($_POST['adres']) || empty($_POST['wachtwoord']))){
		echo '<div class="alert alert-danger alert-dismissable ">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  Vul a.u.b alle velden in.
			</div>';
	}else{
		if(isset($_POST['submit_register'])){	
			$fname = htmlentities($_POST['voornaam']);
			$lname = htmlentities($_POST['achternaam']);
			$email = htmlentities($_POST['email']);
			$phone = htmlentities($_POST['telefoon']);
			$adres = htmlentities($_POST['adres']);
			$pass = password_hash(htmlentities($_POST['wachtwoord']), PASSWORD_BCRYPT);

			$sql = "INSERT INTO user (UserID, FirstName, LastName, Email, PhoneNumber, Adres, Password, AccessLevel)
					VALUES ('', '".$fname."', '".$lname."', '".$email."', '".$phone."', '".$adres."', '".$pass."', '1')";

			if (!mysqli_query($dbc, $sql)) {
				echo '<div class="alert alert-danger alert-dismissable ">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  Er is iets mis gegaan tijdens het registreren. Probeer het a.u.b opnieuw.
				</div>';
			}else{
				echo '<div class="alert alert-success alert-dismissable ">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  Uw account is aangemaakt. U kunt nu inloggen.
				</div>';			
			}
			
			mysqli_close($dbc);
		}
	}
?>
			
<div id="register" class="modal fade" role="dialog">
  <div class="modal-dialog">
	<!-- Modal content-->
	<form class="form-horizontal" method="POST">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Registreer Formulier</h4>
		  </div>
		  <div class="modal-body">
			  <p>Vul a.u.b uw gegevens in om te registeren.</p><br>
			  <div class="form-group">
				<label class="control-label col-sm-3" for="voornaam">Voornaam:</label>
				<div class="col-sm-9">
				  <input type="text" class="form-control" name="voornaam" placeholder="Voornaam" required>
				</div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-sm-3" for="achternaam">Achternaam:</label>
				<div class="col-sm-9">
				  <input type="text" class="form-control" name="achternaam" placeholder="Achternaam" required>
				</div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-sm-3" for="email">Email:</label>
				<div class="col-sm-9">
				  <input type="email" class="form-control" name="email" placeholder="Email" required>
				</div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-sm-3" for="telefoon">Telefoonnummer:</label>
				<div class="col-sm-9">
				  <input type="text" class="form-control" name="telefoon" placeholder="Telefoonnummer" required>
				</div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-sm-3" for="adres">Adres:</label>
				<div class="col-sm-9">
				  <input type="text" class="form-control" name="adres" placeholder="Adres" required>
				</div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-sm-3" for="wachtwoord">Password:</label>
				<div class="col-sm-9"> 
				  <input type="password" class="form-control" name="wachtwoord" placeholder="Wachtwoord" required>
				</div>
			  </div>
		  </div>
		  <div class="modal-footer">
			<div class="col-sm-12" id="modal_buttons">
				<button type="submit" name="submit_register" class="btn btn-primary">Registreer</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		  </div>
		</div>
	</form>
  </div>
</div>