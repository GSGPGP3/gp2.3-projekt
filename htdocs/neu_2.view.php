<?php
/**
 * Created by PhpStorm.
 * User: kkurz
 * Date: 7/16/17
 * Time: 9:43 PM
 */


include("metadaten.php");

?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="100%" height="400" align="center" valign="middle">
                <form action="neu_3.php" method="post">
                    <table width="70%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td height="300px" align="left" valign="top">
                                <h3>Einrichtungsassistent:</h3>
                                <p>Die Fragen wurden erfolgreich ausgew&auml;hlt. Nun m&uuml;ssen Sie nur noch ausw&auml;hlen,
                                    wie viele Sch&uuml;ler die Umfrage machen sollen:</p>
                                <p>
                                    <select name="Anzahl" id="select">
                                        <option value="10">10</option>
                                        <option value="15">15</option>
                                        <option value="20">20</option>
                                        <option value="25">25</option>
                                        <option value="30">30</option>
                                        <option value="35">35</option>
                                        <option value="40">40</option>
                                        <option value="45">45</option>
                                        <option value="50">50</option>
                                        <option value="60">60</option>
                                    </select>
                                    W&auml;hlen Sie die Anzahl der Sch&uuml;ler und runden Sie gegebenenfalls auf.
                                </p>
                                <p>Beispiel: 26 Sch&uuml;ler sollen die Umfrage machen: w&auml;hlen Sie 30</p>
                                <p>Klicken Sie danach auf <strong>Senden</strong> und drucken Sie die nachfolgende
                                    Seite, die die Sessions f&uuml;r Ihre Sch&uuml;ler enth&auml;lt, aus.</p>
                                <p><input type="submit" name="button" id="button" value="Senden"></p>
                                <p align="center">&copy; Alexander Widmann</p></td>
                        </tr>
                    </table>
                </form>
            </td>
        </tr>
    </table>
<?php
include "tail.php";