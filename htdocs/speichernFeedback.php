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
$sql = "SELECT * FROM Sessions WHERE Session = '$session_id';";
$result = $db->query($sql);
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


if (isset($ausgefuellt) && !$ausgefuellt) { // falls Fragebogen f�r diese Session noch nicht ausgef�llt
    $sql = "SELECT * FROM Fragen WHERE Ausgewaehlt = '1';";
    //echo "#" . $sql . "<br>";  // Kontrollausgabe
    $result = $db->query($sql);
    // Schleife �ber alle Fragen; z�hlt in der DB die entsprechenden Werte je um 1 hoch
    for ($i = 0; $i < $result->num_rows; $i++) {
        $row = $result->fetch_assoc();
        $id = $row["ID"];
        $a = $_POST[$id];
        $sql2 = "UPDATE Fragen SET  $a = $a + 1 WHERE ID = $id;";
        //echo "#" . $sql2 . "<br>";  // Kontrollausgabe
        $db->query($sql2);
        $session_id = session_id();
    }
    // Umfrage f�r diese Session als beendet bzw. ausgef�llt eintragen
    $sql3 = "UPDATE Sessions SET Ausgefuellt = 1 WHERE Session = '$session_id';";
    //echo "#" . $sql3 . "<br>";  // Kontrollausgabe
    $db->query($sql3);
    // Kommentar in DB eintragen
    $kommentar = $_POST["Kommentar"];
    $sql4 = "INSERT INTO Kommentare (`ID`, `Kommentar`) VALUES ('', '$kommentar');";
    //echo "#" . $sql4 . "<br>";  // Kontrollausgabe
    $db->query($sql4);
}
// erneuter Aufruf der index.php
header("Location: index.php");
?>