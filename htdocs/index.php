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
include("Database.php");
$db = new Database();
// neue Umfrage am gleichen PC --> Browser schließen und neu starten
$session_id = session_id(); // Aktuelle Session-ID des Browsers holen
// hole alle session-Einträge dieser session-id aus der DB - dürfte eigentlich nur ein oder kein Datensatz sein
// nicht zu verwechseln mit der SessionID in Login.php !!!
$sql = "SELECT * FROM Sessions WHERE Session = '$session_id';";
$result = $db->query($sql);
// wiederhole für Datensätze dieser session-id
//while($row = mysql_fetch_assoc($result))
$login_var = false; // boolsche Variable, gibt an, ob session-id in DB bereits existiert
$ausgefuellt = 0; // Dummy-Zuweisung, damit diese Variable existiert, auch wenn es die Session-ID nicht in DB gibt
if ($result) {
    for ($i = 1; $i <= $result->num_rows; $i++)   // Schleife über alle session-id-Einträge in DB, dürfte eigentlich höchstens einer sein
    {
        $row = $result->fetch_assoc();
        $login_var = true;
        $ausgefuellt = $row["Ausgefuellt"];  // Ticket bereits verbraucht?
    }
}
// wenn die session-id noch nicht in der DB ist --> Login, sonst Fragebogen wird fortgesetzt
if ($login_var == false) {
    // hier wird im Browser zu einer anderen Seite gewechselt - vergleichbar Link aber ohne erforderlichen Klick
    header("Location: login.php"); // Senden von HTTP-Anfangsinformationen (Headern) im Rohformat
}

include "index.view.php";