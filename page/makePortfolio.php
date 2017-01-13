<div class="contentcontainer">
    <div class="content">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="c_1">
                <h1>Maak je eigen portfolio</h1>
                <p>
                    <input name="userID" value="<?php echo $_SESSION['id'];?>" type="hidden">
                </p>
                <p class="inputNaam">
                    Over mij:
                </p>
                <p>
                    <textarea class="invoerveldGroot" name="overMij"></textarea>

                </p>
                <p class="inputNaam">
                    Ervaring:
                </p>
                <p>
                    <textarea class="invoerveldGroot" name="experience"></textarea>

                </p>
                <p class="inputNaam">
                    Opleidingen:
                </p>
                <p>
                    <textarea class="invoerveldGroot" name="education"></textarea>

                </p>
                <p class="inputNaam">
                    Interesses:
                </p>
                <p>
                    <textarea class="invoerveldGroot" name="interesses"></textarea>
                </p>
                <p class="inputNaam">
                    Overige:
                </p>
                <p>
                    <textarea class="invoerveldGroot" name="overige"></textarea>
                </p>
                <p class="inputNaam">
                    Contact:
                </p>
                <p>
                    <textarea class="invoerveldGroot" name="contact"></textarea>
                </p>
                <p>
                    <input class="invoerveld" type="submit" value="opslaan">
                </p>
            </div>
            <div class="clear"></div>

        </form>
    </div>
</div>