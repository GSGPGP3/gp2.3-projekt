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
## 1. Seite neue Umfrage            ##
## - Fragen ausw�hlen               ##
## - Formular wird an neu2.php      ##
##   geschickt                      ##
##                                  ##
######################################
session_start();
include("Database.php.php");
$db = new Database();
if (!isset($_SESSION["login"]) || $_SESSION["login"] != 1)  // d�rfte eigentlich an dieser Stelle nie eintreten
{
    header("Location: loginAdmin.php");
}

include "neu.view.php";