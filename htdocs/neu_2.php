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
## - l�schen evtl. vorhandener      ##
##   Umfragedaten                   ##
## - alle in neu.php gew�hlten      ##
##   Fragen in DB markieren         ##
## - Abfrage Anzahl Tickets         ##
## - Formualr wird an neu3.php      ##
##   geschickt                      ##
##                                  ##
######################################
session_start();
include("Database.php");
$db = new Database();
if (!isset($_SESSION["login"]) || $_SESSION["login"] != 1) {
    header("Location: loginAdmin.php");
}

@$db->neueUmfrage();

// alle Fragen der Umfrage in DB als ausgew�hlt kennzeichnen

$result = $db->getFragen();
if ($result) {
    for ($n = 1; $n <= $result->num_rows; $n++) {
        $row = $result->fetch_assoc();
        $id = $row["ID"];
        if ($_POST[$id] == 1) {

            $db->updateFrageAuswaehlen($id);
        }
    }
}

include "neu_2.view.php";