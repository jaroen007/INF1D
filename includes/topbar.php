<?php include 'language.php'; ?>
<div class="topbarcontainer">
    <div class="topbar">

        <ul class="menu">
            <li class="item left">
                <?php
                if ($language == "dutch")
                {
                    echo "
				<a href='index.php'>
				Home
				</a>";
                } else
                {
                    echo "<a href='index.php'>				
                                 Home
            </a>";
                }
                if($_SESSION){
                ?>
            </li>
            <li class="item left">
                <?php
                if ($language == "dutch")
                {
                    echo "
				<a href='index.php?page=makePortfolio'>
				Maak een portfolio
				</a>";
                } else
                {
                    echo "<a href='index.php?page=makePortfolio'>				
                                 Create a portfolio
            </a>";
                }
                ?>
            </li>
			
            <li class="item left">
                <?php
                if ($language == "dutch")
                {
                    echo "
				<a href='index.php?page=bewerkPortfolio'>
				Bewerk je portfolio
				</a>";
                } else
                {
                    echo "<a href='index.php?page=bewerkPortfolio&editPortfolio=". @$_SESSION['id'] ."'>				
                                Edit your portfolio
				</a>";
                }
                ?>
            </li>
            <li class="item left">
                <?php
                if ($language == "dutch")
                {
                    echo "
				<a href='index.php?portfolio=". @$_SESSION['id'] ."'>
				Bekijk je portfolio
				</a>";
                } else
                {
                    echo "<a href='index.php?portfolio=". @$_SESSION['id'] ."'>				
                                View your portfolio
				</a>";
                }
                ?>
            </li>
			
                            
				
				 <li class="item right">
                                  <?php
                if ($language == "dutch")
                {   
				 echo 'Ingelogd als: '.@$_SESSION['fname'].' '.@$_SESSION['lname']; //TODO: make link to profile page
				 } else
                {
                    echo 'Logged in as: '.@$_SESSION['fname'].' '.@$_SESSION['lname']; //TODO: make link to profile page				
                ?>
                                 </li>
				 <li class="item right">
                                      <?php
                if ($language == "dutch")
                { 
				 echo '<a href="index.php?page=logout">Uitloggen</a>';
				 } else
                {
                    echo '<a href="index.php?page=logout">Logout</a>';				
                ?>
                                </li>
			
				<li class="item right">
					<?php
					if ($language == "dutch")
					{
						echo "
					<a href='index.php?page=#login' data-toggle='modal'>
					Inloggen
					</a>";
					} else
					{
						echo "<a href='index.php?page=#login' data-toggle='modal'>
					Login
					</a>";
					}
					?>
				</li>

				<li class="item right">
					<?php
					if ($language == "dutch")
					{
						echo "
					<a href='index.php?page=#register' data-toggle='modal'>
					Registreer
					</a>";
					} else
					{
						echo "<a href='index.php?page=#register' data-toggle='modal'>
					Register
					</a>";
					}
					?>
				</li>
			<?php
				}
			?>			
			<div id="languages">
				<label class="languagehover">
                                    <?php
                                    if ($language == "dutch"){
                                        echo '<a href="?language=english"><img src="images/english.png" alt="english"/></a>';
                                    } else {
                                        echo '<a href="?language=dutch"><img src="images/dutch.png" alt="dutch"/></a>';
                                    }	
                                    ?>
                                </label>
                        </div>
                                
        </ul>

                <div class="clear"></div>

                </div>
                </div>