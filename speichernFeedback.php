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
	include("connect.php");
	$session_id = session_id();
	$sql = "SELECT * FROM Sessions WHERE Session = '$session_id';";
	$result = mysql_query($sql);
	$login_var = false;
	for($i=0; $i<mysql_num_rows($result); $i++)
	{
	  $row = mysql_fetch_assoc($result);
	  $login_var = true;
	  $ausgefuellt = $row["Ausgefuellt"]; // ist der Fragebogen f�r diese session schon ausgef�llt?
	}
	// falls Session noch nicht gespeichert --> Login
	if($login_var == false)
	{
	  header("Location: login.php");
	}


	if ($ausgefuellt == false)
	{ // falls Fragebogen f�r diese Session noch nicht ausgef�llt
	  $sql = "SELECT * FROM Fragen WHERE Ausgewaehlt = '1';";
	  //echo "#" . $sql . "<br>";  // Kontrollausgabe
	  $result = mysql_query($sql);
	  // Schleife �ber alle Fragen; z�hlt in der DB die entsprechenden Werte je um 1 hoch
	  for($i=0; $i<mysql_num_rows($result); $i++)
	  {
	    $row = mysql_fetch_assoc($result);
	    $id = $row["ID"];
	    $a = $_POST[$id];
	    $sql2 = "UPDATE Fragen SET  $a = $a + 1 WHERE ID = $id;";
		  //echo "#" . $sql2 . "<br>";  // Kontrollausgabe
	    mysql_query($sql2);
	    $session_id = session_id();
	  }
	  // Umfrage f�r diese Session als beendet bzw. ausgef�llt eintragen
	  $sql3 = "UPDATE Sessions SET Ausgefuellt = 1 WHERE Session = '$session_id';";
	  //echo "#" . $sql3 . "<br>";  // Kontrollausgabe
	  mysql_query($sql3);
	  // Kommentar in DB eintragen
	  $kommentar = $_POST["Kommentar"];
	  $sql4 = "INSERT INTO Kommentare (`ID`, `Kommentar`) VALUES ('', '$kommentar');";
	  //echo "#" . $sql4 . "<br>";  // Kontrollausgabe
	  mysql_query($sql4);
	}
  // erneuter Aufruf der index.php
  header("Location: index.php");
?>