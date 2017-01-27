<?php
$core = new Core();
$dbc = $core->dbc();

if (isset($_POST['Edit']))
{
    $FirstName = stripslashes($_POST['FirstName']);
    $LastName = stripslashes($_POST['LastName']);	
	$remove_ext = explode('@',$_POST['email']);
	$Email = stripslashes($remove_ext[0].'@student.stenden.com');
    $PhoneNumber = stripslashes($_POST['phonenumber']);
    $Adres = stripslashes($_POST['adres']);
    $Wachtwoord = $_POST['wachtwoord'];
	//als er geen nieuwe avatar nodig is
    if (empty($_FILES['Avatar']['name']))
    {
		//als wachtwoord veld leeg is, update wachtwoord niet.
        if (empty($Wachtwoord))
        {
            $sql = "UPDATE user SET "
                    . "FirstName= '" . $FirstName . "', "
                    . "LastName= '" . $LastName . "', "
                    . "Email= '" . $Email . "', "
                    . "PhoneNumber= '" . $PhoneNumber . "', "
                    . "Adres= '" . $Adres . "'
					WHERE userID= ".$_SESSION['id']."";
        } else
		//update wachtwoord ook
        {
            $sql = "UPDATE user SET "
                    . "FirstName= '" . $FirstName . "', "
                    . "LastName= '" . $LastName . "', "
                    . "Email= '" . $Email . "', "
                    . "PhoneNumber= '" . $PhoneNumber . "', "
                    . "Adres= '" . $Adres . "', "
                    . "Password= '" . password_hash($Wachtwoord, PASSWORD_BCRYPT) . "'
					WHERE userID= ".$_SESSION['id']."";
        }
    } else
    {
		//update wachtwoord niet maar voer wel functie uit om avatar te updaten
        if (empty($Wachtwoord))
        {
            $sql = "UPDATE user SET "
                    . "FirstName= '" . $FirstName . "', "
                    . "LastName= '" . $LastName . "', "
                    . "Email= '" . $Email . "', "
                    . "PhoneNumber= '" . $PhoneNumber . "', "
                    . "Adres= '" . $Adres . "'
					WHERE userID= ".$_SESSION['id']."";
            $core->UploadImage($_FILES["Avatar"]);
        } else
        {
		//update wachtwoord wel en voer functie uit om avatar te updaten
            $sql = "UPDATE user SET "
                    . "FirstName= '" . $FirstName . "', "
                    . "LastName= '" . $LastName . "', "
                    . "Email= '" . $Email . "', "
                    . "PhoneNumber= '" . $PhoneNumber . "', "
                    . "Adres= '" . $Adres . "', "
                    . "Password= '" . password_hash($Wachtwoord, PASSWORD_BCRYPT) . "'
					WHERE userID= ".$_SESSION['id']."";
            $core->UploadImage($_FILES["Avatar"]);
        }
    }
    mysqli_query($dbc, $sql) OR DIE("De query werkt niet.");
	//overschrijf sessies met updated informatie
    $_SESSION['fname'] = $FirstName;
    $_SESSION['lname'] = $LastName;
    $_SESSION['telefoon'] = $PhoneNumber;
    $_SESSION['email'] = $Email;
    $_SESSION['adres'] = $Adres;
}
$remove_ext = explode('@',$_SESSION['email']);
if($_SESSION['language'] == 'dutch'){
	//opmaakt formulier
	echo '<h2>Profiel bewerken</h2>';
	echo '<p class="admin">Hier kunt u uw eigen profiel bewerken door middel van uw nieuwe gegevens in te vullen in het formulier hieronder.</p>';
	echo '<form method="post" enctype="multipart/form-data" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '?page=profieledit">
		<div class="form-group col-xs-6">
		  <p>Voornaam</p>
		  <input type="text" name="FirstName" class="form-control" id="Firstname" value="' . $_SESSION['fname'] . '">
		</div>
		<div class="form-group col-xs-6">
		  <p>Achternaam</p>
		  <input type="text" name="LastName" class="form-control" id="Lastname" value="' . $_SESSION['lname'] . '">
		</div>
		<div class="form-group col-xs-6">
		  <p>Telefoonnummer</p>
		  <input type="text" name="phonenumber" class="form-control" id="PhoneNumber" value="' . $_SESSION['telefoon'] . '">
		</div>
		<div class="form-group col-xs-6">
		  <p>Adres</p>
		  <input type="text" name="adres" class="form-control" id="Adres" value="' . $_SESSION['adres'] . '">
		</div>
		<div class="form-group col-xs-6">
			<p>Email</p>
			<div class="input-group">
				<input type="text" class="form-control" name="email" placeholder="Stenden Email" value="' . $remove_ext[0] . '" required>
				<span class="input-group-addon">@student.stenden.com</span>
			</div>
		</div>
		<div class="form-group col-xs-6">
		  <p>Wachtwoord</p>
		  <input type="password" name="wachtwoord" class="form-control" id="Password">
		</div>
		<div class="form-group col-xs-6">
		  <p>Avatar</p>
		  <input type="file" name="Avatar" class="form-control-file" id="avatar">
		</div>
		<div class="clear"></div>
		<button type="submit" name="Edit" class="btn edit-btn">Bewerken</button>
	  </form> <div class="clear"></div>';  
} else {
	//opmaakt profiel enegls
	echo '<h2>Edit profile</h2>';
	echo '<p>On this page you can edit your profile by filling in the form below.</p>';
	echo '<form method="post" enctype="multipart/form-data" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '?page=profieledit">
		<div class="form-group col-xs-6">
		  <p>First name</p>
		  <input type="text" name="FirstName" class="form-control" id="Firstname" value="' . $_SESSION['fname'] . '">
		</div>
		<div class="form-group col-xs-6">
		  <p>Surname</p>
		  <input type="text" name="LastName" class="form-control" id="Lastname" value="' . $_SESSION['lname'] . '">
		</div>
		<div class="form-group col-xs-6">
		  <p>Phone number</p>
		  <input type="text" name="phonenumber" class="form-control" id="PhoneNumber" value="' . $_SESSION['telefoon'] . '">
		</div>
		<div class="form-group col-xs-6">
		  <p>Address</p>
		  <input type="text" name="adres" class="form-control" id="Adres" value="' . $_SESSION['adres'] . '">
		</div>
		<div class="form-group col-xs-6">
			<p>Email</p>
			<div class="input-group">
				<input type="text" class="form-control" name="email" placeholder="Stenden Email" value="' . $remove_ext[0] . '" required>
				<span class="input-group-addon">@student.stenden.com</span>
			</div>
		</div>
		<div class="form-group col-xs-6">
		  <p>Password</p>
		  <input type="password" name="wachtwoord" class="form-control" id="Password">
		</div>
		<div class="form-group col-xs-6">
		  <p>Avatar</p>
		  <input type="file" name="Avatar" class="form-control-file" id="exampleInputFile">
		</div>
		<div class="clear"></div>
		<button type="submit" name="Edit" class="btn edit-btn">Edit</button>
	  </form> <div class="clear"></div>';
}
?>