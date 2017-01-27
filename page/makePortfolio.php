<?php if($_SESSION['language'] == 'dutch'){ ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="c_1">
                <h2>Maak je eigen portfolio</h2>
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
                    <input class="btn btn-sm btn-primary invoerveld" type="submit" value="opslaan">
                </p>
            </div>
            <div class="clear"></div>
        </form>
<?php }else{ ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="c_1">
                <h2>Make your own portfolio</h2>
                <p>
                    <input name="userID" value="<?php echo $_SESSION['id'];?>" type="hidden">
                </p>
                <p class="inputNaam">
                    About me:
                </p>
                <p>
                    <textarea class="invoerveldGroot" name="overMij"></textarea>

                </p>
                <p class="inputNaam">
                    Experiences:
                </p>
                <p>
                    <textarea class="invoerveldGroot" name="experience"></textarea>

                </p>
                <p class="inputNaam">
                    Studies:
                </p>
                <p>
                    <textarea class="invoerveldGroot" name="education"></textarea>

                </p>
                <p class="inputNaam">
                    Interests:
                </p>
                <p>
                    <textarea class="invoerveldGroot" name="interesses"></textarea>
                </p>
                <p class="inputNaam">
                    Other:
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
                    <input class="btn btn-sm btn-primary invoerveld" type="submit" value="opslaan">
                </p>
            </div>
            <div class="clear"></div>
        </form>
<?php } ?>