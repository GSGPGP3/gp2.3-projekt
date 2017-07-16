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
## - Tickets erzeugen (Zufallsstrings) ##
## - Umfragedaten                   ##
## - Tickets in DB eintragen        ##
## - Link zum Admin-Men�            ##
######################################
session_start();
include("Database.php");
$db = new Database();

// 2 Funktionen zur Erzeugung von Zufallszahlen abh�ngig von der Systemzeit
function make_seed()
{
    list($usec, $sec) = explode(' ', microtime());
    return (float)$sec + ((float)$usec * 100000);
}

function randomString($len)
{
    // Initialisieren des Zufallszahlengenerators
    //Der String $possible enth�lt alle Zeichen, die verwendet werden sollen
    $possible = "ABCDEFGHJKLMNPRSTUVWXYZ";
    $str = "";
    while (strlen($str) < $len) {
        $str .= substr($possible, (rand() % (strlen($possible))), 1);
    }
    return $str;
}

if (!isset($_SESSION["login"]) || $_SESSION["login"] != 1)  // d�rfte eigentlich an dieser Stelle nie eintreten
{
    header("Location: login.php");
}
include "neu_3.view.php";