<!DOCTYPE html>
<?php
	session_start();
	session_regenerate_id();
	
	require ('core.php');
	$core = new Core;	

	$dbc = $core->dbc();
	
	if (isset($_GET['page'])) {
		if($_GET['page'] == 'logout'){
			$core->page($_GET['page']);
		}
	}
	
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
	
	if (isset ($_POST['portfolioContent']) && isset ($_GET['tag']) && isset ($_GET['updatePortfolio'])) {
		$core->editPortfolio($_SESSION['id'], $_POST['portfolioContent'], $_GET['tag']);
                header('Location: index.php?portfolio=' . $_SESSION['id'] . '&tag=' . $_GET['tag']);
	}
	
	if (isset($_GET['language'])) {
		$language = $_GET['language'];
		$_SESSION['language'] = $language;
	}
?>
<html>
	<head>
		<title>Home pagina</title>
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
		<?php include 'includes/language.php'; ?>
		<?php include 'includes/topbar.php'; ?>
		<div class="contentcontainer">
			<div class="content">
			<?php include 'includes/login.php'; ?>
			<?php include 'includes/register.php'; ?>
			<?php
			if (isset($_GET['page'])) {
				$core->page($_GET['page']);
			} elseif (isset($_GET['portfolio'])) {
				if(isset($_GET['tag'])){
					$core->getPortfolioContent($_GET['portfolio'], $_GET['tag']);
				}else{
				$core->getPortfolioContent($_GET['portfolio'], 'Over mij');
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





