<?php
$core = new Core;
$dbc = $core->dbc();
if($_SESSION['language'] == 'dutch'){
	//als isset id dan upload file, als get delete isset dan delete upload
	if (isset($_POST['id'])) {
		$core->UploadFile($_FILES["fileToUpload"]); 
	}elseif (isset ($_GET['delete'])) {
		$core->deleteUpload($_GET['delete']);
	}
	
	$sql = 'SELECT * FROM `grade` WHERE UserID=' . $_GET['user'] . " AND Grade ='1'";
	$row = mysqli_query($dbc, $sql);
	$rowarray = mysqli_fetch_assoc($row);
	$count = mysqli_num_rows($row);
	
	//opmaak portfolio nav bar
	echo'<ul class="topbar portfolio">'
	. '<li class="item left"> <a href="?portfolio=' . $_GET['user'] . '">Over mij</a></li>'
	. '<li class="item left"> <a href="?portfolio=' . $_GET['user'] . '&tag=' . "Ervaring" . '">Ervaring</a></li>'
	. '<li class="item left"> <a href="?portfolio=' . $_GET['user'] . '&tag=' . "Opleidingen" . '">Opleidingen</a></li>'
	. '<li class="item left"> <a href="?portfolio=' . $_GET['user'] . '&tag=' . "Interesses" . '">Interesses</a></li>'
	. '<li class="item left"> <a href="?portfolio=' . $_GET['user'] . '&tag=' . "Overige" . '">Overige</a></li>'
	. '<li class="item left"> <a href="?portfolio=' . $_GET['user'] . '&tag=' . "Contact" . '">Contact</a></li>'
	. '<li class="item left divider-vertical"></li>'
	. '<li class="item left"> <a href="?page=fileOverview&user=' . $_GET['user'] . '">Documenten</a></li>'
	. '<li class="item left divider-vertical"></li>'
	. '<li class="item left"> <a href="?page=profiel&user=' . $_GET['user'] . '">Profiel</a></li>';
	if($count == 0){
		echo '<li class="item right port_approve"><i class="fa fa-times fa-2x" data-toggle="tooltip" data-placement="bottom" title="Dit portfolio is nog niet goed gekeurd." aria-hidden="true"></i></li>';
	}else{
		$sql3 = 'SELECT * FROM `user` WHERE UserID=' . $rowarray['GraderID'] . '';
		$row2 = mysqli_query($dbc, $sql3);
		$rowarray2 = mysqli_fetch_assoc($row2);
		echo '<li class="item right port_approve"><i class="fa fa-check fa-2x" data-toggle="tooltip" data-placement="bottom" title="Dit portfolio is goed gekeurd door: '.$rowarray2['FirstName'].' '.$rowarray2['LastName'].'." aria-hidden="true"></i></li>';
	}
	echo '</ul>';
	echo '<div class="clear"></div>';

	echo '<h2>Bestandsoverzicht</h2>';
	//haal uploaded bestadnen op
	$core->getUploadedFiles($_GET['user']);
	
	//als ingelogde persoon is dezelfde persoon op documents pagina dan mag die persoon bestadnen uploaden
	if(isset($_SESSION['id'])){
		if($_SESSION['id'] == $_GET['user']){
			echo '<p>Bestand upload:</p>';
			echo '<form method="post" action="?page=fileOverview&user=' . $_SESSION['id'] . '" enctype="multipart/form-data">';
				echo '<p><input type="hidden" name="id" value="' . $_SESSION['id'] . '" class="btn btn-default"/></p>';
				echo '<p><input type="file" class="btn btn-default btn-file" name="fileToUpload" id="fileToUpload" /></p>';
				echo '<p>Omschrijving van het bestand:</p>';
				echo '<p><textarea class="form-control" name="omschrijving" rows="5" id="comment"></textarea></p>'; 
				echo '<p><input type="submit" name="submit" class="btn btn-sm btn-primary"/></p>';
			echo '</form>';
		}
	}
}else{
	//als isset id dan upload file, als get delete isset dan delete upload
	if (isset($_POST['id'])) {
		$core->UploadFile($_FILES["fileToUpload"]); 
	}elseif (isset ($_GET['delete'])) {
		$core->deleteUpload($_GET['delete']);
	}
	
	$sql = 'SELECT * FROM `grade` WHERE UserID=' . $_GET['user'] . " AND Grade ='1'";
	$row = mysqli_query($dbc, $sql);
	$rowarray = mysqli_fetch_assoc($row);
	$count = mysqli_num_rows($row);
	
	//opmaak portfolio nav bar
	echo'<ul class="topbar portfolio">'
	. '<li class="item left"> <a href="?portfolio=' . $_GET['user'] . '">About me</a></li>'
	. '<li class="item left"> <a href="?portfolio=' . $_GET['user'] . '&tag=' . "Ervaring" . '">Experiences</a></li>'
	. '<li class="item left"> <a href="?portfolio=' . $_GET['user'] . '&tag=' . "Opleidingen" . '">Studies</a></li>'
	. '<li class="item left"> <a href="?portfolio=' . $_GET['user'] . '&tag=' . "Interesses" . '">Interests</a></li>'
	. '<li class="item left"> <a href="?portfolio=' . $_GET['user'] . '&tag=' . "Overige" . '">Other</a></li>'
	. '<li class="item left"> <a href="?portfolio=' . $_GET['user'] . '&tag=' . "Contact" . '">Contact</a></li>'
	. '<li class="item left divider-vertical"></li>'
	. '<li class="item left"> <a href="?page=fileOverview&user=' . $_GET['user'] . '">Documents</a></li>'
	. '<li class="item left divider-vertical"></li>'
	. '<li class="item left"> <a href="?page=profiel&user=' . $_GET['user'] . '">Profile</a></li>';
	if($count == 0){
		echo '<li class="item right port_approve"><i class="fa fa-times fa-2x" data-toggle="tooltip" data-placement="bottom" title="This portfolio has not been approved." aria-hidden="true"></i></li>';
	}else{
		$sql3 = 'SELECT * FROM `user` WHERE UserID=' . $rowarray['GraderID'] . '';
		$row2 = mysqli_query($dbc, $sql3);
		$rowarray2 = mysqli_fetch_assoc($row2);
		echo '<li class="item right port_approve"><i class="fa fa-check fa-2x" data-toggle="tooltip" data-placement="bottom" title="This portfolio has been approved by: '.$rowarray2['FirstName'].' '.$rowarray2['LastName'].'." aria-hidden="true"></i></li>';
	}
	echo '</ul>';
	echo '<div class="clear"></div>';

	echo '<h2>File Overview</h2>';
	//haal uploaded bestadnen op
	$core->getUploadedFiles($_GET['user']);
	
	//als ingelogde persoon is dezelfde persoon op documents pagina dan mag die persoon bestadnen uploaden
	if(isset($_SESSION['id'])){
		if($_SESSION['id'] == $_GET['user']){
			echo '<p>Upload a file:</p>';
			echo '<form method="post" action="?page=fileOverview&user=' . $_SESSION['id'] . '" enctype="multipart/form-data">';
				echo '<p><input type="hidden" name="id" value="' . $_SESSION['id'] . '" class="btn btn-default"/></p>';
				echo '<p><input type="file" class="btn btn-default btn-file" name="fileToUpload" id="fileToUpload" /></p>';
				echo '<p>Describe the file:</p>';
				echo '<p><textarea class="form-control" name="omschrijving" rows="5" id="comment"></textarea></p>'; 
				echo '<p><input type="submit" name="submit" class="btn btn-sm btn-primary"/></p>';
			echo '</form>';
		}
	}
}
?>

