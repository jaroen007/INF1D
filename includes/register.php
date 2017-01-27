<?php
	//als form submit is maar leeg, error
	if((isset($_POST['submit_register'])) && (empty($_POST['voornaam']) || empty($_POST['achternaam']) || empty($_POST['email']) || empty($_POST['telefoon']) || empty($_POST['adres']) || empty($_POST['wachtwoord']))){
		if($_SESSION['language'] == 'dutch'){
			echo '<div class="alert alert-danger alert-dismissable ">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  Vul a.u.b alle velden in.
			</div>';
		}else{
			echo '<div class="alert alert-danger alert-dismissable ">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  Please fill in all the fields.
			</div>';		
		}
	}else{
		//als het set is en niet leeg
		if(isset($_POST['submit_register'])){	
			$fname = htmlentities($_POST['voornaam']);
			$lname = htmlentities($_POST['achternaam']);
			
			$remove_ext = explode('@',$_POST['email']);

			$email = htmlentities($remove_ext[0].'@student.stenden.com');
			$phone = htmlentities($_POST['telefoon']);
			$adres = htmlentities($_POST['adres']);
			//BCRYPT het ingevulde wachtwoord. vul gegevens in db.
			$pass = password_hash(htmlentities($_POST['wachtwoord']), PASSWORD_BCRYPT);

			$sql = "INSERT INTO user (UserID, FirstName, LastName, Email, PhoneNumber, Adres, Password, AccessLevel, Avatar)
					VALUES ('', '".$fname."', '".$lname."', '".$email."', '".$phone."', '".$adres."', '".$pass."', '1', 'images/avatars/default.png')";

			if (!mysqli_query($dbc, $sql)) {
				if($_SESSION['language'] == 'dutch'){
					echo '<div class="alert alert-danger alert-dismissable ">
					  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					  Er is iets mis gegaan tijdens het registreren. Probeer het a.u.b opnieuw.
					</div>';
				}else{
					echo '<div class="alert alert-danger alert-dismissable ">
					  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					  Something went wrong while trying to register. Please try again.
					</div>';
				
				}
			}else{
				if($_SESSION['language'] == 'dutch'){
					echo '<div class="alert alert-success alert-dismissable ">
					  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					  Uw account is aangemaakt. U kunt nu inloggen.
					</div>';	
				}else{
					echo '<div class="alert alert-success alert-dismissable ">
					  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					  Your account has been made. You can now login.
					</div>';	
				
				}
			}
			
			mysqli_close($dbc);
		}
	}
?>
<?php 
if($_SESSION['language'] == 'dutch'){			
	echo '<div id="register" class="modal fade" role="dialog">
	  <div class="modal-dialog">
		<form class="form-horizontal" method="POST">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Registreer Formulier</h4>
			  </div>
			  <div class="modal-body">
				  <p>Vul a.u.b uw gegevens in om te registeren.</p><br>
				  <div class="form-group">
					<p class="control-label col-sm-3">Voornaam:</p>
					<div class="col-sm-9">
					  <input type="text" class="form-control" name="voornaam" placeholder="Voornaam" required>
					</div>
				  </div>
				  <div class="form-group">
					<p class="control-label col-sm-3">Achternaam:</p>
					<div class="col-sm-9">
					  <input type="text" class="form-control" name="achternaam" placeholder="Achternaam" required>
					</div>
				  </div>
				  <div class="form-group">
					<p class="control-label col-sm-3">Email:</p>
					<div class="col-sm-9">
						<div class="input-group">
							<input type="text" class="form-control" name="email" placeholder="Stenden Email" required>
							<span class="input-group-addon">@student.stenden.com</span>
						</div>
					</div>
				  </div>
				  <div class="form-group">
					<p class="control-label col-sm-3">Telefoonnummer:</p>
					<div class="col-sm-9">
					  <input type="number" class="form-control" name="telefoon" placeholder="Telefoonnummer" required>
					</div>
				  </div>
				  <div class="form-group">
					<p class="control-label col-sm-3">Adres:</p>
					<div class="col-sm-9">
					  <input type="text" class="form-control" name="adres" placeholder="Adres" required>
					</div>
				  </div>
				  <div class="form-group">
					<p class="control-label col-sm-3">Wachtwoord:</p>
					<div class="col-sm-9"> 
					  <input type="password" class="form-control" name="wachtwoord" placeholder="Wachtwoord" required>
					</div>
				  </div>
			  </div>
			  <div class="modal-footer">
				<div class="col-sm-12">
					<button type="submit" name="submit_register" class="btn btn-primary">Registreer</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			  </div>
			</div>
		</form>
	  </div>
	</div>';
}else{
	echo '<div id="register" class="modal fade" role="dialog">
	  <div class="modal-dialog">
		<form class="form-horizontal" method="POST">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Register Form</h4>
			  </div>
			  <div class="modal-body">
				  <p>Please fill in the form below to register.</p><br>
				  <div class="form-group">
					<p class="control-label col-sm-3">First name:</p>
					<div class="col-sm-9">
					  <input type="text" class="form-control" name="voornaam" placeholder="First Name" required>
					</div>
				  </div>
				  <div class="form-group">
					<p class="control-label col-sm-3">Last name:</p>
					<div class="col-sm-9">
					  <input type="text" class="form-control" name="achternaam" placeholder="Last Name" required>
					</div>
				  </div>
				  <div class="form-group">
					<p class="control-label col-sm-3">Email:</p>
					<div class="col-sm-9">
						<div class="input-group">
							<input type="text" class="form-control" name="email" placeholder="Stenden Email" required>
							<span class="input-group-addon">@student.stenden.com</span>
						</div>
					</div>
				  </div>
				  <div class="form-group">
					<p class="control-label col-sm-3">Phone number:</p>
					<div class="col-sm-9">
					  <input type="number" class="form-control" name="telefoon" placeholder="Phone Number" required>
					</div>
				  </div>
				  <div class="form-group">
					<p class="control-label col-sm-3">Adres:</p>
					<div class="col-sm-9">
					  <input type="text" class="form-control" name="adres" placeholder="Adres" required>
					</div>
				  </div>
				  <div class="form-group">
					<p class="control-label col-sm-3">Password:</p>
					<div class="col-sm-9"> 
					  <input type="password" class="form-control" name="wachtwoord" placeholder="Password" required>
					</div>
				  </div>
			  </div>
			  <div class="modal-footer">
				<div class="col-sm-12">
					<button type="submit" name="submit_register" class="btn btn-primary">Register</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			  </div>
			</div>
		</form>
	  </div>
	</div>';
}
