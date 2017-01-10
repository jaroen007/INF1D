<!DOCTYPE html>
<?php
	session_start();
	session_regenerate_id();
	
	require ('../core.php');
	$core = new Core;
	
	if (isset($_POST['portfolioTags']) && isset($_POST['portfolioContent'])) {
		$core->makePortfolio(1, $_POST['portfolioContent'], $_POST['portfolioTags']);
	}elseif (isset ($_POST['portfolioContentUpdate'])) {
		$core->updatePortfolio(1, $_POST['portfolioContent']);
	}
	
	$dbc = $core->dbc();
	
	function variable() {
		if (isset($_GET['language'])) {
			$language = $_GET['language'];
			$_SESSION['language'] = $language;
		}
	}

	if (isset($_GET['page'])) {
		if($_GET['page'] == 'logout'){
			$core->page($_GET['page']);
		}
	}
variable();
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
		
		<link href="../style/style.css" rel="stylesheet" type="text/css">
		
	</head>
	<body >
		<?php include '../includes/topbar.php'; ?>
		<?php ?>
		<?php
                                if (isset($_GET['page'])) {
                                    $core->page($_GET['page']);
                                } elseif (isset($_GET['portfolio'])) {
                                    $core->getPortfolioContent($_GET['portfolio']);
                                }
                                elseif (isset($_GET['editPortfolio'])) {
                                    $core->getPortfolio($_GET['editPortfolio']);
                                } 
                                else {
                                    include '../page/home.php';
                                }
                                ?>
			<div class="clear"></div>
		</div>
<script src="includes/tinyMCE/tinymce.min.js"></script>
	</body>
	
</html>





