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
## Verbindung zur Datenbank         ##
##                                  ##
######################################
//Admin-Passwort --> sollte mit MD5-Verschl�sselung in DB realisieren
$admin_pw = "gp23";

//MySQL-Daten f�r Zugang zum DB-Server
$benutzername = "root"; //Der Benutzernamen
$adresse = "localhost"; //Die IP oder Adresse
$sql_pw = "E2IT"; //Das Passwort des MySQL-DB-Servers --> sollte nicht leer sein
$datenbank = "umfrage"; //Name der Datenbank, in der die Umfrage-Tabellen sind

//Kategorien
// F�gen sie diesem Array alle gew�nschten Kategorien hinzu und �ndern sie falls gew�nscht deren Namen.
// Kategorien werden allerdings nur angezeigt, wenn auch Fragen daf�r existieren.
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


//AB HIER BITTE NICHTS MEHR �NDERN!!!! Danke
// Verbindung zum DB-Server herstellen und DB �ffnen
$mysqli = new mysqli($adresse, $benutzername, $sql_pw, $datenbank) or die ("Keine Verbindung moeglich!");
//mysql_select_db("$datenbank") or die ("Keine Datenbank vorhanden!");
$mysqli->query("SET NAMES 'utf8'"); // Wichtig - SET NAMES setzt die drei Systemvariablen character_set_client, character_set_connection und character_set_results auf den angegebenen Zeichensatz

?>