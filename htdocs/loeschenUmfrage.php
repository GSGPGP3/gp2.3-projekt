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
include("Database.php");
$db = new Database();
$db->loescheUmfrage();

// Wechsel zu Admin-Men�
header("Location: menuAdmin.php");
?>