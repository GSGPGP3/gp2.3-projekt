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
## Auswerten der Umfrage nachdem    ##
## alle Sch�ler ein Feedback        ##
## gegeben haben                    ##
##                                  ##
######################################
session_start();
include("Database.php");
$db = new Database();
if (!isset($_SESSION["login"]) || $_SESSION["login"] != 1) {
    header("Location: loginAdmin.php");
}

include "auswertenUmfrage.view.php";