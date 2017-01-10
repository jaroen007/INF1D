<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Gastenboek</title>
	</head>
	<body>
		<form method="POST" action="">
			<input type="text" name="NameGuestbook">
			<input type="text" name="EmailGuestbook">
			<input type="text" name="MessageGuestbook">
			<input type="submit" name="submit">
		</form>
		<?php
		if (isset($_POST['submit']))
		{
			$Name = stripcslashes($_POST['NameGuestbook']);
			$Name = mysqli_real_escape_string($Name);
			$Email = stripcslashes($_POST['EmailGuestbook']);
			$Email = mysqli_real_escape_string($Email);
			$Message = stripcslashes($_POST['MessageGuestbook']);
			$Message = mysqli_real_escape_string($Message);
			
			if (empty($Name) || empty($Email) || empty($Message)) 	// Check if the fields are empty
			{
				die("Please fill in all the forms!");
			}  	
			
			$Connection = mysqli_connect("127.0.0.1", "root", "");
			if (!$Connection)										// Check if the connection is established
			{
				die("Can't connect to the database!");
			} 
			
			$DBName = "project";
			if (!mysqli_select_db("$Connection" , "$DBName")
			
				
			
		}
		?>
	</body>
</html>
