<!DOCTYPE html>
<?php
session_start();
require ('core.php');
$core = new Core;

$dbc = $core->dbc();
?>
<html>
    <head>
        <title>Profiel pagina</title>
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
        <?php include 'includes/topbar.php'; ?>
        <div class="contentcontainer">
            <div class="content">
                <div class="tabel">
                    <?php
                    $sql = "SELECT * FROM user WHERE UserID = " . $_SESSION['id'] . "";

                    $result = mysqli_query($dbc, $sql);

                    echo "<table>";
                    echo "<th>Firstname</th>"
                    . "<th>Lastname</th>"
                    . "<th>Email</th>"
                    . "<th>Phonenumber</th>"
                    . "<th>Adres</th>"
                    . "<th>Password</th>";

                    while (@$row = mysqli_fetch_assoc($result))
                    {
                        echo "<tr>"
                        . "<td>" . $row['FirstName'] . "</td>"
                        . "<td>" . $row['LastName'] . "</td>"
                        . "<td>" . $row['Email'] . "</td>"
                        . "<td>" . $row['PhoneNumber'] . "</td>"
                        . "<td>" . $row['Adres'] . "</td>"
                        . "<td>" . $row['Password'] . "</td>"
                        . "</tr>";
                    }
                    echo "</table>";
                    echo "<form method='post' action='profieledit.php'>";
                    echo "<input type='submit' value='Edit'>";
                    echo "</form>";
                    ?>
                </div>
            </div>
            <div class="clear"></div>
        </div>

    </body>
</html>