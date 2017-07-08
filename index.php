<?php
######################################
## Copyright 2008 Alexander Widmann ##
## überarbeitet 2013 Reinhard Nickl ##
## - Optimierung der Struktur       ##
## - Ergänzung von Kommentaren      ##
##                                  ##
## Dieser Hinweis darf nicht        ##
## entfernt werden!!                ##
## -->www.alexander-projects.de     ##
## -->alex.widmann@gmail.com        ##
##                                  ##
## Startseite der Umfrage           ##
##                                  ##
######################################
session_start();   // neue Session erstellen oder bestehende fortführen, deren ID über eine GET-Variable oder ein Cookie übermittelt wurde. Im Erfolgsfall gibt die Funktion true zurück.
include("connect.php");   // Dateiinhalt (html und/oder php) wird hier ausgewertet, als würde er hier stehen

// aktuelle session-id in DB speichern --> nur eine Umfrage innerhalb einer Browser-Session ist möglich
// neue Umfrage am gleichen PC --> Browser schließen und neu starten
$session_id = session_id(); // Aktuelle Session-ID des Browsers holen
// hole alle session-Einträge dieser session-id aus der DB - dürfte eigentlich nur ein oder kein Datensatz sein
// nicht zu verwechseln mit der SessionID in Login.php !!!
$sql = "SELECT * FROM Sessions WHERE Session = '$session_id';";
$result = $mysqli->query($sql);
// wiederhole für Datensätze dieser session-id
//while($row = mysql_fetch_assoc($result))
$login_var = false; // boolsche Variable, gibt an, ob session-id in DB bereits existiert
$ausgefuellt = 0; // Dummy-Zuweisung, damit diese Variable existiert, auch wenn es die Session-ID nicht in DB gibt
for ($i = 1; $i <= $result->num_rows; $i++)   // Schleife über alle session-id-Einträge in DB, dürfte eigentlich höchstens einer sein
{
    $row = $result->fetch_assoc();
    $login_var = true;
    $ausgefuellt = $row["Ausgefuellt"];  // Ticket bereits verbraucht?
}
// wenn die session-id noch nicht in der DB ist --> Login, sonst Fragebogen wird fortgesetzt
if ($login_var == false) {
    // hier wird im Browser zu einer anderen Seite gewechselt - vergleichbar Link aber ohne erforderlichen Klick
    header("Location: login.php"); // Senden von HTTP-Anfangsinformationen (Headern) im Rohformat
}
include("metadaten.php");
// nun folgt der Fragebogen
// Beginn mehrzeilige HTML-Ausgabe
echo '
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
	    <tr>
	      <td width="100%" height="400" align="center" valign="middle">';   // echo-Ende
