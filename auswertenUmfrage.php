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
## Auswerten der Umfrage nachdem    ##
## alle Schüler ein Feedback        ##
## gegeben haben                    ##
##                                  ##
######################################
session_start();
include("connect.php");
if ($_SESSION["login"] != 1) {
    header("Location: loginAdmin.php");
}

include("metadaten.php");
echo '
  	<table width="100%" border="1">'; // echo-Ende
// wiederhole für alle Überschriften
for ($id = 1; $id <= count($ueberschriften); $id++) {
    // alle beantworteten Fragen aus der DB lesen
    $sql = "SELECT * FROM `Fragen` WHERE `Ausgewaehlt` = '1' AND Block = '$id' ORDER BY  ID";
    $result = $mysqli->query($sql);
    if ($result->num_rows >= 1) // falls es Fragen gibt
    {
        // Beginn mehrzeilige HTML-Ausgabe
        echo '
	      <tr>
	        <td colspan="5"><h3 align="center">' . $ueberschriften[$id] . '</h3>
	          <div align="center">Statistik vom ' . date("j.n.Y G:i:s") . '</div>
          </td>
	      </tr>
	      <tr>
	        <td colspan="5">&nbsp;</td>
	      </tr>';  // echo-Ende
        // wiederhole für alle Fragen
        for ($i = 1; $i <= $result->num_rows; $i++) {
            $row = $result->fetch_assoc();
            $BL = $row["BL"]; // Bemerkung bzw. Tendenz links/positiv
            $BR = $row["BR"]; // Bemerkung bzw. Tendenz rechts/negativ
            $DP = $row["DP"]; // Doppel-Plus
            $P = $row["P"];
            $Neut = $row["Neut"];
            $M = $row["M"];
            $DM = $row["DM"]; // Doppel-Minus
            $gesamt = $DP + $P + $Neut + $M + $DM;
            $max = max($DP, $P, $Neut, $M, $DM);
            $eins = 200 / $max;
            // Beginn mehrzeilige HTML-Ausgabe
            echo '
        <tr>
          <td width="20%" rowspan="8" align="center" valign="middle">Frage <b>' . $i . '</b>)</td>
          <td colspan="4"><b>' . $row["Frage"] . '</b></td>
        </tr>
        <tr>
          <td colspan="4"><b>' . $row["BL"] . '</b></td>
        </tr>
        <tr>
          <td width="12%"><div align="center">++</div></td>
          <td width="16%"><div align="center">' . $DP . '</div></td>
          <td width="17%"><div align="center">' . round(100 / $gesamt, 2) * $DP . '%</div></td>
          <td width="35%"><img src="blue.gif" width="' . $DP * $eins . 'px" height="10px"></td>
        </tr>
        <tr>
          <td><div align="center">+</div></td>
          <td><div align="center">' . $P . '</div></td>
          <td><div align="center">' . round(100 / $gesamt, 2) * $P . '%</div></td>
          <td><img src="blue.gif" width="' . $P * $eins . 'px" height="10px"></td>
        </tr>
        <tr>
          <td><div align="center">0</div></td>
          <td><div align="center">' . $Neut . '</div></td>
          <td><div align="center">' . round(100 / $gesamt, 2) * $Neut . '%</div></td>
          <td><img src="blue.gif" width="' . $Neut * $eins . 'px" height="10px"></td>
        </tr>
        <tr>
          <td><div align="center">-</div></td>
          <td><div align="center">' . $M . '</div></td>
          <td><div align="center">' . round(100 / $gesamt, 2) * $M . '%</div></td>
          <td><img src="blue.gif" width="' . $M * $eins . 'px" height="10px"></td>
        </tr>
        <tr>
          <td><div align="center">--</div></td>
          <td><div align="center">' . $DM . '</div></td>
          <td><div align="center">' . round(100 / $gesamt, 2) * $DM . '%</div></td>
          <td><img src="blue.gif" width="' . $DM * $eins . 'px" height="10px"></td>
        </tr>
        <tr>
          <td colspan="4"><b>' . $row["BR"] . '</b></td>
        </tr>
        <tr>
          <td colspan="5">&nbsp;</td>
        </tr>'; // echo-Ende
        } // Ende innere for-Schleife  $i
    }  // Ende if
}  // Ende äußere for-Schleife  $id
// Beginn mehrzeilige HTML-Ausgabe
echo '
	      <tr>
		      <td colspan="5">&nbsp;</td>
	      </tr>
	      <tr>
		      <td colspan="5"><h3 align="center">Kommentare</h3></td>
	      </tr>
	      <tr>
		      <td colspan="5">&nbsp;</td>
	      </tr>';  // echo-Ende
$sql = "SELECT * FROM Kommentare";
$result = $mysqli->query($sql);
// wiederhole für alle Kommentare
for ($i = 1; $i <= $result->num_rows; $i++) {
    $row = $result->fetch_assoc();
    // Beginn mehrzeilige HTML-Ausgabe
    echo '
	    <tr>
	    	<td colspan="5">' . $row["Kommentar"] . '</td>
	    </tr>
	    <tr>
	    	<td colspan="5"><hr width="100%" /></td>
	    </tr>'; // echo-Ende
}
echo '
	  </table>
	  <div align="center">&copy; Alexander Widmann</div>'; // echo-Ende
?>