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
## 1. Seite neue Umfrage            ##
## - Tickets erzeugen (Zufallsstrings) ##
## - Umfragedaten                   ##
## - Tickets in DB eintragen        ##
## - Link zum Admin-Menü            ##
######################################
session_start();
include("connect.php");

// 2 Funktionen zur Erzeugung von Zufallszahlen abhängig von der Systemzeit
function make_seed()
{
    list($usec, $sec) = explode(' ', microtime());
    return (float)$sec + ((float)$usec * 100000);
}

function randomString($len)
{
    // Initialisieren des Zufallszahlengenerators
    //Der String $possible enthält alle Zeichen, die verwendet werden sollen
    $possible = "ABCDEFGHJKLMNPRSTUVWXYZ";
    $str = "";
    while (strlen($str) < $len) {
        $str .= substr($possible, (rand() % (strlen($possible))), 1);
    }
    return $str;
}

if (!isset($_SESSION["login"]) || $_SESSION["login"] != 1)  // dürfte eigentlich an dieser Stelle nie eintreten
{
    header("Location: login.php");
}
include("metadaten.php");
// Ausgabe der Tabelle mit den Ticket-IDs und Eintrag in die DB

// Beginn mehrzeilige HTML-Ausgabe
echo '
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
	    <tr>
	      <td width="100%" height="400" align="center" valign="middle">
	        <table width="70%" border="0" cellspacing="0" cellpadding="0">
	          <tr>
	            <td height="300px" align="left" valign="top">
	              <table width="100%" border="1" cellspacing="0" cellpadding="0">
	              	<tr>';  // echo-Ende
srand(make_seed());
if (isset($_POST["Anzahl"])) {
    for ($i = 1; $i <= $_POST["Anzahl"]; $i++) {
        $ticket = randomString(7); // erzeugt 7-stellige Zufallsstring --> Ticket-ID
        // neue Ticket-ID --> neuer Datensatz in DB
        $sql = "INSERT INTO Sessions (`Session`, `TicketID`,`Ausgefuellt`) VALUES ('', '" . $ticket . "', '0');";
        $mysqli->query($sql);
        echo '
    								<td height="50px"><div align="center">' . $ticket . '</div></td>';
        // Zeilenumbruch alle 4 Ticket-IDs
        if ($i % 4 == 0) {
            // Beginn mehrzeilige HTML-Ausgabe
            echo '
      						</tr>
                  <tr>'; // echo-Ende
        }
    }
}
// Beginn mehrzeilige HTML-Ausgabe
echo '
		  						</tr>
	              </table>
	              <p>Drucken Sie diese Seite aus und verteilen Sie die Ticket-IDs an ihre Sch&uuml;ler. Diese k&ouml;nnen sich nun einloggen und die Umfrage ausf&uuml;llen.</p>
	              <p><a href="menuAdmin.php">Hier geht es zum Hauptmenu</a></p>
	              <p align="center">&copy; Alexander Widmann</p></td>
	          </tr>
	        </table>
	      </td>
	    </tr>
	  </table>
	  </body></html>'; // echo-Ende
?>