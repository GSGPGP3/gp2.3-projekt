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
## Admin-Logout                     ##
##                                  ##
######################################
session_start();
session_unset();
header("Location: index.php");
?>