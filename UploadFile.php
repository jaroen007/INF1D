<?php

// Name
	$name = $_POST["name"];
	
// Folder voor uploads
	$dir = "uploads/".$name."/";

// Gegevens bestand
	$targetFile = $dir . basename($_FILES["fileToUpload"]["name"]);
	$fileType = $_FILES["fileToUpload"]["type"];
	$fileSize = $_FILES["fileToUpload"]["size"];
	$tmpName = $_FILES["fileToUpload"]["tmp_name"];
	$fileExt = strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));

	$uploadOk = 1;

	echo $targetFile . "<br>";
	echo $fileType . "<br>";
	echo $tmpName . "<br>";
	echo $fileExt . "<br>";

// Bestanden die toegestaan zijn
	$AllowedExt = array("jpg","jpeg","png","doc","docx","xlsx","xls","txt","pdf");

	$AllowedTypes = array("application/msword",
						  "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
						  "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
						  "application/vnd.ms-excel",
						  "application/pdf",
						  "image/jpeg",
						  "image/png"
						 );

// check if user folder exists
	if(!file_exists($dir)){
		mkdir($dir, 0600);
		echo "User directory has been created.<br>";
	}

// Check if file already exists
	if (file_exists($targetFile)) {
		echo "Sorry, file already exists.<br>";
		$uploadOk = 0;
	}

// Check file size 5Mb
	if($fileSize > 5242880){
		echo "Sorry, your file is too large.<br>";
		$uploadOk = 0;
	}

// Allow certain file formats
	if(!in_array($fileType,$AllowedTypes) || !in_array($fileExt,$AllowedExt)){
		echo "Sorry, only Docx, Doc, xlsx, xls, JPG, JPEG, PNG & GIF files are allowed.<br>";
		$uploadOk = 0;
	}

// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.<br>";
	// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($tmpName, $targetFile)) {
			echo "The file ". basename($_FILES["fileToUpload"]["name"]). " has been uploaded.<br>";
		} else {
			echo "Sorry, there was an error uploading your file.<br>";
		}
	}
?>