<?php if($_SESSION['language'] == 'dutch'){ ?>
	<div class="c_2">
		<h2>Welkom op het digitale portfolio systeem van Hogeschool Stenden.</h2>
		<h4>Door studenten, Voor studenten.</h4>
	</div>
	<div class="c_2">
		<div id="logo">
			<img src="images/madebystudents.png" width="140" height="115" alt="logo">
		</div>
	</div>
	<div class="clear"></div>
	<div class="c_1">
	Op deze website kunnen alle studenten van Stenden Hogeschool hun digitale portfolio ontwerpen, maken en plaatsen. Iedereen kan deze portfolio's bekijken. Op deze manier kunt u op elk gewenst moment deze portfolio's inzien. 
	Ook kunnen de portfolio's ten alle tijden worden bewerkt door de leerling zelf.<br><br>
	Dit systeem is ontworpen voor studenten om het delen van gegevens makkelijker te maken. Het digitaliseren van portfolio's, Curriculum Vitaes, certificaten enzovoort brengt vele mogelijkheden en gemakken met zich mee.<br><br>
	Om te beginnen kunt u eens een kijkje nemen op de website door portfolio's van anderen te bekijken. Dit kunt u gemakkelijk doen door hieronder te zoeken naar een portfolio of door op een willekeurige portfolio te klikken.
	</div>
	<h3>Portfolio zoeken</h3>
	<p><form method="post" action="<?php echo htmlentities($_SERVER["PHP_SELF"]."?page=home"); ?>">	
		<div class="col-lg-6">
			<div class="input-group">
				<input type="text" class="form-control" name="search" placeholder="Zoekopdracht" required="required">
				<span class="input-group-btn">
					<button class="btn btn-default" name="submit" type="submit">Zoeken</button>
				</span>
			</div><!-- /input-group -->
		</div><!-- /.col-lg-6 -->
	</form>
	<br><br>
	<h3>Alle portfolio's</h3>
	<div class="clear"></div>
	<?php
		$core = new Core;
		//als zoekopdracht is dan haal results en laat zien anders pak alle portfolios
		$result = isset($_POST["submit"]) ? $core->searchUsers($_POST["search"]) : $core->getUsersWithPortfolio();
		
		if(mysqli_num_rows($result) != 0){
			while($row = mysqli_fetch_assoc($result)){
				
				$FirstName 	= $row["FirstName"];
				$LastName 	= $row["LastName"];
				
				?>
				<div class="c_3">
					<a href="<?php echo htmlentities($_SERVER["PHP_SELF"]."?portfolio=".$row['UserID'].""); ?>" ><div class="bordered_box"><?php echo "$FirstName $LastName"; ?></div></a>
				</div>
				<?php 
			}
		}else{
			echo '<div class="alert alert alert-danger "><a href="#" data-dismiss="alert" aria-label="close"></a>Er zijn nog geen portfolio\'s in het systeem aangemaakt.</div>';
		}

	?>
	<div class="clear"></div>
<?php }else{ ?>
	<div class="c_2">
		<h2>Welcome to the digital portfolio system of Highschool Stenden.</h2>
		<h4>By students, for students.</h4>
	</div>
	<div class="c_2">
		<div id="logo">
			<img src="images/madebystudents.png" width="140" height="115" alt="logo">
		</div>
	</div>
	<div class="clear"></div>
	<div class="c_1">
		On this website all students from Stenden University can design, create and display their own personal portfolio. Everyone can see these portfolios. In this manner you are able to read every single portfolio at all times.   
		The students are also qualified to adjust their own portfolio if needed.<br><br>
		The system has been developed by students to make sharing of information easier. Digitalizing the portfolios, Curriculum Vitaes, certificates and so on brings us many possibilities.<br><br>
		To start you should take a look at other portfolio's. You can do this by simply typing criteria in the search box or by browsing through all the portfolios at random. You can do both of these thing down below.
	</div>
	<h3>Search portfolio</h3>
	<p><form method="post" action="<?php echo htmlentities($_SERVER["PHP_SELF"]."?page=home"); ?>">	
		<div class="col-lg-6">
			<div class="input-group">
				<input type="text" class="form-control" name="search" placeholder="Criteria">
				<span class="input-group-btn">
					<button class="btn btn-default" name="submit" type="submit">Search</button>
				</span>
			</div><!-- /input-group -->
		</div><!-- /.col-lg-6 -->
	</form><br><br>
	<h3>All portfolio's</h3>
	<div class="clear"></div>
	<?php
		$core = new Core;
		//als zoekopdracht is dan haal results en laat zien anders pak alle portfolios
		$result = isset($_POST["submit"]) ? $core->searchUsers($_POST["search"]) : $core->getUsersWithPortfolio();
		
		if(mysqli_num_rows($result) != 0){
			while($row = mysqli_fetch_assoc($result)){
				
				$FirstName 	= $row["FirstName"];
				$LastName 	= $row["LastName"];
				
				?>
				<div class="c_3">
					<a href="<?php echo htmlentities($_SERVER["PHP_SELF"]."?portfolio=".$row['UserID'].""); ?>" ><div class="bordered_box"><?php echo "$FirstName $LastName"; ?></div></a>
				</div>
				<?php 
			}
		}else{
			echo '<div class="alert alert alert-danger "><a href="#" data-dismiss="alert" aria-label="close"></a>No portfolio\'s have been created yet.</div>';
		}

	?>
	<div class="clear"></div>
<?php } ?>
