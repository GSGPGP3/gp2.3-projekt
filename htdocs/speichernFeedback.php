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
## Speichern des Feedback           ##
## eines Sch�lers in der DB         ##
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
        $ausgefuellt = $row["Ausgefuellt"]; // ist der Fragebogen f�r diese session schon ausgef�llt?
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

    $db->updateSessionAusgef�llt($session_id);


    $db->insertKommentar($_POST["Kommentar"]);
}
header("Location: index.php");
?>