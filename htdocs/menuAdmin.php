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
## Admin-Men� zum Verwalten von     ##
## Umfragen                         ##
## - neue Umfrage erstellen         ##
## - Umfrage auswerten              ##
## - Umfrage l�schen                ##
## - Logout                         ##
######################################
session_start();
if (!isset($_SESSION["login"]) || $_SESSION["login"] != 1) {
    header("Location: loginAdmin.php");
}
include "menuAdmin.view.php";