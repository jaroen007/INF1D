<?php
	//als form submit is maar leeg, error
	if((isset($_POST['submit_login'])) && (empty($_POST['email']) || empty($_POST['wachtwoord']))){
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
		if(isset($_POST['submit_login'])){
			//probeer user data op te hale uit db met ingevulde info. als het gelukt is log in anders foute info. gebruikt BCRYPT voor hashing pass.
			$remove_ext = explode('@',$_POST['email']);
			$email = htmlentities($remove_ext[0].'@student.stenden.com');
			$password = htmlentities($_POST['wachtwoord']);
			
			$sql = "SELECT * FROM user WHERE Email = '".$email."'";
			
			$result = mysqli_query($dbc, $sql);
			$row = mysqli_fetch_assoc($result);
			
			//TODO: bad messages. modal closes instantly. doesnt matter for good login.
			if (mysqli_num_rows($result) == 0){
				if($_SESSION['language'] == 'dutch'){
					echo '<div class="alert alert-danger alert-dismissable ">
					  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					  Email adres of wachtwoord is incorrect.
					</div>';
				}else{
					echo '<div class="alert alert-danger alert-dismissable ">
					  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					  Email adres or password is incorrect.
					</div>';				
				}
			}else{
				if(password_verify($password, $row['Password'])){
					$_SESSION['loggedIn'] = 'yes';
					$_SESSION['fname'] = $row['FirstName'];
					$_SESSION['lname'] = $row['LastName'];
					$_SESSION['access'] = $row['AccessLevel'];
					$_SESSION['id'] = $row['UserID'];
					$_SESSION['Avatar'] = $row['Avatar'];
					$_SESSION['email'] = $row['Email'];
					$_SESSION['adres'] = $row['Adres'];
					$_SESSION['telefoon'] = $row['PhoneNumber'];
					header("Location: index.php");
				}else{
					if($_SESSION['language'] == 'dutch'){
						echo '<div class="alert alert-danger alert-dismissable ">
						  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						  Email adres of wachtwoord is incorrect.
						</div>';
					}else{
						echo '<div class="alert alert-danger alert-dismissable ">
						  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						  Email adres or password is incorrect.
						</div>';					
					}
				}
			}

			mysqli_free_result($result);
			mysqli_close($dbc);							
		}
	}

if($_SESSION['language'] == 'dutch'){
	echo'<div id="login" class="modal fade" role="dialog">
	  <div class="modal-dialog">
		<form class="form-horizontal" method="POST">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Login Formulier</h4>
			  </div>
			  <div class="modal-body">
				  <p>Vul a.u.b uw email adres en wachtwoord in om in te loggen.
				  <br>Nog geen account? klik <a href="index.php?page=#register" data-dismiss="modal" data-toggle="modal">hier</a>.</p><br>
				  <div class="form-group">
					<p class="control-label col-sm-2">Email:</p>
					<div class="col-sm-10">
						<div class="input-group">
							<input type="text" class="form-control" name="email" placeholder="Stenden Email" required>
							<span class="input-group-addon">@student.stenden.com</span>
						</div>
					</div>
				  </div>
				  <div class="form-group">
					<p class="control-label col-sm-2" >Wachtwoord:</p>
					<div class="col-sm-10"> 
					  <input type="password" class="form-control" name="wachtwoord" placeholder="Wachtwoord" required>
					</div>
				  </div>
			  </div>
			  <div class="modal-footer">
				<div class="col-sm-12" >
					<button type="submit" name="submit_login" class="btn btn-primary">Login</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			  </div>
			</div>
		</form>
	  </div>
	</div>';
}else{
	echo'<div id="login" class="modal fade" role="dialog">
	  <div class="modal-dialog">
		<form class="form-horizontal" method="POST">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Login Form</h4>
			  </div>
			  <div class="modal-body">
				  <p>Please fill in your email adres and password to login.
				  <br>Didn\'t sign up yet? Click <a href="index.php?page=#register" data-dismiss="modal" data-toggle="modal">here</a>.</p><br>
				  <div class="form-group">
					<p class="control-label col-sm-2">Email:</p>
					<div class="col-sm-10">
						<div class="input-group">
							<input type="text" class="form-control" name="email" placeholder="Stenden Email" required>
							<span class="input-group-addon">@student.stenden.com</span>
						</div>
					</div>
				  </div>
				  <div class="form-group">
					<p class="control-label col-sm-2" >Password:</p>
					<div class="col-sm-10"> 
					  <input type="password" class="form-control" name="wachtwoord" placeholder="Password" required>
					</div>
				  </div>
			  </div>
			  <div class="modal-footer">
				<div class="col-sm-12" >
					<button type="submit" name="submit_login" class="btn btn-primary">Login</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			  </div>
			</div>
		</form>
	  </div>
	</div>';
}