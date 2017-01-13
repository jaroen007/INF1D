<div class="contentcontainer">
    <div class="content">
        <?php
        // TODO:
        // - Link naar corresponderende portfolio
        // - Core connection function kreeg ik niet aan de praat pls help
        //
        if (isset($_SESSION['access'])) {
            if ($_SESSION['access'] == "Admin" || $_SESSION['access'] == "SLB") {
                $SQLstring = "SELECT Name, cv.UserID, Date, waarmerk, ContentID FROM cv, content WHERE cv.UserID = content.UserID";
                $QueryResult = mysqli_query($dbc, $SQLstring);
                if (mysqli_num_rows($QueryResult) >= 0) {
                    echo "<p>Portfolio Lijst!</p>";
                    echo "<p>In dit tabel staan alle portfolio's. U kunt de portfolio's goedkeuren door het boxje aan te vinken.</p>";
                    echo "<table class=table-bordered width='100%'>";
                    echo "<tr><th>Name</th><th>Date </th><th>Goedgekeurd</th><th>Waarmerk</th><th>Link</th>";

                    while ($Row = mysqli_fetch_assoc($QueryResult)) {
                        echo "<tr><td>" . $Row['Name'] . "</td>";
                        echo "<td>" . $Row['Date'] . "</td>";
                        $Checkbox = $Row['waarmerk'];
                        if (isset($_POST['submit'])) {
                            if (isset($_POST['check'])) {
                                $sql = "UPDATE content SET waarmerk = '1' WHERE ContentID = " . $_POST['id'] . "";
                                $result = mysqli_query($dbc, $sql);
                                $Checkbox = "1";
                                echo "<meta http-equiv='refresh' content='0'>";
                            } else {
                                $sql = "UPDATE content SET waarmerk = '0' WHERE ContentID = " . $_POST['id'] . "";
                                $result = mysqli_query($dbc, $sql);
                                echo "<meta http-equiv='refresh' content='0'>";
                            }
                        }
                        if ($Checkbox === '1') {
                            $Box = "checked";
                        } else {
                            $Box = "";
                        }

                        echo "<td><form method=POST action=#><input type=hidden name=id value=" . $Row['ContentID'] . "><input type=checkbox name=check " . $Box . " class=custom-control-input><input class=btn btn-primary type=submit name=submit value=Update!></form></td>";

                        if ($Row['waarmerk'] == 1) {
                            $waarmerkTekst = 'Dit portfolio is goedgekeurd &#10004;';
                        } else {
                            $waarmerkTekst = 'Dit portfolio is (nog) niet goedgekeurd &#10006;';
                        }
                        echo "<td>" . $waarmerkTekst . "</td>";
                        echo "<td><a class=btn btn-primary href=# role=button>Klik!</a></td><tr>";
                    }
                }
                mysqli_free_result($QueryResult);
                mysqli_close($dbc);
            } else {
                echo '<div class="alert alert-admin alert-danger alert-dismissable ">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 Geen toegang, log in met een Admin of SLB account
			</div>';
            }
        } else {
            echo '<div class="alert alert-admin alert-danger alert-dismissable ">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  U heeft geen rechten om deze pagina te bezoeken
			</div>';
        }
        ?>

    </div>
</div>

