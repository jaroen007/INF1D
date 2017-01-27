<?php
$core = new Core;
$dbc = $core->dbc();
if($_SESSION['language'] == 'dutch'){
?>
	<h2>Profiel</h2>
	<div class="panel panel-info c_2">
		<div class="panel-heading">
			<h3 class="panel-title">Gegevens</h3>
		</div>
		<div class="panel-body">
			<div class="row">
				<?php
					//haal alle gebruikersinfo op.
					$sql = "SELECT * FROM user WHERE UserID = '".$_GET['user']."'";
					$result = mysqli_query($dbc, $sql);
					$row = mysqli_fetch_assoc($result)
				?>
				<div class="col-md-3 col-lg-3" > <img alt="Avatar" src="<?php echo $row['Avatar']; ?>" class="img-circle img-responsive"> </div>
				<div class=" col-md-9 col-lg-9 "> 
					<table class="table table-user-information">
						<tbody>
							<tr>
								<td>Voornaam:</td>
								<td><?php echo $row['FirstName']; ?></td>
							</tr>
							<tr>
								<td>Achternaam:</td>
								<td><?php echo $row['LastName']; ?></td>
							</tr>
							<tr>
								<td>E-mail:</td>
								<td><?php echo $row['Email']; ?></td>
							</tr>
							<tr>
								<td>Telefoonnummer:</td>
								<td><?php echo $row['PhoneNumber']; ?></td>
							</tr>
							<tr>
								<td>Adres:</td>
								<td><?php echo $row['Adres']; ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<?php
		//laat edit profiel knop alleen zien als je op je eigen profiel zit.
		if(isset($_SESSION['id'])){
			if($_GET['user'] == $_SESSION['id']){
				echo'<div class="panel-footer">';
					 echo'<a href="index.php?page=profieledit" class="btn btn-sm edit-btn"><i class="glyphicon glyphicon-edit"></i> Bewerken</a>';
				echo' <div class="clear"></div></div>';
			}
		}
		?>
	</div>
	<div class="panel panel-info c_2">
		<div class="panel-heading">
			<h3 class="panel-title">Gastenboek</h3>
		</div>
		<div class="panel-body">
			 <?php
				$core = new Core();	
				$dbc = $core->dbc();			
				$core->getMessages($_GET["user"]);			
			?>
			<br>
			<?php
				if (isset($_POST['submit'])){
					$targetuser = $_GET["user"];
					$message = $_POST["MessageGuestbook"];
					$core = new Core();
					
					//insert bericht in db
					$core->InsertMessage($_SESSION["id"], $targetuser, date('Y-m-d'), date("H:i:s"), $message);

				}
			?>

			<div id="addMessage" class="modal fade" role="dialog">
				<?php
					//haal user info op
					$qry = "SELECT * FROM user WHERE UserID = '".$_GET["user"]."'";
					
					$result = mysqli_query($dbc, $qry);
					
					$row = mysqli_fetch_assoc($result);
					
					$fName = $row["FirstName"];
					$lName = $row["LastName"];
					
				?>
				  <div class="modal-dialog">
					<!-- Modal content-->
					<form method="post" action="<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>?page=profiel&user=<?php echo $_GET['user']?>&msg=1">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">
							<?php
								if($_SESSION["language"] == "dutch"){
									echo 'Plaats een bericht';
								}else{
									echo 'Write a message';
								}	
							?>  
							</h4>
						  </div>
						  <div class="modal-body">
							<?php
								if($_SESSION["language"] == "dutch"){
									echo '<p>U bent een bericht aan het plaatsen op het profiel van ' . "$fName $lName" .'.</p><br>';
								}else{
									echo '<p>You\'re about to place a message on the profile of ' . "$fName $lName" .'.</p><br>';
								}  
							?>
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">
											<p>
												<?php
													if($_SESSION["language"] == "dutch"){
														echo 'Bericht:';
													}else{
														echo 'Message:';
													}
												?>
											</p>
										</div>
										<textarea name="MessageGuestbook" class="form-control" rows="5"></textarea>
									</div>
								</div><br>
						  </div>
						  <div class="modal-footer">
							<div class="col-sm-12" id="modal_buttons">
								<?php
									if($_SESSION["language"] == "dutch"){
										echo '<input type="submit" name="submit" class="btn btn-primary" value="Plaats bericht">';
									}else{
										echo '<input type="submit" name="submit" class="btn btn-primary" value="Place message">';
									}
								?>
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						  </div>
						</div>
					</form>
				  </div>
			</div>			
		</div>
		<?php
			//laat bericht maken knop alleen zien als je NIET op je eigen profiel zit.
			if(isset($_SESSION['id'])){
				if($_GET['user'] != $_SESSION['id']){
					echo'<div class="panel-footer">';
						 echo'<a href="index.php?page=#addMessage" class="btn edit-btn btn-sm" data-toggle="modal"><i class="glyphicon glyphicon-plus-sign"></i> Plaats een bericht</a>';
					echo' <div class="clear"></div></div>';
				}
			}
		?>
	</div>

	<div class="clear">
	</div>
<?php }else{ ?>
	<h2>Profile</h2>
	<div class="panel panel-info c_2">
		<div class="panel-heading">
			<h3 class="panel-title">Information</h3>
		</div>
		<div class="panel-body">
			<div class="row">
				<?php
					//haal user info op
					$sql = "SELECT * FROM user WHERE UserID = '".$_GET['user']."'";
					$result = mysqli_query($dbc, $sql);
					$row = mysqli_fetch_assoc($result)
				?>
				<div class="col-md-3 col-lg-3 "> <img alt="Avatar" src="<?php echo $row['Avatar']; ?>" class="img-circle img-responsive"> </div>
				<div class=" col-md-9 col-lg-9 "> 
					<table class="table table-user-information">
						<tbody>
							<tr>
								<td>First name:</td>
								<td><?php echo $row['FirstName']; ?></td>
							</tr>
							<tr>
								<td>Surname:</td>
								<td><?php echo $row['LastName']; ?></td>
							</tr>
							<tr>
								<td>Email:</td>
								<td><?php echo $row['Email']; ?></td>
							</tr>
							<tr>
								<td>Phone number:</td>
								<td><?php echo $row['PhoneNumber']; ?></td>
							</tr>
							<tr>
								<td>Address:</td>
								<td><?php echo $row['Adres']; ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<?php
		//laat edit profiel knop alleen zien als je op je eigen profiel zit.
		if(isset($_SESSION['id'])){
			if($_GET['user'] == $_SESSION['id']){
				echo'<div class="panel-footer">';
					 echo'<a href="index.php?page=profieledit" class="btn btn-sm edit-btn"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
				echo' <div class="clear"></div></div>';
			}
		}
		?>
	</div>
	<div class="panel panel-info c_2">
		<div class="panel-heading">
			<h3 class="panel-title">Guestbook</h3>
		</div>
		<div class="panel-body">
			 <?php
				$core = new Core();	
				$dbc = $core->dbc();			
				$core->getMessages($_GET["user"]);			
			?>
			<br>
			<?php
				if (isset($_POST['submit'])){
					$targetuser = $_GET["user"];
					$message = $_POST["MessageGuestbook"];
					$core = new Core();
					
					$core->InsertMessage($_SESSION["id"], $targetuser, date('Y-m-d'), date("H:i:s"), $message);

				}
			?>
			<div id="addMessage" class="modal fade" role="dialog">
				<?php
					//haal user info op
					$qry = "SELECT * FROM user WHERE UserID = '".$_GET["user"]."'";
					
					$result = mysqli_query($dbc, $qry);
					
					$row = mysqli_fetch_assoc($result);
					
					$fName = $row["FirstName"];
					$lName = $row["LastName"];
					
				?>
				  <div class="modal-dialog">
					<!-- Modal content-->
					<form method="post" action="<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>?page=profiel&user=<?php echo $_GET['user']?>&msg=1">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">
							<?php
								echo 'Write a message';
							?>  
							</h4>
						  </div>
						  <div class="modal-body">
							<?php
								echo '<p>You\'re about to place a message on the profile of ' . "$fName $lName" .'.</p><br>';						  
							?>
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">
											<p>
												<?php
													echo 'Message:';
												?>
											</p>
										</div>
										<textarea name="MessageGuestbook" class="form-control" rows="5"></textarea>
									</div>
								</div><br>
						  </div>
						  <div class="modal-footer">
							<div class="col-sm-12" id="modal_buttons">
								<?php
									echo '<input type="submit" name="submit" class="btn btn-primary" value="Place message">';
								?>
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						  </div>
						</div>
					</form>
				  </div>
			</div>			
		</div>
		<?php
			//laat bericht maken knop alleen zien als je NIET op je eigen profiel zit.
			if(isset($_SESSION['id'])){
				if($_GET['user'] != $_SESSION['id']){
					echo'<div class="panel-footer">';
						 echo'<a href="index.php?page=#addMessage" class="btn edit-btn btn-sm" data-toggle="modal"><i class="glyphicon glyphicon-plus-sign"></i> Leave a message</a>';
					echo' <div class="clear"></div></div>';
				}
			}
		?>
	</div>

	<div class="clear">
	</div>
<?php } ?>
