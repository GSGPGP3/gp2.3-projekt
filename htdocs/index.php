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
session_start();
include("Database.php");
$db = new Database();
$session_id = session_id();
$result = $db->getSession($session_id);
$login_var = false;
$ausgefuellt = 0;
if ($result) {
    for ($i = 1; $i <= $result->num_rows; $i++) {
        $row = $result->fetch_assoc();
        $login_var = true;
        $ausgefuellt = $row["Ausgefuellt"];
    }
}
if ($login_var == false) {
    header("Location: login.php");
}


include "index.view.php";