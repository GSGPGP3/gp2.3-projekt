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
## Umfragedaten aus DB löschen      ##
##                                  ##
######################################
	include("connect.php");
	// Der SQL-Befehl TRUNCATE leert eine Tabelle, d.h. alle Datensätze werden gelöscht
	// Kommentare löschen
	$sql = " TRUNCATE TABLE `Kommentare`";
	@mysql_query($sql);
	// Anzahl der Tendenzen auf 0 zurücksetzen
	$sql = "UPDATE Fragen SET DP = '0', P = '0',Neut = '0',M = '0',DM = '0',Ausgewaehlt = '0';";
	@mysql_query($sql);
	// Sessions und Ticket-IDs löschen
	$sql = " TRUNCATE TABLE `Sessions`";
	@mysql_query($sql);
  // Wechsel zu Admin-Menü
	header("Location: menuAdmin.php");
?>