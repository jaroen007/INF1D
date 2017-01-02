<!DOCTYPE html>
<?php
	session_start();
	
	require ('core.php');
	$core = new Core;
	
	//$dbc = $core->dbc();
?>
<html>
	<head>
		<title>Login pagina</title>
		<meta http-equiv="content-type" content="text/html;charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="style/style.css" rel="stylesheet" type="text/css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="https://use.fontawesome.com/76b1763dbb.js"></script>
	</head>
	<body>
		<?php include 'includes/topbar.php'; ?>
		
		<div class="contentcontainer">
			<div class="content">
				<form class="login_container" action="" method="POST">
				  <h3>Login formulier</h3>
					<p><label><b>Email</b></label><br>
					<input type="text" placeholder="Email" name="email" required></p>

					<p><label><b>Wachtwoord</b></label><br>
					<input type="password" placeholder="Wachtwoord" name="wachtwoord" required></p>

					<button type="submit" name="submit">Login</button>
				</form>

				<form class="register_container" action="" method="POST">
				  <h3>Registeer formulier</h3>
					<p><label><b>Email</b></label><br>
					<input type="text" placeholder="Email" name="email" required></p>

					<p><label><b>Wachtwoord</b></label><br>
					<input type="password" placeholder="Wachtwoord" name="wachtwoord" required></p>

					<button class="test" type="submit" name="submit">Login</button>
				</form>
			</div>
		</div>
	</body>
	
</html>








