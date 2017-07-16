<?php
/**
 * Created by PhpStorm.
 * User: kkurz
 * Date: 7/16/17
 * Time: 9:35 PM
 */


include("metadaten.php");
?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="100%" height="400" align="center" valign="middle">
                <form id="AdminLoginFormular" method="get" action="loginAdmin.php?do=1">
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
                            <td><label><input type="password" name="Passwort" id="textfield"/></label></td>
                        </tr>
                        <tr>
                            <td colspan="2" bgcolor="#FF0000">
                                <?php
                                if ($passwort_ok == false) {
                                    echo 'Das angegebene Passowort ist falsch';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><label>
                                    <input type="submit" name="button" id="button" value="Senden"/>
                                </label></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div align="center">&copy; Alexander Widmann</div>
                            </td>
                        </tr>
                    </table>
                </form>
            </td>
        </tr>
    </table>
    </body>
    </html>
<?php
include "tail.php";
