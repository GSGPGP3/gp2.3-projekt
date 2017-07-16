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
## Admin-Login                      ##
##                                  ##
######################################
session_start();
include("Database.php");
$db = new Database();
$passwort_ok = true;
if (isset($_GET['do'])) {

    if ($_POST["Passwort"] == $db::$admin_pw) {  // TODO besseren platz für admin_pw
        $_SESSION["login"] = 1;
        header("Location: menuAdmin.php");
    } else {
        $_SESSION["login"] = 0;
        $passwort_ok = false;
    }
}

include "loginAdmin.view.php";