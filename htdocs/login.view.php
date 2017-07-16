<?php
/**
 * Created by PhpStorm.
 * User: kkurz
 * Date: 7/16/17
 * Time: 9:32 PM
 */


include("metadaten.php");

?>
    <div align="center">
        <br><br>
        <h1>Online-Umfrage: Sch&uuml;ler - Lehrer - Feedback</h1><br>
        <br><br>
        <form id="StudentLoginFormular" method="post" action="login.php?do=1">
            Umfrage-Ticket-ID <input type="text" name="ticketID" id="ticket" size="30"/><br>
            <?php
            if ($ausgefuellt) {
                ?>Die angegebene Session-ID wurde bereits verwendet<?php
            }
            ?>
            <br>
            <input type="submit" id="butSenden" value="Ticket-ID senden"/>
            <br><br>
            <a href="loginAdmin.php">Zum Lehrer-Login</a>
        </form>
    </div>

<?php
include "tail.php";