if ($ausgefuellt) // == true
{ // Die Umfrage-session ist verbraucht
    // Beginn mehrzeilige HTML-Ausgabe
    echo '
	        <table width="40%" border="0" cellspacing="0" cellpadding="0">
	          <tr>
	            <td bgcolor="#333333" class="Tabellenueberschrift"><span class="Tabellenueberschrift">&gt;&nbsp;&nbsp;Dankesch&ouml;n</span></td>
	          </tr>
	          <tr>
	            <td>&nbsp;</td>
	          </tr>
	          <tr>
	            <td>Vielen Dank f&uuml;r das Ausf&uuml;llen des Fragebogens</td>
	          </tr>
	        </table>';  // echo-Ende
} else {  // Fragebogen-Formular ausgeben
    // Beginn mehrzeilige HTML-Ausgabe
    echo '
	        <form name="FragebogenFormular" method="post" action="speichernFeedback.php">
	          <table width="581" border="0" cellspacing="0" cellpadding="0">
	            <tr>
	              <td colspan="8" bgcolor="#333333" class="Tabellenueberschrift"><span class="Tabellenueberschrift">&gt;&nbsp;&nbsp;Fragebogen</span></td>
	            </tr>'; // echo-Ende
    // Wiederhole für alle Blöcke ( = Anzahl Überschriften = Länge array $ueberschriften ) der Umfrage
    for ($i = 1; $i <= count($ueberschriften); $i++) {
        // Alle Fragen eines Blocks
        $sql1 = "SELECT * FROM Fragen WHERE Ausgewaehlt = '1' AND Block = $i;";
        //echo "#" . $sql1 . "<br>";  // Kontrollausgabe
        $result1 = $mysqli->query($sql1);
        if ($result1->num_rows >= 1) // es gibt Fragen in diesem Block
        {
            // Beginn mehrzeilige HTML-Ausgabe
            echo '
              <tr>
                <td colspan="8">&nbsp;</td>
              </tr>
              <tr>
              	<td colspan="8"><h3 align="center">' . $ueberschriften[$i] . '</h3></td>
	            </tr>
	            <tr>
	              <td width="314" bgcolor="#333333" class="Tabellenueberschrift"><span class="Tabellenueberschrift">Frage</span></td>
	              <td width="62" bgcolor="#333333" class="Tabellenueberschrift">&nbsp;</td>
	              <td width="23" bgcolor="#333333" class="Tabellenueberschrift"><span class="Tabellenueberschrift">
	                <div align="center" class="Tabellenueberschrift">++</div>
	                </span></td>
	              <td width="23" bgcolor="#333333" class="Tabellenueberschrift"><span class="Tabellenueberschrift">
	                <div align="center">+</div>
	                </span></td>
	              <td width="23" bgcolor="#333333" class="Tabellenueberschrift"><span class="Tabellenueberschrift">
	                <div align="center">0</div>
	                </span></td>
	              <td width="24" bgcolor="#333333" class="Tabellenueberschrift"><span class="Tabellenueberschrift">
	                <div align="center">-</div>
	                </span></td>
	              <td width="24" bgcolor="#333333" class="Tabellenueberschrift"><span class="Tabellenueberschrift">
	                <div align="center">--</div>
	                </span></td>
	              <td width="88" bgcolor="#333333" class="Tabellenueberschrift">&nbsp;</td>
	            </tr>'; // echo-Ende
            // wiederhole für alle Datensätze
            for ($n = 0; $n < $result1->num_rows; $n++) {
                $row1 = $result1->fetch_assoc();
                // htmlspecialcharacters wandelt Sonderzeichen in HTML-Zeichen wegen korrekter Darstellung im Browser
                // Beginn mehrzeilige HTML-Ausgabe
                echo '
          		<tr>
	              <td width="314">' . htmlspecialchars($row1["Frage"], ENT_QUOTES) . '</td>
	              <td width="62"><div align="center">' . $row1["BL"] . '</div></td>
	              <td width="23"><div align="center">
	                  <input type="radio" name="' . $row1["ID"] . '" value="DP" id="' . $row1["ID"] . '_0">
	                </div></td>
	              <td width="23"><div align="center">
	                  <input type="radio" name="' . $row1["ID"] . '" value="P" id="' . $row1["ID"] . '_1">
	                </div></td>
	              <td width="23"><div align="center">
	                  <input type="radio" name="' . $row1["ID"] . '" value="Neut" id="' . $row1["ID"] . '_2">
	                </div></td>
	              <td width="24"><div align="center">
	                  <input type="radio" name="' . $row1["ID"] . '" value="M" id="' . $row1["ID"] . '_3">
	                </div></td>
	              <td width="24"><div align="center">
	                  <input type="radio" name="' . $row1["ID"] . '" value="DM" id="' . $row1["ID"] . '_4">
	                </div></td>
	              <td width="88"><div align="center">' . $row1["BR"] . '</div></td>
	            </tr>
	            <tr>
	              <td colspan="8"><hr width="100%"></td>
	            </tr>'; // echo-Ende
            } // for innen $n
        } // if
    } // for außen $i
    // Beginn mehrzeilige HTML-Ausgabe
    echo '
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
	                <input type="submit" name="button" id="button" value="Umfrage-Formular absenden">
	                </label></td>
	            </tr>
	          </table>
	        </form>'; // echo-Ende
} // else - Fragebogen anzeigen
?>
</td>
</tr>
</table>
</body>
</html>