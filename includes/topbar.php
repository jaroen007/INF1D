<div class="topbarcontainer">
    <div class="topbar">
        <ul class="menu">
            <li class="item left">
				<a href='index.php'>Home</a>
			</li>
			<?php
			//opmaak gebaseerd op taal, rechten, sessies en een ton of other stuff....
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
					
					if($_SESSION['access'] != 'Leerling'){
						echo '<li class="item left">';
							echo "<a href='index.php?page=adminpanel&submenu=portfolio'>Admin paneel</a>";
						echo '</li>';
					}		
					
					echo '<li class="item right">';
						echo '<a href="index.php?page=profiel&user=' . $_SESSION['id'] . '"> <img class="Avatar" src="' . $_SESSION['Avatar'] . '" alt="avatar">&nbsp;' . $_SESSION['fname'] . ' ' . $_SESSION['lname'] . '</a>';
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
					
					if($_SESSION['access'] != 'Leerling'){
						echo '<li class="item left">';
							echo "<a href='index.php?page=adminpanel&submenu=portfolio'>Admin panel</a>";
						echo '</li>';
					}						

					echo '<li class="item right">';
						echo '<a href="index.php?page=profiel&user=' . $_SESSION['id'] . '"> <img class="Avatar" src="' . $_SESSION['Avatar'] . '" alt="avatar">&nbsp;' . $_SESSION['fname'] . ' ' . $_SESSION['lname'] . '</a>';
					echo '</li>';
					echo '<li class="item right">';
						echo '<a href="index.php?page=logout">Logout</a>';
					echo '</li>';
				}			
			
				if(strpos(htmlentities($_SERVER["REQUEST_URI"]), '?') == true){
					echo '<li class="item right">';
						echo '<a href="'.htmlentities($_SERVER["REQUEST_URI"]).'&language=dutch"><img src="images/dutch.png" alt="dutch" width="30" height="20"/></a>';
					echo '</li>';
				}else{
					echo '<li class="item right">';
						echo '<a href="'.htmlentities($_SERVER["REQUEST_URI"]).'?language=dutch"><img src="images/dutch.png" alt="dutch" width="30" height="20"/></a>';
					echo '</li>';					
				}
			}
			?>
		</ul>
		<div class="clear"></div>
	</div>
</div>