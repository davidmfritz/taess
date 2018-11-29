<?php
$name = $_POST['name'];
$mail = $_POST['mail'];
$nachricht = $_POST['nachricht'];
$kopie = @$_POST['kopie'] ? "ja" : "nein";

/*Hier werden alle Daten eingegeben*/
/*An wen soll die Anfrage gerichtet sein?*/
$webmaster = "bloodyscythe@live.at";

/*Welche E-Mail-Adresse soll als Absender eingegeben werden?*/
$absender = "bloodyscythe@taess.net";

/*Wie soll die Mail aussehen, die an den webmaster gerichtet ist? Formularfelder werden wie folgt eingef�gt "$NameDesFeldes"*/
/*Betreff*/$betreffwebmaster = "Kontaktformular";
/*Textk�rper*/$koerperwebmaster = "$name ($mail) hat ueber die Webseite folgende Nachricht hinterlassen:
		$nachricht";

/*wie soll die Mail aussehen, die an den Absender gerichtet ist?*/
/*Betreff*/$betreffabsender = "Vielen Dank fuer deine Nachricht / Thanks for your message";
/*Textk�rper*/$koerperabsender = "Herzlichen Dank fuer Deine Nachricht / Thanks a lot for your message \n Du hast folgende Nachricht versendet / You have been sent following message:\n $nachricht\n";

/*Welche Fehlermeldung soll ausgegeben werden, wenn die E-Mail-Adresse falsch eingegeben wurde? Bitte mit HTML-Tags arbeiten,
es k�nnen auch Klassen f�r CSS zugewiesen werden*/
$mailfalsch = "<small>Fehler<br>Leider ist die E-Mail-Adresse falsch<br>Bitte kontrolliere noch einmal die Eingabe und sende das Formular erneut ab.<br><br>Error<br>Your e-mail-adress isn't valid<br>Please re-check your input and send the form again.</small>";

/*Welche Fehlermeldung soll ausgegeben werden, wenn nicht alle Pflicht-Felder ausgef�llt sind?*/
$felderleer = "<small>Fehler<br>Die Nachricht konnte nicht versendet werden, da nicht alle Felder ausgef&uuml;llt wurden.<br><br>Error<br>The message wasn't sent because you didn't fill in all fields.</small>";

/*Wie soll der Text aussehen, wenn die E-Mail versendet wurde?*/
$gesendet = "<small>Danke,<br>die Nachricht wurde versendet und ich werde mich evtl. noch einmal melden.<br><br>Thanks,<br>the message has been sent and maybe I will contact you.</small>";

/*Sind alle Felder ausgef�llt? f�r jedes Feld das ausgef�llt sein mu�, mu� hier ein entsprechender Eintrag gemacht werden*/
if ($name == "" || $mail == "" || $nachricht == "")
/*##############################################################################
#Bitte ab hier nichts mehr �ndern. Alle Angaben sind im oberen Teil zu machen#
##############################################################################*/
{
    /*nein*/
    echo "<a href='javascript:history.back();'>Zur&uuml;ck / Back</a><br /><br />$felderleer";
} else {
    /*ja*/
    /*Ist die E-Mail-Adresse richtig eingegeben?*/
    if (preg_match("^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,4})$^", $mail)) {
        /*E-Mail-Adresse ist richtig*/
        mail("$webmaster", "$betreffwebmaster", "$koerperwebmaster\n", "FROM: $absender\n");

        /*Soll der Absender eine Kopie erhalten?*/
        if ($kopie == "ja") {
            mail("$mail", "$betreffabsender", "$koerperabsender", "FROM: $absender\n");
            echo "$gesendet";
        } else {
            echo "$gesendet";
        }
    } else {
        /*nein*/
        echo "<a href='javascript:history.back();'>Zur&uuml;ck / Back</a><br /><br />$mailfalsch";
    }
}
