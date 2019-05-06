<?php
$id = $_GET['id'];
include "connect.php";
$sql = "SELECT * from posts;";
if (isset($id)) {
    $sql2 = "DELETE from posts WHERE PostID = " . $id;
    if (@mysql_query($sql2)) {
        if (mysql_affected_rows() == 1) {
            $fw_delay = 2;
            echo "<p>Eintrag " . $id . " gelöscht</p>";
            echo "Sie werden in $fw_delay Sekunden automatisch weitergeleitet. <a href='../?p=gb_acp'>Zurück zum ACP</a>";
            echo "<meta http-equiv='refresh' content='$fw_delay; URL=../?p=gb_acp'>";
        } else {
            $fw_delay = 5;
            echo ("<p><b>FEHLER beim löschen, dieser Datensatz existiert <b>nicht: <u>" . $id . "</u></b></p>");
            echo "Sie werden in $fw_delay Sekunden automatisch weitergeleitet. <a href='../?p=gb_acp'>Zurück zum ACP</a>";
            echo "<meta http-equiv='refresh' content='$fw_delay; URL=../?p=gb_acp'>";
        }
    } else {
        echo "Kein passender Datensatz gefunden.";
    }
}
mysql_close();
