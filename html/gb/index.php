<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script type="text/javascript">
function ResetCheck() {
  var chk = window.confirm("Wollen Sie wirklich alle Eingaben löschen?");
  return (chk);
}
function CheckInput() {
	if (document.getElementById("name").value == "") {
		alert("Bitte einen Namen angeben!");
		document.getElementById("name").focus();
		return false;
	}
	if (document.getElementById("msg").value == "") {
		alert("Es gibt keine Nachricht zum Übermitteln!");
		document.getElementById("msg").focus();
		return false;
	}
	if(document.forms[0].getElementById("msg").value.length>1000){
		alert("Ihre eingegebene Nachricht ist zu lang. Bitte kürzen Sie diese auf maximal 1000 Zeichen. Danke.");
		return false;
	}
	return true;
}
function charLength() {
	var $length=1000-document.getElementById("msg").value.length;
	document.getElementById("chars_left").value=$length;
	if(document.getElementById("chars_left").value<0){
		document.getElementById("chars_left").style.color = "#f00";
		document.getElementById("chars_left").style.fontWeight = "bold";
	}else{
		document.getElementById("chars_left").style.color = "#444444";
		document.getElementById("chars_left").style.fontWeight = "normal";
	}
	return true;
}
</script>
<form name="eintag_erstellen" value="eintrag_erstellen" action="?p=gb" method="post" onreset="return ResetCheck();" onsubmit="return CheckInput();">
	<fieldset><legend>G&auml;stebucheintrag erstellen</legend>
		<table id="gb_entry">
			<tr>
				<td>Name: *</td>
				<td>E-mail Adresse:</td>
				<td>Homepage:</td>
				<td align="center"><a href="?p=gb_acp" style="color:#888888; text-decoration:none;">AdminCP</a></td>
			</tr>
			<tr>
				<td><input id="name" name="name" type="text" value=""></td>
				<td><input id="mail" name="mail" type="text" value=""></td>
				<td><input id="hp" name="hp" type="text" value=""></td>
				<td style="line-height:16px;"><a class="ggb" href="http://www.graphicguestbook.com/bloodyscythe" target="_blank">GraphicGuestbook</a></td>
			</tr>
		</table>
		<table id="gb_entry">
			<tr>
				<td>Nachricht: *</td>
			</tr>
			<tr>
				<td>
					<textarea id="msg" name="msg" rows="8" cols="60" onKeyUp="charLength(this.value)"></textarea><br>
					Zeichen &uuml;brig: <input id="chars_left" style="color:#444444; border:0; background-color:#d0d0d0; font-weight:none;" type="text" size="3" readonly="readonly" value="1000"><br>
					<small>* Felder m&uuml;ssen ausgef&uuml;llt sein, um fortzufahren</small>
				</td>
			</tr>
			<tr>
				<td>
					<div class="g-recaptcha" data-sitekey="6Lfp8c4SAAAAADYOGgSf3IADqL_e-i2302UIB9XH"></div>
				</td>
			</tr>
			<tr>
				<td>
					<input name="send" type="submit" value="abschicken">&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset" type="reset" value="zur&uuml;cksetzen">
				</td>
			</tr>
		</table>
	</fieldset>
</form>
<?php
include "connect.php";

// Wird nur ausgeführt, wenn das Formular abgesendet wurde, das Feld "name" und "msg" nicht leer sind
if (@$_POST['send'] != "" && @$_POST['name'] != "" && @$_POST['msg'] != "") {

    function post_captcha($user_response, $secret)
    {
        $fields_string = '';
        $fields = array(
            'secret' => $secret,
            // 'secret' => '6Lfp8c4SAAAAABd3xVNHYoTx2dzZh0GkJ3GH5E7W ',
            'response' => $user_response,
        );
        foreach ($fields as $key => $value) {
            $fields_string .= $key . '=' . $value . '&';
        }

        $fields_string = rtrim($fields_string, '&');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true);
    }

    // Call the function post_captcha
    $res = post_captcha($_POST['g-recaptcha-response'], $captcha_secret);

    if (!$res['success']) {
        // What happens when the CAPTCHA wasn't checked
        echo "<p>Please <a href='javascript:history.back();'>go back</a> and make sure you check the security CAPTCHA box.</p><br/>";
    } else {
        // If CAPTCHA is successfully completed...
        // Eintragen des Gästebucheintrags in die Datenbank
        $name = $_POST['name'];
        $mail = $_POST['mail'];
        $homepage = $_POST['hp'];
        $message = $_POST['msg'];
        $eintrag = "INSERT INTO `$sql_db_name`.`posts` (`PostID`,`Name`,`Mail`,`Homepage`,`Text`,`Sprache`) VALUES (NULL,'$name','$mail','$homepage','$message','de')";
        mysql_query($eintrag);

        echo '<p>Eintrag erfolgreich.</p><br/>';
    }
}

// Verbinden mit der Datenbank zur Ausgabe der Gästebucheinträge
$sql = "SELECT * FROM posts ORDER BY PostID DESC;";
$ergebnis = mysql_query($sql) or die("Die Anfrage konnte nicht ausgef&uuml;hrt werden");
$num = mysql_num_rows($ergebnis);
$count = 0;

// Ausgabe aller eingelesenen Gästebucheinträge
while ($row = mysql_fetch_assoc($ergebnis)) {
    $post = $num - $count;
    echo "\t<div class='post'>\n\t\t<table style='margin:4px; width:99%;'>\n\t\t\t<tr>\n\t\t\t<td>";
    echo "&nbsp;<b>Verfasser:</b> " . $row['Name'];
    if ($row['Mail'] != "") {
        echo " <a class='gb' href='mailto:" . $row['Mail'] . "'>E-mail</a>";
    }
    if ($row['Homepage'] != "" && $row['Homepage'] != "http://bloodyscythe.taess.net/?p=gb") {
        echo " <a class='gb' href='" . $row['Homepage'] . "' target='_blank'>Homepage</a>";
    }
    echo "</td>\n\t\t\t<td align=right><b>#$post</b></td>\n\t\t\t</tr>\n\t\t\t<tr>\n\t\t\t<td style='border-top:1px #121212 solid; padding-top: 10px !important;' colspan='2'>" . nl2br(htmlspecialchars($row['Text'])) . "</td>\n\t\t\t</tr>\n\t\t</table>\n\t</div>\n";
    $count++;
}
$count = "";
$post = "";
mysql_close();
?>
