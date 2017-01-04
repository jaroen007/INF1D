<div class="contentcontainer">
    <div class="content">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <?php 
            $core = new Core;
            $core->getPortfolio($_SESSION['id']);
            ?>
            
            <div class="clear"></div>

        </form>
    </div>
</div>