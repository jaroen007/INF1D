<?php include 'language.php'; ?>
<div class="topbarcontainer">
    <div class="topbar">
        <ul class="menu">
            <li class="item left">
                <?php
                if ($language == "dutch") {
                    echo "<a href='index.php'>Home</a>";
                } else {
                    echo "<a href='index.php'>Home</a>";
                }
                if ($_SESSION) {
                    ?>
                </li>
                <li class="item left">
                    <?php
                    $bestaan = $core->portfolioBestaat();
                    if ($bestaan) {
                        ?>
                    </li>
                    <li class="item left">
                        <?php
                        if ($language == "dutch") {
                            echo "
				<a href='index.php?portfolio=" . $_SESSION['id'] . "'>Bekijk je portfolio</a>";
                        } else {
                            echo "<a href='index.php?portfolio=" . $_SESSION['id'] . "'>View your portfolio</a>";
                        }
                    } else {
                        if ($language == "dutch") {
                            echo "<a href='index.php?page=makePortfolio'>Maak een portfolio</a>";
                        } else {
                            echo "<a href='index.php?page=makePortfolio'>Create a portfolio</a>";
                        }
                    }
                    ?>
                </li>
				<li class="item left">
					<?php
					if ($_SESSION['access'] == "Docent")
					{
						echo "<a href='beoordelenportfolio.php'>Beoordelen Portfolio</a>";
					}
					?>
				</li>
                    <?php
                    echo '<li class="item right">';
                    echo 'Ingelogd als: <a href="profiel.php">' . $_SESSION['fname'] . ' ' . $_SESSION['lname'] . '</a>'; //TODO: make link to profile page
                    echo '</li>';
                    echo '<li class="item right">';
                    echo '<a href="index.php?page=logout">Uitloggen</a>';
                    echo '</li>';
                } else {
                    ?>
                <li class="item right">
                <?php
                if ($language == "dutch") {
                    echo "
					<a href='index.php?page=#login' data-toggle='modal'>
					Inloggen
					</a>";
                } else {
                    echo "<a href='index.php?page=#login' data-toggle='modal'>
					Login
					</a>";
                }
                ?>
                </li>

                <li class="item right">
                    <?php
                    if ($language == "dutch") {
                        echo "
					<a href='index.php?page=#register' data-toggle='modal'>
					Registreer
					</a>";
                    } else {
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
                if ($language == "dutch") {
                    echo '<a href="?language=english"><img src="images/english.png" alt="english"/></a>';
                } else {
                    echo '<a href="?language=dutch"><img src="images/dutch.png" alt="dutch"/></a>';
                }
                ?>
                </label>
            </div>

            <ul>

                <div class="clear"></div>

                </div>
                </div>