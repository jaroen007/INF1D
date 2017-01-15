<div class="topbarcontainer">
    <div class="topbar">
        <ul class="menu">
            <li class="item left">
				<a href='index.php'>Home</a>
			</li>
			<?php
			if($language == 'dutch'){
				if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] != 'yes'){
					echo'<li class="item right">';
						echo'<a href="index.php?page=#login" data-toggle="modal">Inloggen</a>';
					echo'</li>';
					echo'<li class="item right">';
						echo'<a href="index.php?page=#register" data-toggle="modal">Registreer</a>';
					echo'</li>';									
				}else{
					$bestaan = $core->portfolioBestaat();
					if($bestaan){			
						echo '<li class="item left">';
							echo "<a href='index.php?portfolio=" . $_SESSION['id'] . "'>Mijn portfolio</a>";
						echo '</li>';
					}else{
						echo '<li class="item left">';
							echo "<a href='index.php?page=makePortfolio'>Maak een portfolio</a>";
						echo '</li>';
					}
					
					if($_SESSION['access'] == "Docent"){
						echo '<li class="item left">';
							echo "<a href='beoordelenportfolio.php'>Beoordelen Portfolio</a>";
						echo '</li>';
					}

					echo '<li class="item right">';
						echo '<a href="profiel.php"> <img src="lol.png">' . $_SESSION['fname'] . ' ' . $_SESSION['lname'] . '</a>'; //TODO: add avatar
					echo '</li>';
					echo '<li class="item right">';
						echo '<a href="index.php?page=logout">Uitloggen</a>';
					echo '</li>';
				}
				
				if(strpos(htmlentities($_SERVER["REQUEST_URI"]), '?') == true){
					echo '<li class="item right">';
						echo '<a href="'.htmlentities($_SERVER["REQUEST_URI"]).'&language=english"><img src="images/english.png" alt="english" width="30" height="20"/></a>';
					echo '</li>';
				}else{
					echo '<li class="item right">';
						echo '<a href="'.htmlentities($_SERVER["REQUEST_URI"]).'?language=english"><img src="images/english.png" alt="english" width="30" height="20"/></a>';
					echo '</li>';					
				}
			}else{
				if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] != 'yes'){
					echo'<li class="item right">';
						echo'<a href="index.php?page=#login" data-toggle="modal">Login</a>';
					echo'</li>';
					echo'<li class="item right">';
						echo'<a href="index.php?page=#register" data-toggle="modal">Register</a>';
					echo'</li>';									
				}else{
					$bestaan = $core->portfolioBestaat();
					if($bestaan){			
						echo '<li class="item left">';
							echo "<a href='index.php?portfolio=" . $_SESSION['id'] . "'>My portfolio</a>";
						echo '</li>';
					}else{
						echo '<li class="item left">';
							echo "<a href='index.php?page=makePortfolio'>Create portfolio</a>";
						echo '</li>';
					}
					
					if($_SESSION['access'] == "Docent"){
						echo '<li class="item left">';
							echo "<a href='beoordelenportfolio.php'>Grade portfolio</a>";
						echo '</li>';
					}

					echo '<li class="item right">';
						echo '<a href="profiel.php"> <img src="lol.png">' . $_SESSION['fname'] . ' ' . $_SESSION['lname'] . '</a>'; //TODO: add avatar
					echo '</li>';
					echo '<li class="item right">';
						echo '<a href="index.php?page=logout">Logout</a>';
					echo '</li>';
				}			
			
				if(strpos(htmlentities($_SERVER["REQUEST_URI"]), '?') == true){
					echo '<li class="item right">';
						echo '<a href="'.htmlentities($_SERVER["REQUEST_URI"]).'&language=dutch"><img src="images/dutch.png" alt="english" width="30" height="20"/></a>';
					echo '</li>';
				}else{
					echo '<li class="item right">';
						echo '<a href="'.htmlentities($_SERVER["REQUEST_URI"]).'?language=dutch"><img src="images/dutch.png" alt="english" width="30" height="20"/></a>';
					echo '</li>';					
				}
			}
			?>
		</ul>
		<div class="clear"></div>
	</div>
</div>