<?php
/**
 * Created by PhpStorm.
 * User: kkurz
 * Date: 7/16/17
 * Time: 9:38 PM
 */

include("metadaten.php");
?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="100%" height="400" align="center" valign="middle">
                <form action="neu_2.php" method="post">
                    <table width="70%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td height="300px" align="left" valign="top">
                                <h3>Einrichtungsassistent:</h3>
                                <p>Bitte w&auml;hlen Sie aus den aufgef&uuml;hrten Fragen diejenigen aus, die Sie in
                                    Ihrer Umfrage haben m&ouml;chten.</p>'
                                <?php
                                for ($i = 1; $i <= count($ueberschriften); $i++) {
                                    $sql = "SELECT * FROM Fragen WHERE Block = '" . $i . "' ORDER BY ID;";
                                    $result = $db->query($sql);
                                    ?><h4><?= $ueberschriften[$i] ?></h4><?php

                                    if ($result) {
                                        for ($n = 1; $n <= $result->num_rows; $n++) {
                                            $row = $result->fetch_assoc();
                                            ?>
                                            <input name="<?= row["ID"] ?>" type="checkbox" value="1" checked> &nbsp;
                                            <?= $row["Frage"] ?><br>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                                <p><input name="" type="submit" value="Senden"></p>
                                <p align="center">&copy; Alexander Widmann</p>
                            </td>
                        </tr>
                    </table>
                </form>
            </td>
        </tr>
    </table>
<?php
include "tail.php";