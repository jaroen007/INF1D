<?php
session_start();
session_regenerate_id();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Gastenboek</title>
    </head>
    <body>
        <form method="POST" action="">
            <p>Naam: <input type="text" name="NameGuestbook" placeholder="Enter your name"></p>
            <p>Email: <input type="email" name="EmailGuestbook" placeholder="Enter your email"></p>
            <p>Message: <input type="text" name="MessageGuestbook" placeholder="Enter your message"></p>
            <input type="submit" name="submit">
        </form>
        <br>
        <?php
        if (isset($_POST['submit']))
        {
            $Connection = mysqli_connect("127.0.0.1", "root", "");
            if (!$Connection)                                       // Check if the connection is established
            {
                die("Can't connect to the database!");
            }

            $Name = htmlentities($_POST['NameGuestbook']);
            $Name = mysqli_real_escape_string($Connection, $Name);
            $Email = htmlentities($_POST['EmailGuestbook']);
            $Email = mysqli_real_escape_string($Connection, $Email);
            $Message = htmlentities($_POST['MessageGuestbook']);
            $Message = mysqli_real_escape_string($Connection, $Message);

            if (empty($Name) || empty($Email) || empty($Message))  // Check if the fields are empty
            {
                die("Please fill in all the forms!");
            }

            if (!preg_match("/^[a-zA-Z ]*$/", $Name))
            {
                die("Only letters and white space allowed");
            }
            
            if (!filter_var($Email, FILTER_VALIDATE_EMAIL))
            {
                die("Invalid email format");
            }

            $DBName = "lol";
            if (!mysqli_select_db($Connection, $DBName))            // Check if the database can be selected
            {
                die("Can't select to the database!");
            }
            mysqli_select_db($Connection, $DBName);

            $TableName = "message";
            $SQLQuery = "SHOW TABLES LIKE '$TableName'";
            $SQLResult = mysqli_query($Connection, $SQLQuery);
            if (mysqli_num_rows($SQLResult) == 0)                   // Check if the table `message` exists
            {
                die("Can't find the table");
            }

            $_SESSION['name'] = '1';
            $NameUser = $_SESSION['name'];
            $TargetID = "1";
            $Time = date("H:i:s");
            $Date = date("Y-m-d");
            $SQLQuery2 = "INSERT INTO $TableName (`MessageID`,
                    `SourceUserID`,
                    `TargetUserID`, 
                    `Time`, 
                    `Date`, 
                    `name`, 
                    `email`, 
                    `Message`) VALUES (NULL, 
                            '$NameUser',
                            '$TargetID',
                            '$Time',
                            '$Date',
                            '$Name', 
                            '$Email',
                            '$Message')";
            $SQLResult2 = mysqli_query($Connection, $SQLQuery2);
            if (!$SQLResult2)
            {
                die("Failed executing the query!");
            } else
            {
                echo "Thanks for your input!";
            }
        }
        ?>

        <!-- 
CREATE TABLE `message` ( `MessageID` int(10) NOT NULL AUTO_INCREMENT, `SourceUserID` int(10) NOT NULL, `TargetUserID` int(10) NOT NULL, `Time` time NOT NULL, `Date` date, `name` varchar(255) NOT NULL, `email` varchar(255) NOT NULL, `Message` varchar(255) NOT NULL, PRIMARY KEY (`MessageID`) )        -->
    </body>
</html>
