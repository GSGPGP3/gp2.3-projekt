<?php
/**
 * Created by PhpStorm.
 * User: kkurz
 * Date: 7/16/17
 * Time: 9:37 PM
 */

include("metadaten.php");
?>
    <table width="726" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="166">
                <div align="center"><a href="neu.php">Neue Umfrage einrichten</a></div>
            </td>
            <td width="145">
                <div align="center"><a href="auswertenUmfrage.php" target="_blank">Umfrage auswerten</a></div>
            </td>
            <td width="160">
                <div align="center"><a href="loeschenUmfrage.php">Umfragedaten l&ouml;schen</a></div>
            </td>
            <td width="73" bgcolor="#FF0000">
                <div align="center"><a href="logoutAdmin.php">Logout</a></div>
            </td>
            <td width="182">
                <div align="center"></div>
            </td>
        </tr>
    </table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="100%" height="400" align="center" valign="middle">
                <table width="70%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td><h3>Anleitung und Hinweise:</h3>
                            <ul>
                                <li>Um eine Umfrage durchzuf&uuml;hren klicken Sie auf <strong>Neue Umfrage
                                        starten</strong> und folgen Sie dem Einrichtungsassistenten.
                                </li>
                                <li>Klicken Sie w&auml;rend die Umfrage l&auml;uft nicht vorzeitig auf
                                    <strong>Logout</strong> oder <strong>Umfragedaten l&ouml;schen</strong>, da dies aus
                                    Datenschutzgr&uuml;nden alle Umfrageergebnisse l&ouml;scht.
                                </li>
                                <li>&Uuml;ber <strong>Umfrage auswerten</strong> k&ouml;nnen Sie sich die aktuellen
                                    Ergebnisse der Umfrage ansehen, und &uuml;ber den Browser nach Beendigung der
                                    Umfrage downloaden.
                                </li>
                                <li>Sichern Sie unbedingt ihre Umfrageergebnisse ab, da Sie diese komplett aus der
                                    Datenbank l&ouml;schen sollten.
                                </li>
                                <li>Beenden Sie ihre Arbeit an diesem Men&uuml; <strong>IMMER</strong> mit einem Klick
                                    auf <strong>Umfragedaten l&ouml;schen</strong> und anschlie&szlig;end auf <strong>Logout</strong>,
                                    um zu verhindern, dass andere Personen Zugriff auf die Umfragedaten haben. Sicherung
                                    nicht vergessen!
                                </li>
                            </ul>
                            <p align="center">&copy; Alexander Widmann</p></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
<?php
include "tail.php";