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
## Speichern des Feedback           ##
## eines Schülers in der DB         ##
##                                  ##
######################################
session_start();
include("Database.php");
$db = new Database();
$session_id = session_id();

$result = $db->getSession($session_id);
$login_var = false;
if ($result) {
    for ($i = 0; $i < $result->num_rows; $i++) {
        $row = $result->fetch_assoc();
        $login_var = true;
        $ausgefuellt = $row["Ausgefuellt"]; // ist der Fragebogen für diese session schon ausgefüllt?
    }
}
// falls Session noch nicht gespeichert --> Login
if ($login_var == false) {
    header("Location: login.php");
}


if (isset($ausgefuellt) && !$ausgefuellt) {


    $result = $db->getAusgewaehlteFragen();
    for ($i = 0; $i < $result->num_rows; $i++) {
        $row = $result->fetch_assoc();
        $id = $row["ID"];
        $a = $_POST[$id];


        $db->updateFrageA($id,$a);
        $session_id = session_id();
    }

    $db->updateSessionAusgefüllt($session_id);


    $db->insertKommentar($_POST["Kommentar"]);
}
header("Location: index.php");
?>