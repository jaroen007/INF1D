<!DOCTYPE html>
<html>
	<head>
		<title>Upload Form</title>
		<meta charset="utf-8">
	</head>
	<body>
		<p>Momenteel kun je zelf de naam invullen maar via het het portfolio systeem moet het via de username van de ingelogde persoon, of de ID van de ingelogde persoon</p>
		<form method="post" action="UploadFile.php" enctype="multipart/form-data">
			<p><input type="file" name="fileToUpload" id="fileToUpload" /></p>
			<p><input type="text" name="name" placeholder="naam voor persoonlijke folder" /></p>;
			<p><input type="submit" name="submit" /></p>
		</form>
	</body>
</html>