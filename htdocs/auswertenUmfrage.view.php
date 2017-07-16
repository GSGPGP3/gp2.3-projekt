<?php
/**
 * Created by PhpStorm.
 * User: kkurz
 * Date: 7/16/17
 * Time: 9:19 PM
 */

include "metadaten.php";

?>
    <table width="100%" border="1">
        <?php

        for ($id = 1;
             $id <= count($ueberschriften);
             $id++) {

            $result = $db->getAusgewaehlteFragen($id);
            if ($result && $result->num_rows >= 1) {

                ?>
                <tr>
                    <td colspan="5"><h3 align="center"><?= $ueberschriften[$id] ?> </h3>
                        <div align="center">Statistik vom <?= date("j.n.Y G:i:s") ?> </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="5">&nbsp;</td>
                </tr>
                <?php

                for ($i = 1; $i <= $result->num_rows; $i++) {
                    $row = $result->fetch_assoc();
                    $BL = $row["BL"]; // Bemerkung bzw. Tendenz links/positiv
                    $BR = $row["BR"]; // Bemerkung bzw. Tendenz rechts/negativ
                    $DP = $row["DP"]; // Doppel-Plus
                    $P = $row["P"];
                    $Neut = $row["Neut"];
                    $M = $row["M"];
                    $DM = $row["DM"]; // Doppel-Minus
                    $gesamt = $DP + $P + $Neut + $M + $DM;
                    $max = max($DP, $P, $Neut, $M, $DM);
                    $eins = 200 / $max;

                    ?>
                    <tr>
                        <td width="20%" rowspan="8" align="center" valign="middle">Frage <b><?= $i ?> </b>)</td>
                        <td colspan="4"><b><?= $row["Frage"] ?> </b></td>
                    </tr>
                    <tr>
                        <td colspan="4"><b><?= $row["BL"] ?> </b></td>
                    </tr>
                    <tr>
                        <td width="12%">
                            <div align="center">++</div>
                        </td>
                        <td width="16%">
                            <div align="center"><?= $DP ?> </div>
                        </td>
                        <td width="17%">
                            <div align="center"><?= round(100 / $gesamt, 2) * $DP ?>%</div>
                        </td>
                        <td width="35%"><img src="blue.gif" width="<?= $DP * $eins ?> px" height="10px"></td>
                    </tr>
                    <tr>
                        <td>
                            <div align="center">+</div>
                        </td>
                        <td>
                            <div align="center"><?= $P ?> </div>
                        </td>
                        <td>
                            <div align="center"><?= round(100 / $gesamt, 2) * $P ?>%</div>
                        </td>
                        <td><img src="blue.gif" width="<?= $P * $eins ?> px" height="10px"></td>
                    </tr>
                    <tr>
                        <td>
                            <div align="center">0</div>
                        </td>
                        <td>
                            <div align="center"><?= $Neut ?> </div>
                        </td>
                        <td>
                            <div align="center"><?= round(100 / $gesamt, 2) * $Neut ?>%</div>
                        </td>
                        <td><img src="blue.gif" width="<?= $Neut * $eins ?> px" height="10px"></td>
                    </tr>
                    <tr>
                        <td>
                            <div align="center">-</div>
                        </td>
                        <td>
                            <div align="center"><?= $M ?> </div>
                        </td>
                        <td>
                            <div align="center"><?= round(100 / $gesamt, 2) * $M ?>%</div>
                        </td>
                        <td><img src="blue.gif" width="<?= $M * $eins ?> px" height="10px"></td>
                    </tr>
                    <tr>
                        <td>
                            <div align="center">--</div>
                        </td>
                        <td>
                            <div align="center"><?= $DM ?> </div>
                        </td>
                        <td>
                            <div align="center"><?= round(100 / $gesamt, 2) * $DM ?>%</div>
                        </td>
                        <td><img src="blue.gif" width="<?= $DM * $eins ?> px" height="10px"></td>
                    </tr>
                    <tr>
                        <td colspan="4"><b><?= $row["BR"] ?> </b></td>
                    </tr>
                    <tr>
                        <td colspan="5">&nbsp;</td>
                    </tr>
                    <?php
                }
            }
        }
        ?>
        <tr>
            <td colspan="5">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="5"><h3 align="center">Kommentare</h3></td>
        </tr>
        <tr>
            <td colspan="5">&nbsp;</td>
        </tr>
        <?php
        $result = $db->getKommentare();

        if ($result) {
            for ($i = 1; $i <= $result->num_rows; $i++) {
                $row = $result->fetch_assoc();

                ?>
                <tr>
                    <td colspan="5"><?= $row["Kommentar"] ?> </td>
                </tr>
                <tr>
                    <td colspan="5">
                        <hr width="100%"/>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
    </table>
    <div align="center">&copy; Alexander Widmann</div>
<?php
include "tail.php";