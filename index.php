<!DOCTYPE html>
<?php
	//start sessie voor de hele site voor elke pagina.
	session_start();
	//geen session hijacking door sessie id te veranderen elke pagina load.
	session_regenerate_id();
	
	//include bestand die de pagina vertaling regelt.
	include 'includes/language.php';
	
	//require de core van het systeem. exit als het niet kan laten (aka require)
	require ('core.php');
	//start nieuwe instance van core
	$core = new Core;	

	//connect to database
	$dbc = $core->dbc();
	
	//als get pagina set is en het is logout dan laad logout pagina. (spoiler: het logt je uit)
	if (isset($_GET['page'])) {
		if($_GET['page'] == 'logout'){
			$core->page($_GET['page']);
		}
	}

	//als post edit is dan redirect naar andere pagina.
	if (isset($_POST['Edit'])){
		header('Location: index.php?page=profiel&user='.$_SESSION['id'].'');
	}
	
	//als post 1 van de onderstaande is dan voer core functie makePortfolio uit.
	if (isset($_POST['overMij'])) {
		$core->makePortfolio($_SESSION['id'], $_POST['overMij'], 'Over Mij');
	}
	if(isset($_POST['experience'])){
		$core->makePortfolio($_SESSION['id'], $_POST['experience'], 'Ervaring');
	}
	if(isset($_POST['education'])){
		$core->makePortfolio($_SESSION['id'], $_POST['education'], 'Opleidingen');
	}if(isset($_POST['interesses'])){
		$core->makePortfolio($_SESSION['id'], $_POST['interesses'], 'Interesses');
	}
	if(isset($_POST['overige'])){
		$core->makePortfolio($_SESSION['id'], $_POST['overige'], 'Overige');
	}
	if(isset($_POST['contact'])){
		$core->makePortfolio($_SESSION['id'], $_POST['contact'], 'Contact');
	}
	
	//zelfde als hierboven maar dan met redirect.
	if (isset ($_POST['portfolioContent']) && isset ($_GET['tag']) && isset ($_GET['updatePortfolio'])) {
		$core->editPortfolio($_SESSION['id'], $_POST['portfolioContent'], $_GET['tag']);
        header('Location: index.php?portfolio=' . $_SESSION['id'] . '&tag=' . $_GET['tag']);
	}
	
	//als get geset is voer delete query uit.
	if(isset($_GET['msgid'])){
		$dbc = $core->dbc();
		$DeleteSQL = "DELETE FROM message WHERE MessageID = " . $_GET['msgid'] . "";
		$SQLResult = mysqli_query($dbc, $DeleteSQL);
	}
	
	//msg geset = redirect
	if(isset($_GET['msg'])){
		header("Location: ".htmlentities($_SERVER['PHP_SELF'])."?page=profiel&user=".$_GET['user']."");
	}
	
	//updaterino geset = redirect
	if(isset($_GET['updaterino'])){
		header("Location: ".htmlentities($_SERVER['PHP_SELF'])."?page=adminpanel&submenu=user");
	}
?>
<html>
	<head>
		<?php
		//title engels of nl
		if($_SESSION['language'] == 'dutch'){
			echo '<title>Digitaal Portfolio Systeem</title>';
		}else{
			echo '<title>Digital Portfolio System</title>';
		}
		?>
		<meta http-equiv="content-type" content="text/html;charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="https://use.fontawesome.com/76b1763dbb.js"></script>
		
		<link href="style/style.css" rel="stylesheet" type="text/css">
		
	</head>
	<body >
		<?php include 'includes/topbar.php'; ?>
		<div class="contentcontainer">
			<div class="content">
			<!-- laad login en registratie modal in -->
			<?php include 'includes/login.php'; ?>
			<?php include 'includes/register.php'; ?>
			<?php
			
			//pagina systeem. laad bestand in in page folder gebaseerd op get link.
			if (isset($_GET['page'])) {
				$core->page($_GET['page']);
			} elseif (isset($_GET['portfolio'])) {
				if(isset($_GET['tag'])){
					$core->getPortfolioContent($_GET['portfolio'], $_GET['tag']);
				}else{
					$core->getPortfolioContent($_GET['portfolio']);
				}
			}
			elseif (isset($_GET['editPortfolio'])) {
					if(isset($_GET['editPortfolio'])&&isset($_GET['tag'])){
						$core->getPortfolio($_GET['editPortfolio'], $_GET['tag']);
					}else{
					   $core->getPortfolio($_GET['editPortfolio'], 'Over mij'); 
					}
			} 
			else {
				include 'page/home.php';
			}
			?>
			</div>
		</div>
		<script src="includes/tinyMCE/tinymce.min.js"></script>
	</body>
	
</html>





