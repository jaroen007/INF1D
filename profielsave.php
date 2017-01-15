<!DOCTYPE html>
<?php
require ('core.php');
$core = new Core;

$dbc = $core->dbc();
?>
<html>
    <head>
        <title>Profiel save pagina</title>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://use.fontawesome.com/76b1763dbb.js"></script>

        <link href="style/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="contentcontainer">
            <div class="content">
                <div class="tabel">
                    <?php
                    include ('includes/topbar.php');

                    
                        $FirstName = stripslashes($_POST['FirstName']);
                        $LastName = stripslashes($_POST['LastName']);
                        $Email = stripslashes($_POST['email']);
                        $PhoneNumber = stripslashes($_POST['phonenumber']);
                        $Adres = stripslashes($_POST['adres']);
                        $Wachtwoord = stripslashes($_POST['wachtwoord']);


                        $sql = "UPDATE user SET "
                                . "FirstName= '" . $FirstName . "', "
                                . "LastName= '" . $LastName . "', "
                                . "Email= '" . $Email . "', "
                                . "PhoneNumber= '" . $PhoneNumber . "', "
                                . "Adres= '" . $Adres . "', "
                                . "Password= '" . $Wachtwoord . "' "
                                . "WHERE UserID = " . $_SESSION['id'] . "";
                        mysqli_query($dbc, $sql) OR DIE("De query werkt niet.");
                        echo "Het profiel is succesvol geüpdatet.";
                        echo "<a href='profiel.php'>Terug naar profiel</a>";
                    
                    ?>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </body>
</html>