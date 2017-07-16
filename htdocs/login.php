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

if (isset($_GET['do'])) // prüft, ob die Array-Variable $_GET existiert, also ob das Login-Formular bereits aufgerufen wurde
{
    //Formular wurde bereits gesendet
    //
    // Suche nach dem Datensatz mit der angegebenen Ticket-ID
    $ticketID = $_POST["ticketID"];  // Umfrage-Ticket-ID vom Formular
    $sql = "SELECT * FROM Sessions WHERE TicketID = '" . $ticketID . "';";
    //echo "#" . $sql . "<br>";  // Kontrollausgabe
    $result = $db->query($sql);
    if ($result != NULL) // Ticket-ID gibt es nicht
    {
        echo 'Anzahl Tickets mit dieser ID: ' . $result->num_rows . '<br>';
        $row = $result->fetch_assoc();
        //while($row = mysql_fetch_assoc($result)){
        $ausgefuellt = $row["Ausgefuellt"];
        if ($ausgefuellt == false) // Ticket ist noch nicht verbraucht -> false
        {
            //Login erfolgreich - Ticket wird mit Session-ID verknüpft und verbraucht --> Eintrag in DB
            $session_id = session_id(); // ?
            $sql = "UPDATE Sessions SET Session = '" . $session_id . "' WHERE ticketID = '" . $ticketID . "';";
            //echo "#" . $sql . "<br>";  // Kontrollausgabe
            $db->query($sql);
            // hier wird im Browser zu einer anderen Seite gewechselt - vergleichbar Link aber ohne erforderlichen Klick
            header("Location: index.php");
        }
    }
}


include "login.view.php";