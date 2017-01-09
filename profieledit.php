<!DOCTYPE html>
<?php
require ('core.php');
$core = new Core;

$dbc = $core->dbc();
?>
<html>
    <head>
        <title>Profiel edit pagina</title>
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
                <?php
                include ('includes/topbar.php');
                echo $_SESSION['id'];
                $sql = "SELECT * FROM user WHERE UserID = " . $_SESSION['id'] . "";
                $result = mysqli_query($dbc, $sql);
                while ($Row = mysqli_fetch_assoc($result))
                {
                    echo '<form action="profielsave.php" method="post">
                    <p>
                        Voornaam: 
                    </p>
                    <p>
                        <input type="text" name="FirstName" value="' . $Row['FirstName'] . '">
                    </p>
                    <p>
                        Achternaam: 
                    </p>
                    <p>
                        <input type="text" name="LastName" value="' . $Row['LastName'] . '">
                    </p>
                    <p>
                        Email: 
                    </p>
                    <p>
                        <input type="text" name="email" value="' . $Row['Email'] . '">
                    </p>
                    <p>
                        Telefoonnummer: 
                    </p>
                    <p>
                        <input type="text" name="phonenumber" value="' . $Row['PhoneNumber'] . '">
                    </p>
                    <p>
                        Adres:
                    </p>
                    <p> 
                        <input type="text" name="adres" value="' . $Row['Adres'] . '">
                    </p>
                    <p>
                        Wachtwoord: 
                    </p>
                    <p>
                        <input type="text" name="wachtwoord" value="' . $Row['Password'] . '">
                    </p>
                    <p>
                        <input type="submit" value="Edit">
                    </p>
                    </form>';
                }
                ?>
            </div>
        </div>
    </body>
</html>