<?php
	if((isset($_POST['submit_login'])) && (empty($_POST['email']) || empty($_POST['wachtwoord']))){
		echo 'Please fill in all the fields.';
	}else{	
		if(isset($_POST['submit_login'])){
			$email = htmlentities($_POST['email']);
			$password = htmlentities($_POST['wachtwoord']);
			
			$sql = "SELECT * FROM user WHERE Email = '".$email."'";
			
			$result = mysqli_query($dbc, $sql);
			$row = mysqli_fetch_assoc($result);
			
			//TODO: bad messages. modal closes instantly. doesnt matter for good login.
			if (mysqli_num_rows($result) == 0){
				echo "Username or password is incorrect.";
			}else{
				if(password_verify($password, $row['Password'])){
					$_SESSION['loggedIn'] = 1;
					$_SESSION['fname'] = $row['FirstName'];
					$_SESSION['lname'] = $row['LastName'];
					$_SESSION['access'] = $row['AccessLevel'];
					$_SESSION['id'] = $row['UserID'];
					header("Location: index.php");	//TODO: make current page session to always stay on the same page when logging in. (bonus)
				}else{
					echo "Username or password is incorrect.";
				}
			}

			mysqli_free_result($result);
			mysqli_close($dbc);							
		}
	}
?>

<div id="login" class="modal fade" role="dialog">
  <div class="modal-dialog">
	<!-- Modal content-->
	<form class="form-horizontal" method="POST">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Login Formulier</h4>
		  </div>
		  <div class="modal-body">
			  <p>Vul a.u.b uw email adres en wachtwoord in om in te loggen.
			  <br>Nog geen account? klik hier.</p><br>
			  <div class="form-group">
				<label class="control-label col-sm-2" for="email">Email:</label>
				<div class="col-sm-10">
				  <input type="email" class="form-control" name="email" placeholder="Email" required>
				</div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-sm-2" for="wachtwoord">Password:</label>
				<div class="col-sm-10"> 
				  <input type="password" class="form-control" name="wachtwoord" placeholder="Wachtwoord" required>
				</div>
			  </div>
		  </div>
		  <div class="modal-footer">
			<div class="col-sm-12" id="modal_buttons">
				<button type="submit" name="submit_login" class="btn btn-primary">Login</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		  </div>
		</div>
	</form>
  </div>
</div>