<?php
######################################
## Copyright 2008 Alexander Widmann ##
## �berarbeitet 2013 Reinhard Nickl ##
## - Optimierung der Struktur       ##
## - Erg�nzung von Kommentaren      ##
##                                  ##
## Dieser Hinweis darf nicht        ##
## entfernt werden!!                ##
## -->www.alexander-projects.de     ##
## -->alex.widmann@gmail.com        ##
##                                  ##
## Umfragedaten aus DB l�schen      ##
##                                  ##
######################################
include("connect.php");
// Der SQL-Befehl TRUNCATE leert eine Tabelle, d.h. alle Datens�tze werden gel�scht
// Kommentare l�schen
$sql = " TRUNCATE TABLE `Kommentare`";
@$mysqli->query($sql);
// Anzahl der Tendenzen auf 0 zur�cksetzen
$sql = "UPDATE Fragen SET DP = '0', P = '0',Neut = '0',M = '0',DM = '0',Ausgewaehlt = '0';";
@$mysqli->query($sql);
// Sessions und Ticket-IDs l�schen
$sql = " TRUNCATE TABLE `Sessions`";
@$mysqli->query($sql);
// Wechsel zu Admin-Men�
header("Location: menuAdmin.php");
?>