<?php
/**
 * Created by PhpStorm.
 * User: kkurz
 * Date: 7/16/17
 * Time: 9:27 PM
 */


include("metadaten.php");

?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="100%" height="400" align="center" valign="middle">
                <?php
                if ($ausgefuellt) {
                    ?>
                    <table width="40%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td bgcolor="#333333" class="Tabellenueberschrift"><span class="Tabellenueberschrift">&gt;&nbsp;&nbsp;Dankesch&ouml;n</span>
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>Vielen Dank f&uuml;r das Ausf&uuml;llen des Fragebogens</td>
                        </tr>
                    </table>
                    <?php
                } else {
                    ?>
                    <form name="FragebogenFormular" method="post" action="speichernFeedback.php">
                        <table width="581" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td colspan="8" bgcolor="#333333" class="Tabellenueberschrift"><span
                                            class="Tabellenueberschrift">&gt;&nbsp;&nbsp;Fragebogen</span>
                                </td>
                            </tr>
                            <?php
                            for ($i = 1; $i <= count($ueberschriften); $i++) {

                                $result1 = $db->getAusgewaehlteFragen($id);
                                if ($result1 && $result1->num_rows >= 1) // es gibt Fragen in diesem Block
                                {
                                    ?>
                                    <tr>
                                        <td colspan="8">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td colspan="8"><h3 align="center">' . $ueberschriften[$i] . '</h3></td>
                                    </tr>
                                    <tr>
                                        <td width="314" bgcolor="#333333" class="Tabellenueberschrift"><span
                                                    class="Tabellenueberschrift">Frage</span></td>
                                        <td width="62" bgcolor="#333333" class="Tabellenueberschrift">&nbsp;</td>
                                        <td width="23" bgcolor="#333333" class="Tabellenueberschrift"><span
                                                    class="Tabellenueberschrift">
	                <div align="center" class="Tabellenueberschrift">++</div>
	                </span></td>
                                        <td width="23" bgcolor="#333333" class="Tabellenueberschrift"><span
                                                    class="Tabellenueberschrift">
	                <div align="center">+</div>
	                </span></td>
                                        <td width="23" bgcolor="#333333" class="Tabellenueberschrift"><span
                                                    class="Tabellenueberschrift">
	                <div align="center">0</div>
	                </span></td>
                                        <td width="24" bgcolor="#333333" class="Tabellenueberschrift"><span
                                                    class="Tabellenueberschrift">
	                <div align="center">-</div>
	                </span></td>
                                        <td width="24" bgcolor="#333333" class="Tabellenueberschrift"><span
                                                    class="Tabellenueberschrift">
	                <div align="center">--</div>
	                </span></td>
                                        <td width="88" bgcolor="#333333" class="Tabellenueberschrift">&nbsp;</td>
                                    </tr>
                                    <?php
                                    for ($n = 0; $n < $result1->num_rows; $n++) {
                                        $row1 = $result1->fetch_assoc();
                                        ?>
                                        <tr>
                                            <td width="314">' . htmlspecialchars($row1["Frage"], ENT_QUOTES) . '</td>
                                            <td width="62">
                                                <div align="center">' . $row1["BL"] . '</div>
                                            </td>
                                            <td width="23">
                                                <div align="center">
                                                    <input type="radio" name="' . $row1[" ID"] . '" value="DP" id="' .
                                                    $row1["ID"] .
                                                    '_0">
                                                </div>
                                            </td>
                                            <td width="23">
                                                <div align="center">
                                                    <input type="radio" name="' . $row1[" ID"] . '" value="P" id="' .
                                                    $row1["ID"] .
                                                    '_1">
                                                </div>
                                            </td>
                                            <td width="23">
                                                <div align="center">
                                                    <input type="radio" name="' . $row1[" ID"] . '" value="Neut" id="' .
                                                    $row1["ID"] .
                                                    '_2">
                                                </div>
                                            </td>
                                            <td width="24">
                                                <div align="center">
                                                    <input type="radio" name="' . $row1[" ID"] . '" value="M" id="' .
                                                    $row1["ID"] .
                                                    '_3">
                                                </div>
                                            </td>
                                            <td width="24">
                                                <div align="center">
                                                    <input type="radio" name="' . $row1[" ID"] . '" value="DM" id="' .
                                                    $row1["ID"] .
                                                    '_4">
                                                </div>
                                            </td>
                                            <td width="88">
                                                <div align="center">' . $row1["BR"] . '</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="8">
                                                <hr width="100%">
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                            }
                            ?>
                            <tr>
                                <td colspan="8">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="1" valign="top">Kommentar:</td>
                                <td colspan="7"><label>
                                        <textarea name="Kommentar" id="Kommentar" cols="45" rows="5"></textarea>
                                    </label></td>
                            </tr>
                            <tr>
                                <td colspan="8">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="8"><label>
                                        <input type="submit" name="button" id="button"
                                               value="Umfrage-Formular absenden">
                                    </label></td>
                            </tr>
                        </table>
                    </form>
                    <?php
                }
                ?>
            </td>
        </tr>
    </table>
<?php
include "tail.php";