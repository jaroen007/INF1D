
<div class="topbarcontainer">
	<div class="topbar">

		<ul class="menu">
			
			<li class="item left">
				<a href="index.php?page=makePortfolio">
				Maak een portfolio
				</a>
			</li>

			<li class="item right">
				<a href="index.php?page=login">
				Login
				</a>
			</li>
			
			<li class="item left">
				<a href="index.php?editPortfolio=1">
				Bewerk je portfolio
				</a>
			</li>
			
			<li class="item left">
				<a href="index.php?page=login">
				Login
				</a>
			</li>
		<ul>
		
		<div class="clear"></div>
		<div id="languages">
                <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
                    <label class="languagehover">
                        <input type="radio" name="language" value="dutch" onchange="post(this.value);" <?php if($language == "dutch"){ echo "checked=\"checked\"";} ?> />
                        <img src="images/dutch.png" alt="dutch" />
                    </label>
                    <label class="languagehover">
                        <input type="radio" name="language" value="english" onchange="post(this.value);" <?php if($language == "english"){ echo "checked=\"checked\"";} ?> />	
                        <img src="images/english.png" alt="english" />
                    </label>
                </form>
            </div>
	</div>
</div>