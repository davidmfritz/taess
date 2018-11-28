<?php
$id = $_GET['id'];
include "connect.php";
$sql = "SELECT * from posts;";
if (isset($id)) {
    $sql2 = "DELETE from posts WHERE PostID = " . $id;
    if (@mysql_query($sql2)) {
        if (mysql_affected_rows() == 1) {
            echo ("<p>Eintrag " . $id . " gel�scht</p>");
            echo "<meta http-equiv='refresh' content='2; URL=../?p=gb_acp'>";
        } else {
            echo ("<p><b>FEHLER beim l�schen, dieser Datensatz existiert <b>nicht: <u>" . $id . "</u></b></p>");
            echo "<meta http-equiv='refresh' content='5; URL=../?p=gb_acp'>";
        }
    } else {
        echo "Kein passender Datensatz gefunden.";
    }
}
mysql_close();
