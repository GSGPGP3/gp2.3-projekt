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
## Startseite                       ##
## - Abfrage Ticket-ID              ##
## - Link zum Lehrer-Login          ##
##                                  ##
######################################
session_start();
include("Database.php");
$db = new Database();
$ausgefuellt = false;

if (isset($_GET['do']))
{
    $ticketID = $_POST["ticketID"];

    $result = $db->isValidTicket($ticketID);
    if ($result)
    {
        echo 'Anzahl Tickets mit dieser ID: ' . $result->num_rows . '<br>';
        $row = $result->fetch_assoc();
        $ausgefuellt = $row["Ausgefuellt"];
        if (!$ausgefuellt)
        {
            $db->updateSession(session_id(), $ticketID);
            header("Location: index.php");
        }
    }
}


include "login.view.php";