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


}