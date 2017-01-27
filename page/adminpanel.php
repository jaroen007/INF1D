<?php 
$core = new Core;
$dbc = $core->dbc();
if ($_SESSION['language'] == "dutch") { ?>
<ul class="topbar portfolio">
	<li class="item left"><a href="<?php echo htmlentities($_SERVER["PHP_SELF"] . "?page=adminpanel&submenu=portfolio"); ?>">Portfolio's</a></li>
	<li class="item left"><a href="<?php echo htmlentities($_SERVER["PHP_SELF"] . "?page=adminpanel&submenu=user"); ?>">Gebruikers</a></li>
</ul>
<div class="clear"></div>
<?php }else{ ?>
<ul class="topbar portfolio">
	<li class="item left"><a href="<?php echo htmlentities($_SERVER["PHP_SELF"] . "?page=adminpanel&submenu=portfolio"); ?>">Portfolio's</a></li>
	<li class="item left"><a href="<?php echo htmlentities($_SERVER["PHP_SELF"] . "?page=adminpanel&submenu=user"); ?>">Users</a></li>
</ul>
<div class="clear"></div>
<?php } ?>
<?php
if (isset($_GET['submenu'])) {
	
    if ($_GET['submenu'] == 'portfolio') { //portfolio admin gedeelte
        if ($_SESSION['language'] == "dutch") { //nl versie
            $message_status = '';
            if (isset($_SESSION['access'])) {
                if ($_SESSION['access'] == "Admin" || $_SESSION['access'] == "SLB") {
					//haalt alle informatie op en maakt de tabel op voor admins en slbers.
                    $SQLstring = "SELECT DISTINCT content.UserID, `FirstName`, `LastName`, `Date`, `ContentID`, `Tags` FROM user, content WHERE user.UserID = content.UserID GROUP BY content.UserID";
                    $QueryResult = mysqli_query($dbc, $SQLstring);
                    if (mysqli_num_rows($QueryResult) > 0) {
                        echo "<h2>Portfolio's waarmerken</h2>";
                        echo "<p class='admin'>In de tabel hieronder ziet u alle portfolio's die aangemaakt in het systeem. Hier kunt u een portfolio een waarmerk geven of een waarmerk van een portfolio afnemen. Ook kunt u vanaf hier gemakkelijk naar de portfolio's toe door op de link te klikken.</p>";
						
						echo "<table class='table table-responsive table-condensed'>
								<thead>
								 <tr>
								   <th>Naam</th>
								   <th>Datum</th>
								   <th>Keuren</th>
								   <th>Status</th>
								   <th>Bekijk portfolio</th>
								 </tr>
								</thead>";
                        while ($Row = mysqli_fetch_assoc($QueryResult)) {
                            echo "<tr><td>" . $Row['FirstName'] . " ". $Row['LastName'] . "</td>";
                            echo "<td>" . $Row['Date'] . "</td>";
                            if (isset($_POST['submit_goed'])) {	
								$time = date('Y-m-d');
								if ($_POST['id'] == $Row['ContentID'])
								{
									//een portfolio goedkeuren.
									$SQL2 = "SELECT * FROM grade WHERE UserID = ".$Row['UserID']."";
									$Query2 = mysqli_query($dbc, $SQL2);
									if (mysqli_num_rows($Query2) == '0')
									{
										$sql = "INSERT INTO `grade`(`GradeID`, `UserID`, `GraderID`, `Date`, `Grade`) VALUES (NULL, " . $Row['UserID'] . ", " . $_SESSION['id'] . ", '$time', '1')";
									} else {
										$sql = "UPDATE grade SET Grade = '1' WHERE UserID = ".$_POST['user']."";
									}
									$Grade = mysqli_fetch_assoc($Query2);
									$result = mysqli_query($dbc, $sql);
								}				
								$message_status = 'good';
							}elseif(isset($_POST['submit_fout'])) {
								//portfolio afkeuren
								$sql2 = "UPDATE grade SET Grade = '0' WHERE UserID = ".$_POST['user']."";
								$result = mysqli_query($dbc, $sql2);
								$message_status = 'bad';
                            }
							$SQL2 = "SELECT * FROM grade WHERE UserID = ".$Row['UserID']."";
							$Query2 = mysqli_query($dbc, $SQL2);
							$Grade = mysqli_fetch_assoc($Query2);
                            echo "<td><form method='POST' action='#'><input type='hidden' name='id' value='" . $Row['ContentID'] . "'><input type='hidden' name='user' value='" . $Row['UserID'] . "'>
							";
							//DOM bepalen welke portfolios goedgekeurd en afgekeurd zijn.
							if($Grade['Grade'] == 0){
								echo"<input class='btn btn-success btn-sm' type='submit' name='submit_goed' value='Goedkeuren'>&nbsp;";
								echo"<input class='btn btn-warning btn-sm' type='submit' name='submit_fout' value='Afkeuren' disabled>";
							}else{
								echo"<input class='btn btn-success btn-sm' type='submit' name='submit_goed' value='Goedkeuren' disabled>&nbsp;";
								echo"<input class='btn btn-warning btn-sm' type='submit' name='submit_fout' value='Afkeuren'>";
							}
							echo"</form></td>";
                            if ($Grade['Grade'] == 1) {
                                $waarmerkTekst = '<p class="text-success">Deze portfolio is voorzien van een waarmerk.</p>';
                            } else {
                                $waarmerkTekst = '<p class="text-danger">Deze portfolio is nog niet voorzien van een waarmerk.</p>';
                            }
                            echo "<td>" . $waarmerkTekst . "</td>";
                            echo "<td><a class='btn btn-primary' href='index.php?portfolio=" . $Row['UserID'] . "' role=button><i class='fa fa-arrow-right' aria-hidden='true'></i></a></td><tr>";
                        }
						
						//meldingen
						if($message_status == 'good'){
							echo '<div class="alert alert-success alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Het portfolio is nu voorzien van een waarmerk.</div>';
						}elseif($message_status == 'bad'){
							echo '<div class="alert alert-success alert-dismissable "><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Het waarmerk is van het portfolio verwijderd.</div>';
						}
						
						echo "</table>";
                    } else {
                        echo '<div class="alert alert alert-danger "><a href="#" data-dismiss="alert" aria-label="close"></a>Er zijn geen portfolio\'s om weer te geven!</div>';
                    }
                    mysqli_free_result($QueryResult);
                    mysqli_close($dbc);
                } else {
                    echo '<div class="alert  alert-danger alert-dismissable "><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Geen toegang, log in met een Admin of SLB account</div>';
                }
            } else {
                echo '<div class="alert  alert-danger alert-dismissable "><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>U heeft geen rechten om deze pagina te bezoeken</div>';
            }
        } else {	//engels versie
           $message_status = '';
            if (isset($_SESSION['access'])) {
                if ($_SESSION['access'] == "Admin" || $_SESSION['access'] == "SLB") {
                    $SQLstring = "SELECT DISTINCT content.UserID, `FirstName`, `LastName`, `Date`, `ContentID`, `Tags` FROM user, content WHERE user.UserID = content.UserID GROUP BY content.UserID";
                    $QueryResult = mysqli_query($dbc, $SQLstring);
                    if (mysqli_num_rows($QueryResult) > 0) {
                        echo "<h2>Grade portfolio's</h2>";
                        echo "<p class='admin'>In the table below you can see all portfolio's that were made in the system. This page is where you can give or take approval of a portfolio. Its also possible to go to the portfolio's by clicking the link.</p>";
						
						echo "<table class='table table-responsive table-condensed'>
								<thead>
								 <tr>
								   <th>Name</th>
								   <th>Date</th>
								   <th>Approve</th>
								   <th>Status</th>
								   <th>View Portfolio</th>
								 </tr>
								</thead>";
                        while ($Row = mysqli_fetch_assoc($QueryResult)) {
                            echo "<tr><td>" . $Row['FirstName'] . " ". $Row['LastName'] . "</td>";
                            echo "<td>" . $Row['Date'] . "</td>";
                            if (isset($_POST['submit_goed'])) {	
								$time = date('Y-m-d');
								if ($_POST['id'] == $Row['ContentID'])
								{
									$SQL2 = "SELECT * FROM grade WHERE UserID = ".$Row['UserID']."";
									$Query2 = mysqli_query($dbc, $SQL2);
									if (mysqli_num_rows($Query2) == '0')
									{
										$sql = "INSERT INTO `grade`(`GradeID`, `UserID`, `GraderID`, `Date`, `Grade`) VALUES (NULL, " . $Row['UserID'] . ", " . $_SESSION['id'] . ", '$time', '1')";
									} else {
										$sql = "UPDATE grade SET Grade = '1' WHERE UserID = ".$_POST['user']."";
									}
									$Grade = mysqli_fetch_assoc($Query2);
									$result = mysqli_query($dbc, $sql);
								}				
								$message_status = 'good';
							}elseif(isset($_POST['submit_fout'])) {
								$sql2 = "UPDATE grade SET Grade = '0' WHERE UserID = ".$_POST['user']."";
								$result = mysqli_query($dbc, $sql2);
								$message_status = 'bad';
                            }
							$SQL2 = "SELECT * FROM grade WHERE UserID = ".$Row['UserID']."";
							$Query2 = mysqli_query($dbc, $SQL2);
							$Grade = mysqli_fetch_assoc($Query2);
                            echo "<td><form method='POST' action='#'><input type='hidden' name='id' value='" . $Row['ContentID'] . "'><input type='hidden' name='user' value='" . $Row['UserID'] . "'>";
							
							if($Grade['Grade'] == 0){
								echo"<input class='btn btn-success btn-sm' type='submit' name='submit_goed' value='Approve'>&nbsp;";
								echo"<input class='btn btn-warning btn-sm' type='submit' name='submit_fout' value='Disapprove' disabled>";
							}else{
								echo"<input class='btn btn-success btn-sm' type='submit' name='submit_goed' value='Approve' disabled>&nbsp;";
								echo"<input class='btn btn-warning btn-sm' type='submit' name='submit_fout' value='Disapprove'>";
							}
							echo"</form></td>";
                            if ($Grade['Grade'] == 1) {
                                $waarmerkTekst = '<p class="text-success">This portfolio has been approved.</p>';
                            } else {
                                $waarmerkTekst = '<p class="text-danger">This portfolio has nog yet been approved.</p>';
                            }
                            echo "<td>" . $waarmerkTekst . "</td>";
                            echo "<td><a class='btn btn-primary' href='index.php?portfolio=" . $Row['UserID'] . "' role=button><i class='fa fa-arrow-right' aria-hidden='true'></i></a></td><tr>";
                        }
						
						if($message_status == 'good'){
							echo '<div class="alert alert-success alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>The portfolio has been succesfully approved.</div>';
						}elseif($message_status == 'bad'){
							echo '<div class="alert alert-success alert-dismissable "><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>The portfolio has been succesfully disapproved.</div>';
						}
						
						echo "</table>";
                    } else {
                        echo '<div class="alert alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close"></a>There are no portfolio\'s to display.</div>';
                    }
                    mysqli_free_result($QueryResult);
                    mysqli_close($dbc);
                } else {
                    echo '<div class="alert  alert-danger alert-dismissable "><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Access denied.</div>';
                }
            } else {
                echo '<div class="alert  alert-danger alert-dismissable "><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Access denied.</div>';
            }
        }
    } elseif ($_GET['submenu'] == 'user') { //gebruikers management gedeelte
        if ($_SESSION['language'] == "dutch") { //nl versie
            if (isset($_SESSION['access'])) {
                if ($_SESSION['access'] !== "Leerling") {
					//pagina alleen voor niet leerlingen
                    $SQLstring = "SELECT * FROM `user`";
                    $QueryResult = mysqli_query($dbc, $SQLstring);
                    if (mysqli_num_rows($QueryResult) > 0) {
                        echo "<h2>Gebruikersbeheer</h2>";
                        if ($_SESSION['access'] == "Admin") {
                            echo "<p class='admin'>Op deze pagina ziet u alle gebruikers die zich geregistreerd hebben in het systeem. Het is mogelijk om gebruikers te verwijderen. U kunt ook de rollen en rechten van de gebruiker veranderen.</p>";
                        } else {
                            echo "<p class='admin'>Op deze pagina ziet u alle gebruikers die zich geregistreerd hebben in het systeem.</p>";
                        }
						echo "<table class='table table-responsive table-condensed'>";
                        echo "<thead>
								 <tr>";
								if ($_SESSION['access'] == 'Admin') {
									echo'<th class="text-center">Verwijder</th>';
								}
								   echo"<th>Voornaam</th>
								   <th>Achternaam</th>
								   <th>Email</th>
								   <th>Telefoonnummer</th>
								   <th>Adres</th>
								   <th>Rol</th>
								 </tr>
								</thead>";

                        while ($Row = mysqli_fetch_assoc($QueryResult)) {
                            echo "<tr>";
							//als admin mag je accounts verwijderen. verwijderd ook alle content van die persoon
                            if ($_SESSION['access'] == "Admin") {
                                echo "<td class='text-center'>
										<form method='post'>
											<input type='submit' name='verwijder' class='btn btn-danger btn-xs' value='&times;'>
											<input type='hidden' name='id' value='" . $Row['UserID'] . "'>
										</form>
									  </td>";
                            }

                            echo "<td>" . $Row['FirstName'] . "</td>";
                            echo "<td>" . $Row['LastName'] . "</td>";
                            echo "<td>" . $Row['Email'] . "</td>";
                            echo "<td>" . $Row['PhoneNumber'] . "</td>";
                            echo "<td>" . $Row['Adres'] . "</td>";
							//voor admins mogen rollen van users veranderen. anders laat alleen de rol zien van users.
                            if ($_SESSION['access'] == "Admin") {
                                echo "<td>
										<form method='post' class='form_admin' action='".htmlentities($_SERVER["PHP_SELF"]) . "?page=adminpanel&submenu=user&updaterino=1'>";
										echo "<select name='rol' class='form-control input-xs'>";
										if ($Row['AccessLevel'] == "Leerling") {
											echo "<option value='Leerling' selected='selected'>Leerling</option>";
										} else {
											echo "<option value='Leerling'>Leerling</option>";
										}
										if ($Row['AccessLevel'] == "Docent") {
											echo "<option value='Docent' selected='selected'>Docent</option>";
										} else {
											echo "<option value='Docent'>Docent</option>";
										}
										if ($Row['AccessLevel'] == "Admin") {
											echo "<option value='Admin' selected='selected'>Admin</option>";
										} else {
											echo "<option value='Admin'>Admin</option>";
										}
										if ($Row['AccessLevel'] == "SLB") {
											echo "<option value='SLB' selected='selected'>SLB</option>";
										} else {
											echo "<option value='SLB'>SLB</option>";
										}
										echo "</select>&nbsp;&nbsp;
											  <input type='hidden' name='id2' value='" . $Row['UserID'] . "'>
											  <input class='btn btn-primary btn-xs' type='submit' name='update' value='Update'>
											</form>
									</td>";
                            } else {
                                echo "<td>" . $Row['AccessLevel'] . "</td>";
                            }		
                            echo "<tr>";
                        }
						echo "</table>";
						
						//update rol als veranderd is door admin
                        if (isset($_POST['update'])) {
                            $NewRole = $_POST['rol'];
                            $UpdateSQL = "UPDATE user SET AccessLevel = '" . $NewRole . "' WHERE UserID = " . $_POST['id2'] . "";
                            $SQLResult = mysqli_query($dbc, $UpdateSQL);
							$message_status = 'goed';
                            echo '<div class="alert  alert-success alert-dismissable ">
								  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								  De rol van deze gebruiker is succesvol gewijzigd.
								</div>';
                        }

						//verwijder gebruiker en alles wat die gebruiker had in het systeem.
                        if (isset($_POST['verwijder'])) {
                            $DeleteSQL = "DELETE FROM user WHERE UserID = " . $_POST['id'] . "";
                            $SQLResult = mysqli_query($dbc, $DeleteSQL);
							
                            $DeleteSQL2 = "DELETE FROM content WHERE UserId = " . $_POST['id'] . "";
                            $SQLResult2 = mysqli_query($dbc, $DeleteSQL2);
							
                            $DeleteSQL3 = "DELETE FROM grade WHERE UserID = " . $_POST['id'] . "";
                            $SQLResult3 = mysqli_query($dbc, $DeleteSQL3);
							
                            $DeleteSQL4 = "DELETE FROM file WHERE UserID = " . $_POST['id'] . "";
                            $SQLResult4 = mysqli_query($dbc, $DeleteSQL4);
							
                            $DeleteSQL5 = "DELETE FROM message WHERE SourceUserID = " . $_POST['id'] . "";
                            $SQLResult5 = mysqli_query($dbc, $DeleteSQL5);
							$message_status = 'fout';
                            echo '<div class="alert  alert-success alert-dismissable ">
									  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									  De gebruiker is succesvol verwijderd.
									</div>';
                        }
                    } else {
                        echo '<div class="alert  alert-danger alert-dismissable ">
							  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							  Er zijn geen gebruikers om weer te geven.
							</div>';
                    }
                    mysqli_free_result($QueryResult);
                    mysqli_close($dbc);
                } else {
                    echo '<div class="alert  alert-danger alert-dismissable ">
							  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							 U heeft geen toegang om deze pagina te bezoeken.
							</div>';
                }
            } else {
                echo '<div class="alert  alert-danger alert-dismissable ">
						  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 U heeft geen toegang om deze pagina te bezoeken.
						</div>';
            }
        } else { //engelse versei
            if (isset($_SESSION['access'])) {
                if ($_SESSION['access'] !== "Leerling") {
                    $SQLstring = "SELECT * FROM `user`";
                    $QueryResult = mysqli_query($dbc, $SQLstring);
                    if (mysqli_num_rows($QueryResult) > 0) {
                        echo "<h2>User Management</h2>";
                        if ($_SESSION['access'] == "Admin") {
                            echo "On this page you can see all the users that registered on the website. Its possible to remove users and to edit the rights these users have.";
                        } else {
                            echo "On this page you can see all the users that registered on the website.";
                        }
						echo "<table class='table table-responsive table-condensed'>";
                        echo "<thead>
								 <tr>";
								if ($_SESSION['access'] == 'Admin') {
									echo'<th class="text-center">Delete</th>';
								}
								   echo"<th>First name</th>
								   <th>Last name</th>
								   <th>Email</th>
								   <th>Phone number</th>
								   <th>Adres</th>
								   <th>Role</th>
								 </tr>
								</thead>";

                        while ($Row = mysqli_fetch_assoc($QueryResult)) {
                            echo "<tr>";
                            if ($_SESSION['access'] == "Admin") {
                                echo "<td class='text-center'>
										<form method=post action=#>
											<input type='submit' name='verwijder' class='btn btn-danger btn-xs' value='&times;'>
											<input type='hidden' name='id' value='" . $Row['UserID'] . "'>
										</form>
									  </td>";
                            }

                            echo "<td>" . $Row['FirstName'] . "</td>";
                            echo "<td>" . $Row['LastName'] . "</td>";
                            echo "<td>" . $Row['Email'] . "</td>";
                            echo "<td>" . $Row['PhoneNumber'] . "</td>";
                            echo "<td>" . $Row['Adres'] . "</td>";
                            if ($_SESSION['access'] == "Admin") {
                                echo "<td>
										<form method='post' class='form_admin' action='".htmlentities($_SERVER["PHP_SELF"]) . "?page=adminpanel&submenu=user&updaterino=1'>";
										echo "<select name='rol' class='form-control input-xs'>";
										if ($Row['AccessLevel'] == "Leerling") {
											echo "<option value='Leerling' selected='selected'>Student</option>";
										} else {
											echo "<option value='Leerling'>Student</option>";
										}
										if ($Row['AccessLevel'] == "Docent") {
											echo "<option value='Docent' selected='selected'>Teacher</option>";
										} else {
											echo "<option value='Docent'>Teacher</option>";
										}
										if ($Row['AccessLevel'] == "Admin") {
											echo "<option value='Admin' selected='selected'>Admin</option>";
										} else {
											echo "<option value='Admin'>Admin</option>";
										}
										if ($Row['AccessLevel'] == "SLB") {
											echo "<option value='SLB' selected='selected'>SLB</option>";
										} else {
											echo "<option value='SLB'>SLB</option>";
										}
										echo "</select>&nbsp;&nbsp;
											  <input type='hidden' name='id2' value='" . $Row['UserID'] . "'>
											  <input class='btn btn-primary btn-xs' type='submit' name='update' value='Update'>
											</form>
									</td>";
                            } else {
                                echo "<td>" . $Row['AccessLevel'] . "</td>";
                            }		
                            echo "<tr>";
                        }
						echo "</table>";
                        if (isset($_POST['update'])) {
                            $NewRole = $_POST['rol'];
                            $UpdateSQL = "UPDATE user SET AccessLevel = '" . $NewRole . "' WHERE UserID = " . $_POST['id2'] . "";
                            $SQLResult = mysqli_query($dbc, $UpdateSQL);
							$message_status = 'goed';
                            echo '<div class="alert  alert-success alert-dismissable ">
								  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								  The role of the user has been succesfully changed.
								</div>';
                        }

                        if (isset($_POST['verwijder'])) {
                            $DeleteSQL = "DELETE FROM user WHERE UserID = " . $_POST['id'] . "";
                            $SQLResult = mysqli_query($dbc, $DeleteSQL);
							
                            $DeleteSQL2 = "DELETE FROM content WHERE UserId = " . $_POST['id'] . "";
                            $SQLResult2 = mysqli_query($dbc, $DeleteSQL2);
							
                            $DeleteSQL3 = "DELETE FROM grade WHERE UserID = " . $_POST['id'] . "";
                            $SQLResult3 = mysqli_query($dbc, $DeleteSQL3);
							
                            $DeleteSQL4 = "DELETE FROM file WHERE UserID = " . $_POST['id'] . "";
                            $SQLResult4 = mysqli_query($dbc, $DeleteSQL4);
							
                            $DeleteSQL5 = "DELETE FROM message WHERE SourceUserID = " . $_POST['id'] . "";
                            $SQLResult5 = mysqli_query($dbc, $DeleteSQL5);
							$message_status = 'fout';
                            echo '<div class="alert  alert-success alert-dismissable ">
									  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									  The user has been succesfully removed.
									</div>';
                        }
                    } else {
                        echo '<div class="alert  alert-danger alert-dismissable ">
							  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							  There are no users to display.
							</div>';
                    }
                    mysqli_free_result($QueryResult);
                    mysqli_close($dbc);
                } else {
                    echo '<div class="alert  alert-danger alert-dismissable ">
							  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							 You do not have access to view this page.
							</div>';
                }
            } else {
                echo '<div class="alert  alert-danger alert-dismissable ">
						  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						 You do not have access to view this page.
						</div>';
            }
        }
    }
}
?>
