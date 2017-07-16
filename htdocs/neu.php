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
## - Fragen auswählen               ##
## - Formular wird an neu2.php      ##
##   geschickt                      ##
##                                  ##
######################################
session_start();
include("Database.php.php");
$db = new Database();
if (!isset($_SESSION["login"]) || $_SESSION["login"] != 1)  // dürfte eigentlich an dieser Stelle nie eintreten
{
    header("Location: loginAdmin.php");
}

include "neu.view.php";