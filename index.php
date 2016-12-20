<!DOCTYPE html>
<?php
	session_start();
	
	require ('core.php');
	$core = new Core;
	
	$dbc = $core->dbc();
?>
<html>
	<head>
		<title>Home pagina</title>
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
				Homepage stuff
			</div>
                    <?php
                        if ($core->language() == "dutch") {
                            echo "Als decaan zet je je in om leerlingen zo goed mogelijk te helpen bij het kiezen van een opleiding.
                            Wij helpen je graag aan informatie over opleidingen, studiekeuzetesten en open dagen.
                            Zodat jij jouw leerlingen goed kunt informeren en begeleiden.";
                        } else {
                            echo "
                            As Dean puts you in order to help students as much as possible when choosing a program.
                            We can help you with information on training, study test and open days.
                            So you can inform your students well and guide.";
                        }
                        ?>
		</div>
	</body>
	
</html>





