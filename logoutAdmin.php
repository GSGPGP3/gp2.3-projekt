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
## Admin-Logout                     ##
##                                  ##
######################################
	session_start();
	// Aufheben der Registrierung aller Variablen, welche in der aktuellen Session angelegt wurden
	session_unset();
	// Wechsel zu Startseite der Umfrage (Ticketabfrage oder Login)
	header("Location: index.php");
?>