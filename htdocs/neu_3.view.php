<?php
/**
 * Created by PhpStorm.
 * User: kkurz
 * Date: 7/16/17
 * Time: 9:44 PM
 */


include("metadaten.php");

?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="100%" height="400" align="center" valign="middle">
                <table width="70%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td height="300px" align="left" valign="top">
                            <table width="100%" border="1" cellspacing="0" cellpadding="0">
                                <tr>
                                    <?php
                                    srand(make_seed());
                                    if (isset($_POST["Anzahl"])) {
                                    for ($i = 1;
                                    $i <= $_POST["Anzahl"];
                                    $i++) {
                                    $ticket = randomString(7);
                                    $sql = "INSERT INTO Sessions (`Session`, `TicketID`,`Ausgefuellt`) VALUES ('', '" . $ticket . "', '0');";
                                    $db->query($sql);
                                    ?>
                                    <td height="50px">
                                        <div align="center"><?= $ticket ?></div>
                                    </td>
                                    <?php
                                    if ($i % 4 == 0) {
                                    ?>
                                </tr>
                                <tr>
                                    <?php
                                    }
                                    }
                                    }
                                    ?>
                                </tr>
                            </table>
                            <p>Drucken Sie diese Seite aus und verteilen Sie die Ticket-IDs an ihre Sch&uuml;ler. Diese
                                k&ouml;nnen sich nun einloggen und die Umfrage ausf&uuml;llen.</p>
                            <p><a href="menuAdmin.php">Hier geht es zum Hauptmenu</a></p>
                            <p align="center">&copy; Alexander Widmann</p></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
<?php
include "tail.php";