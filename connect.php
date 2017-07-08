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
## Verbindung zur Datenbank         ##
##                                  ##
######################################
//Admin-Passwort --> sollte mit MD5-Verschlüsselung in DB realisieren
$admin_pw = "gp23";

//MySQL-Daten für Zugang zum DB-Server
$benutzername = "root"; //Der Benutzernamen
$adresse = "localhost"; //Die IP oder Adresse
$sql_pw = "E2IT"; //Das Passwort des MySQL-DB-Servers --> sollte nicht leer sein
$datenbank = "umfrage"; //Name der Datenbank, in der die Umfrage-Tabellen sind

//Kategorien
// Fügen sie diesem Array alle gewünschten Kategorien hinzu und ändern sie falls gewünscht deren Namen.
// Kategorien werden allerdings nur angezeigt, wenn auch Fragen dafür existieren.
//$ueberschriften[1] = "Rahmenbedingungen";
//$ueberschriften[2] = "Gruppenprozesse";
//$ueberschriften[3] = "Ver&auml;nderungen";
//$ueberschriften[4] = "Module";
//$ueberschriften[5] = "Benotung";

//$ueberschriften[1] = "Planung und Inszenierung von Lernprozessen";
//$ueberschriften[2] = "Lehrkraft im Unterricht";
//$ueberschriften[3] = "Pers&ouml;nliches Empfinden";

$ueberschriften[1] = "Lernen durch Projektarbeit";
$ueberschriften[2] = "Vorbereitung im Unterricht";
$ueberschriften[3] = "Lehrkr&auml;fte im Projekt";
$ueberschriften[4] = "Transparenz der Aufgabenstellung";


//AB HIER BITTE NICHTS MEHR ÄNDERN!!!! Danke
// Verbindung zum DB-Server herstellen und DB öffnen
$mysqli = new mysqli($adresse, $benutzername, $sql_pw, $datenbank) or die ("Keine Verbindung moeglich!");
//mysql_select_db("$datenbank") or die ("Keine Datenbank vorhanden!");
$mysqli->query("SET NAMES 'utf8'"); // Wichtig - SET NAMES setzt die drei Systemvariablen character_set_client, character_set_connection und character_set_results auf den angegebenen Zeichensatz

?>