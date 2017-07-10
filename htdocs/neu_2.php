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
## - löschen evtl. vorhandener      ##
##   Umfragedaten                   ##
## - alle in neu.php gewählten      ##
##   Fragen in DB markieren         ##
## - Abfrage Anzahl Tickets         ##
## - Formualr wird an neu3.php      ##
##   geschickt                      ##
##                                  ##
######################################
session_start();
include("connect.php");
if (!isset($_SESSION["login"]) || $_SESSION["login"] != 1)  // dürfte eigentlich an dieser Stelle nie eintreten
{
    header("Location: loginAdmin.php");
}
//von Formular in neu.php gesendet
// Datensätze einer evtl. vorhandenen, zuvor durchgeführten Umfrage löschen
$sql = " TRUNCATE TABLE `Kommentare`";
@$mysqli->query($sql);
$sql = "UPDATE Fragen SET DP = '0', P = '0',Neut = '0',M = '0',DM = '0',Ausgewaehlt = '0';";
@$mysqli->query($sql);
$sql = " TRUNCATE TABLE `Sessions`";
@$mysqli->query($sql);

// alle Fragen der Umfrage in DB als ausgewählt kennzeichnen
$sql = "SELECT * FROM Fragen";
$result = $mysqli->query($sql);
if ($result) {
    for ($n = 1; $n <= $result->num_rows; $n++) {
        $row = $result->fetch_assoc();
        $id = $row["ID"];
        if ($_POST[$id] == 1) {
            $sql2 = "UPDATE Fragen SET Ausgewaehlt = '1' WHERE ID = '" . $id . "';";
            $mysqli->query($sql2);
        }
    }
}

// Ende Verarbeitung
include("metadaten.php");
// Formular zum Aufruf von neu_3.php
// Beginn mehrzeilige HTML-Ausgabe
echo '
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
	    <tr>
	      <td width="100%" height="400" align="center" valign="middle">
	        <form action="neu_3.php" method="post">
	          <table width="70%" border="0" cellspacing="0" cellpadding="0">
	            <tr>
	              <td height="300px" align="left" valign="top">
                	<h3>Einrichtungsassistent:</h3>
	                <p>Die Fragen wurden erfolgreich ausgew&auml;hlt. Nun m&uuml;ssen Sie nur noch ausw&auml;hlen, wie viele Sch&uuml;ler die Umfrage machen sollen:</p>
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
	                W&auml;hlen Sie die Anzahl der Sch&uuml;ler und runden Sie gegebenenfalls auf.</p>
	                <p>Beispiel: 26 Sch&uuml;ler sollen die Umfrage machen: w&auml;hlen Sie 30</p>
	                <p>Klicken Sie danach auf <strong>Senden</strong> und drucken Sie die nachfolgende Seite, die die Sessions f&uuml;r Ihre Sch&uuml;ler enth&auml;lt, aus.</p>
	                <p><input type="submit" name="button" id="button" value="Senden"></p>
	              <p align="center">&copy; Alexander Widmann</p></td>
	            </tr>
	          </table>
	        </form>
	      </td>
	    </tr>
	  </table>
	  </body></html>'; // echo-Ende
?>