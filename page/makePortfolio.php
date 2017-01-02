<div class="contentcontainer">
    <div class="content">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="c_1">
                <h1>Maak je eigen portfolio</h1>
                <p class="inputNaam">
                    Content toevoegen:
                </p>
                <p>
                    <textarea class="invoerveldGroot" name="portfolioContent"></textarea>

                </p>

                <p class="inputNaam">
                    Tags:
                </p>
                <p>
                    <input class="invoerveld" type="text" name="portfolioTags">
                </p>
                <p>
                    <input class="invoerveld" type="submit" value="opslaan">
                </p>
            </div>
            <div class="clear"></div>

        </form>
    </div>
</div>