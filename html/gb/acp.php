<?php
if ($_POST['pw'] != "") {
    $_SESSION['pw'] = $_POST['pw'];
}
?>
<script language="javascript">
function DeleteCheck($id){
	var chk = window.confirm("Wollen Sie den Eintrag #"+$id+" wirklich l�schen?");
	return chk;
}
</script>
<?php
if ($_GET['logout'] == "true") {
    session_destroy();
    ?>
<meta http-equiv='refresh' content='3, ./?p=gb'>
<h2 style="margin-bottom:10px;">Guestbook AdminControlPanel</h2>
<table align="center" rules="none" border="0">
    <tr>
        <td>
            <br><br><br><br><br>
            <div class="post" style="width:260px !important; text-align: center;">
                Sie wurden erfolgreich ausgeloggt!<br>
                <a href="./?p=gb">Zur&uuml;ck zum G&auml;stebuch</a>
            </div>
        </td>
    </tr>
</table>
<?php
} else {
    include "connect.php";
    if ($_SESSION['pw'] == $acp_password) {
        echo "<h2 style='margin-bottom:10px;'>Guestbook AdminControlPanel <font color=#00ff00 size=2>(Eingeloggt)</font> <font size=2><a href=?p=gb_acp&logout=true>Ausloggen</a></font></h2>";
        $sql = "SELECT * FROM posts ORDER BY PostID DESC;";
        $ergebnis = mysql_query($sql) or die("Die Anfrage konnte nicht ausgef&uuml;hrt werden");
        $num = mysql_num_rows($ergebnis);
        while ($row = mysql_fetch_assoc($ergebnis)) {
            echo "\t<div class='post'>\n\t\t<table style='margin:4px; width:99%;'>\n\t\t\t<tr>\n\t\t\t<td>" . $row['Name'];
            if ($row['Mail'] != "") {
                echo " <a class='gb' href='mailto:" . $row['Mail'] . "'>E-mail</a>";
            }
            if ($row['Homepage'] != "" && $row['Homepage'] != "http://bloodyscythe.taess.net/gb/") {
                echo " <a class='gb' href='" . $row['Homepage'] . "' target='_blank'>Homepage</a>";
            }
            echo "</td>\n\t\t\t<td align='right'><a href=?p=gb_rmentry&id=" . $row['PostID'] . " onclick='return DeleteCheck(" . $row['PostID'] . ");'>del <b>#" . $row['PostID'] . "</b></a></td>\n\t\t\t</tr>\n\t\t\t<tr>\n\t\t\t<td style='border-top:1px #121212 solid; padding-top: 10px !important;' colspan='2'>" . nl2br(htmlspecialchars($row['Text'])) . "</td>\n\t\t\t</tr>\n\t\t</table>\n\t</div>\n";
        }
        mysql_close();
    } else {
        ?>
	</h2>
	<form action="?p=gb_acp" method="post">
		<input type="password" id="pw" name="pw">&nbsp;Passwort<br>
		<input type="submit" name="acplogin" value="Admin-ControlPanel betreten">
	</form>

	<?php
}
}
?>
