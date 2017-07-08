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
## - Fragen auswählen               ##
## - Formular wird an neu2.php      ##
##   geschickt                      ##
##                                  ##
######################################
	session_start();
	include("connect.php");
	if($_SESSION["login"] != 1)  // dürfte eigentlich an dieser Stelle nie eintreten
	{
	  header("Location: loginAdmin.php");
	}

	include("metadaten.php");
  // Formular zum Aufruf von neu_2.php
	// Beginn mehrzeilige HTML-Ausgabe
	echo '
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
	  	<tr>
	    	<td width="100%" height="400" align="center" valign="middle">
	      	<form action="neu_2.php" method="post">
	        	<table width="70%" border="0" cellspacing="0" cellpadding="0">
	          	<tr>
	            	<td height="300px" align="left" valign="top">
	                <h3>Einrichtungsassistent:</h3>
	                <p>Bitte w&auml;hlen Sie aus den aufgef&uuml;hrten Fragen diejenigen aus, die Sie in Ihrer Umfrage haben m&ouml;chten.</p>'; // echo-Ende
  // wiederhole für alle Überschriften/Kategorien
  for($i=1; $i <= count($ueberschriften); $i++)
  {
    $sql = "SELECT * FROM Fragen WHERE Block = '" . $i . "' ORDER BY ID;";
    $result = mysql_query($sql);
    echo '				<h4>' . $ueberschriften[$i] . '</h4>';
    // wiederhole für alle Datensätze/Zeilen
    for ($n=1; $n <= mysql_num_rows($result); $n++)
    {
      $row = mysql_fetch_assoc($result);
      echo '			<input name="' . $row["ID"] . '" type="checkbox" value="1" checked> &nbsp;';
      echo 				$row["Frage"] . '<br>';
    }
  }
	// Beginn mehrzeilige HTML-Ausgabe
  echo '
	                <p><input name="" type="submit" value="Senden"></p>
	                <p align="center">&copy; Alexander Widmann</p>
	              </td>
	            </tr>
	          </table>
	        </form>
	      </td>
	    </tr>
	  </table>
	</body>
	</html>'; // echo-Ende