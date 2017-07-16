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
## - löschen evtl. vorhandener      ##
##   Umfragedaten                   ##
## - alle in neu.php gewählten      ##
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
$sql = " TRUNCATE TABLE `Kommentare`";
@$db->query($sql);
$sql = "UPDATE Fragen SET DP = '0', P = '0',Neut = '0',M = '0',DM = '0',Ausgewaehlt = '0';";
@$db->query($sql);
$sql = " TRUNCATE TABLE `Sessions`";
@$db->query($sql);

// alle Fragen der Umfrage in DB als ausgewählt kennzeichnen
$sql = "SELECT * FROM Fragen";
$result = $db->query($sql);
if ($result) {
    for ($n = 1; $n <= $result->num_rows; $n++) {
        $row = $result->fetch_assoc();
        $id = $row["ID"];
        if ($_POST[$id] == 1) {
            $sql2 = "UPDATE Fragen SET Ausgewaehlt = '1' WHERE ID = '" . $id . "';";
            $db->query($sql2);
        }
    }
}

include "neu_2.view.php";