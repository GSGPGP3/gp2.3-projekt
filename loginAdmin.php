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
## Admin-Login                      ##
##                                  ##
######################################
session_start();
include("connect.php");
$passwort_ok = true;
if (isset($_GET['do'])) // prüft, ob die Array-Variable $_GET existiert, also ob das Login-Formular bereits aufgerufen wurde
{
    if ($_POST["Passwort"] == $admin_pw) {  // PW ok
        $_SESSION["login"] = 1;
        // Wechsel zu Admin-Menü
        header("Location: menuAdmin.php");
    } else { // falsches PW
        $_SESSION["login"] = 0;
        $passwort_ok = false;
    }
}
include("metadaten.php");
// Beginn mehrzeilige HTML-Ausgabe
echo '
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
	    <tr>
	      <td width="100%" height="400" align="center" valign="middle">
	      	<form id="AdminLoginFormular" method="post" action="loginAdmin.php?do=1">
	        	<table width="40%" border="0" cellspacing="0" cellpadding="0">
	            <tr>
	              <td colspan="2" bgcolor="#333333" class="Tabellenueberschrift">&gt;&nbsp;&nbsp;Login</td>
	            </tr>
	            <tr>
	              <td width="32%">&nbsp;</td>
	              <td width="68%">&nbsp;</td>
	            </tr>
	            <tr>
	              <td>Passwort</td>
	              <td><label><input type="password" name="Passwort" id="textfield" /></label></td>
	            </tr>
	            <tr>
	              <td colspan="2" bgcolor="#FF0000">'; // echo-Ende
if ($passwort_ok == false) {
    echo 'Das angegebene Passowort ist falsch';
}
// Beginn mehrzeilige HTML-Ausgabe
echo '
	              </td>
	            </tr>
	            <tr>
	              <td colspan="2"><label>
	                <input type="submit" name="button" id="button" value="Senden" />
	              </label></td>
	              </tr>
	            <tr>
	              <td colspan="2"><div align="center">&copy; Alexander Widmann</div></td>
	          	</tr>
	         	</table>
	      	</form>
       	</td>
	    </tr>
	  </table>
	  </body>
	  </html>'; // echo-Ende
?>