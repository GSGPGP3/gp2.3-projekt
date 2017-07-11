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
$ausgefuellt = false;  // false
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
/*   Kontrollausgabe
else
{
  echo "Erstanzeige Login-Formular<br>";
}
*/
include("metadaten.php");   // Kopf, style, usw.
//Login-Formular: beim Senden mit Method "post" (php-Variable $_POST) wird do=1 (php-Variable $_GET) angehängt -> s.o.
//                Das Formular ruft sich selbst auf
// Beginn mehrzeilige HTML-Ausgabe
echo '
		<div align="center">
	    <br><br>
	    <h1>Online-Umfrage: Sch&uuml;ler - Lehrer - Feedback</h1><br>
	    <br><br>
	    <form id="StudentLoginFormular" method="post" action="login.php?do=1">
	      Umfrage-Ticket-ID <input type="text" name="ticketID" id="ticket" size="30"  /><br>'; // echo-Ende
if ($ausgefuellt) // == true
{
    echo "Die angegebene Session-ID wurde bereits verwendet";
}
/*
else
{
  echo "";
}
*/
// Beginn mehrzeilige HTML-Ausgabe
?>
<br>
<input type="submit" id="butSenden" value="Ticket-ID senden"/>
<br><br>
<a href="loginAdmin.php">Zum Lehrer-Login</a>
</form>
</div>
</body>
</html>