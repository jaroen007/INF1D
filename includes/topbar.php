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
			
            <li class="item left">
                <?php
                if ($language == "dutch")
                {
                    echo "
				<a href='index.php?editPortfolio=1'>
				Bewerk je portfolio
				</a>";
                } else
                {
                    echo "<a href='index.php?editPortfolio=1'>				
                                Edit your portfolio
				</a>";
                }
                ?>
            </li>
			<div id="languages">
				<form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
					<label class="languagehover">
						<input type="radio" name="language" value="dutch" onchange="post(this.value);" <?php
						if ($language == "dutch")
						{
							echo "checked=\"checked\"";
						}
						?> />
						<img src="images/dutch.png" alt="dutch" />
					</label>
					<label class="languagehover">
						<input type="radio" name="language" value="english" onchange="post(this.value);" <?php
						if ($language == "english")
						{
							echo "checked=\"checked\"";
						}
						?> />	
						<img src="images/english.png" alt="english" />
					</label>
				</form>
			</div>
        <ul>

                <div class="clear"></div>

                </div>
                </div>