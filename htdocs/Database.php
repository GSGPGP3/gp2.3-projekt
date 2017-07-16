<?php

/**
 * Created by PhpStorm.
 * User: kkurz
 * Date: 7/9/17
 * Time: 10:10 AM
 */
class Database
{
    public static $admin_pw = "gp23";
    public static $ueberschriften = array(
        "Lernen durch Projektarbeit",
        "Vorbereitung im Unterricht",
        "Lehrkr&auml;fte im Projekt",
        "Transparenz der Aufgabenstellung"
    );

    private $mysqli;


    /*
    * Database constructor.
    */
    public function __construct()
    {

        $this->mysqli = new mysqli("localhost", "root", "E2IT", "umfrage");

        $this->mysqli->query("SET NAMES 'utf8'");
        // Wichtig - SET NAMES setzt die drei Systemvariablen character_set_client, character_set_connection und
        // character_set_results auf den angegebenen Zeichensatz

    }

    public function query($query)
    {
        return $this->mysqli->query($query);
    }


    public function loescheUmfrage()
    {
        // Der SQL-Befehl TRUNCATE leert eine Tabelle, d.h. alle Datens�tze werden gel�scht
        // Kommentare l�schen
        $sql = " TRUNCATE TABLE `Kommentare`";
        @$this->mysqli->query($sql);
        // Anzahl der Tendenzen auf 0 zurücksetzen
        $sql = "UPDATE Fragen SET DP = '0', P = '0',Neut = '0',M = '0',DM = '0',Ausgewaehlt = '0';";
        @$this->mysqli->query($sql);
        // Sessions und Ticket-IDs löschen
        $sql = " TRUNCATE TABLE `Sessions`";
        @$this->mysqli->query($sql);
    }

    public function getAusgewaehlteFragen($id) //TODO testen
    {
        $block = "";
        if (isset($id)) $block = "AND Block = '$id'";

        $sql = "SELECT * FROM `Fragen` WHERE `Ausgewaehlt` = '1' $block ORDER BY  ID";
        return $this->query($sql);
    }

    public function getKommentare()
    {
        $sql = "SELECT * FROM Kommentare";
        return $this->query($sql);
    }

    public function getSession($session_id)
    {
        $sql = "SELECT * FROM Sessions WHERE Session = '$session_id';";
        return $this->query($sql); //TODO nur eine Session zurückgeben
    }

    public function isValidTicket($ticketID)
    {
        $sql = "SELECT * FROM Sessions WHERE TicketID = '" . $ticketID . "';";
        return $this->query($sql); //TODO nur eine Session zurückgeben
    }

    public function updateSession($session_id, $ticketID)
    {
        $sql = "UPDATE Sessions SET Session = '" . $session_id . "' WHERE ticketID = '" . $ticketID . "';";
        $this->query($sql);
    }

    public function getFragenInBlock($i)
    {
        $sql = "SELECT * FROM Fragen WHERE Block = '" . $i . "' ORDER BY ID;";
        return $this->query($sql);
    }

    public function updateFrageAuswaehlen($id)
    {
        $sql = "UPDATE Fragen SET Ausgewaehlt = '1' WHERE ID = '" . $id . "';";
        $this->query($sql);
    }

    public function neueUmfrage()
    {
        $sql = " TRUNCATE TABLE `Kommentare`";
        @$this->query($sql);
        $sql = "UPDATE Fragen SET DP = '0', P = '0',Neut = '0',M = '0',DM = '0',Ausgewaehlt = '0';";
        @$this->query($sql);
        $sql = " TRUNCATE TABLE `Sessions`";
        @$this->query($sql);
    }

    public function getFragen()
    {
        $sql = "SELECT * FROM Fragen";
        return $this->query($sql);
    }

    public function insertSession($ticket)
    {
        $sql = "INSERT INTO Sessions (`Session`, `TicketID`,`Ausgefuellt`) VALUES ('', '" . $ticket . "', '0');";
        $this->query($sql);
    }

    public function updateFrageA($id, $a)
    {
        $sql = "UPDATE Fragen SET  $a = $a + 1 WHERE ID = $id;"; //TODO wass soll das machen
        $this->query($sql);
    }

    public function updateSessionAusgefüllt($session_id)
    {
        $sql = "UPDATE Sessions SET Ausgefuellt = 1 WHERE Session = '$session_id';";


    }

    public function insertKommentar($kommentar)
    {
        $sql = "INSERT INTO Kommentare (`ID`, `Kommentar`) VALUES ('', '$kommentar');";
        $this->query($sql);
    }

}