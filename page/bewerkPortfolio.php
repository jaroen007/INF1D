<div class="contentcontainer">
    <div class="content">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="c_1">
                <h1>Bewerk je eigen portfolio</h1>
                <input type="hidden" name="contentID"
                <p class="inputNaam">
                    Content Bewerken:
                </p>
                <p>
                    <textarea class="invoerveldGroot" name="portfolioContentUpdate">
                        <?php $core->getPortfolio($_GET['editPortfolio']);?>
                    </textarea>

                </p>

<!--                <p class="inputNaam">
                    Tags:
                </p>
                <p>
                    <input class="invoerveld" type="text" name="portfolioTags">
                </p>-->
                <p>
                    <input class="invoerveld" type="submit" value="opslaan">
                </p>
            </div>
            <div class="clear"></div>

        </form>
    </div>
</div>