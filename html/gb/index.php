<script src="https://www.google.com/recaptcha/api.js?render=6LeU8qEUAAAAAEeuLGoaIJWW0PwFgtna21Cd4J9T"></script>
<script type="text/javascript">

//Create a token for each user visiting the site
grecaptcha.ready(function() {
	grecaptcha.execute('6LeU8qEUAAAAAEeuLGoaIJWW0PwFgtna21Cd4J9T', {action: 'gbentry'}).then(function(token) {
		document.querySelector("#g-recaptcha-response").value = token;
	});
});

function ResetCheck() {
  let chk = window.confirm("Wollen Sie wirklich alle Eingaben löschen?");
  return (chk);
}

function CheckInput() {
	const name = document.querySelector("#name");
	const msg = document.querySelector("#msg");

	if (name.value == "") {
		alert("Bitte einen Namen angeben!");
		name.focus();
		return false;
	}
	if (msg.value == "") {
		alert("Es gibt keine Nachricht zu übermitteln!");
		msg.focus();
		return false;
	}
	if(msg.value.length > 1000){
		alert("Ihre eingegebene Nachricht ist zu lang. Bitte kürzen Sie diese auf maximal 1000 Zeichen.");
		return false;
	}
	return true;
}

function charLength() {
	const msg = document.querySelector("#msg");
	const chars_left = document.querySelector("#chars_left");

	const $length = 1000 - msg.value.length;
	chars_left.value = $length;
	if (chars_left.value < 0) {
		chars_left.style.color = "#f00";
		chars_left.style.fontWeight = "bold";
	} else {
		chars_left.style.color = "#444444";
		chars_left.style.fontWeight = "normal";
	}
	return true;
}
</script>

<!--  ******** INPUT FORM START ******** -->
<form name="eintag_erstellen" value="eintrag_erstellen" action="?p=gb" method="post" onreset="return ResetCheck();" onsubmit="return CheckInput();">

    <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" />

    <fieldset><legend>G&auml;stebucheintrag erstellen</legend>
		<table id="gb_entry">
			<tr>
				<td>Name: *</td>
				<td>E-mail Adresse:</td>
				<td>Homepage:</td>
				<td style="text-align: center;"><a href="?p=gb_acp" style="color:#888888; text-decoration:none;">AdminCP</a></td>
			</tr>
			<tr>
				<td><input id="name" name="name" type="text" value=""></td>
				<td><input id="mail" name="mail" type="text" value=""></td>
				<td><input id="hp" name="hp" type="text" value=""></td>
				<td><a class="ggb" href="http://www.graphicguestbook.com/bloodyscythe" target="_blank">GraphicGuestbook</a></td>
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
					<input name="send" type="submit" value="Abschicken"><input name="reset" type="reset" value="Zur&uuml;cksetzen">
				</td>
			</tr>
		</table>
	</fieldset>
</form>
<!-- ******** INPUT FORM END ******** -->

<?php
/* ******** WRITE POST INTO DB START ******** */
include "connect.php";

// Wird nur ausgeführt, wenn das Formular abgesendet wurde, das Feld "name" und "msg" nicht leer sind
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name']) && isset($_POST['msg']) && isset($_POST['g-recaptcha-response'])) {

    function post_captcha($user_response, $secret)
    {
        // Build POST request:
        $recaptcha_url = "https://www.google.com/recaptcha/api/siteverify";

        // Make and decode POST request:
        $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $secret . '&response=' . $user_response);
        $recaptcha = json_decode($recaptcha);

        // Take action based on the score returned:
        if (@$recaptcha->score >= 0.5) {
            // Verified
            return true;
        }
        // Not verified - error
        return false;
    }

    // Call the function post_captcha
    $res = post_captcha($_POST['g-recaptcha-response'], $captcha_secret);

    if (!$res) {
        // What happens when the CAPTCHA wasn't checked
        echo "<p>CAPTCHA verification failed. Please <a href='javascript:history.back();'>go back</a> and try again.</p><br/>";
    } else {
        // If CAPTCHA is successfully completed...
        // Eintragen des Gästebucheintrags in die Datenbank
        $name = $_POST['name'];
        $mail = $_POST['mail'];
        $homepage = $_POST['hp'];
        $message = $_POST['msg'];
        if ($con->connect_errno) {
            echo "Connect error: " . $con->connect_errno;
        } else {
            $eintrag = "INSERT INTO `$sql_db_name`.`posts` (`PostID`,`Name`,`Mail`,`Homepage`,`Text`,`Sprache`) VALUES (NULL,'$name','$mail','$homepage','$message','de')";
            $con->query($eintrag);

            echo '<p>Eintrag erfolgreich.</p><br/>';
        }
    }
}
/* ******** WRITE POST INTO DB END ******** */
/* ******** DISPLAY ALL POSTS START ******** */
if ($con->connect_errno) {
    echo "Connect error: " . $con->connect_errno;
} else {
    $sql = "SELECT * FROM posts ORDER BY PostID DESC;";
    $result = $con->query($sql);
    $result_rows = $result->num_rows;
    $count = 0;

    // Ausgabe aller ausgelesenen Gästebucheinträge
    while ($row = $result->fetch_assoc()) {
        $post = $result_rows - $count;
        $output = "";
        $output .= "\t<div class='post'>\n\t\t<table style='margin:4px; width:99%;'>\n\t\t\t<tr>\n\t\t\t<td>";
        $output .= "&nbsp;<b>Verfasser:</b> " . $row['Name'];
        if ($row['Mail'] != "") {
            $row['Mail'] = strtolower($row['Mail']);
            $output .= " <a class='gb' href='mailto:" . $row['Mail'] . "'>E-mail</a>";
        }
        if ($row['Homepage'] != ""
            && $row['Homepage'] != "http://bloodyscythe.taess.net/?p=gb"
            && $row['Homepage'] != "http://bloodyscythe.taess.com/?p=gb") {
            $row['Homepage'] = strtolower($row['Homepage']);
            $url_prefix = [
                'http://',
                'https://',
            ];
            if (substr($row['Homepage'], 0, strlen($url_prefix[0])) != $url_prefix[0]
                && substr($row['Homepage'], 0, strlen($url_prefix[1])) != $url_prefix[1]) {
                $row['Homepage'] = $url_prefix[0] . $row['Homepage'];
            }
            $output .= " <a class='gb' href='" . $row['Homepage'] . "' target='_blank'>Homepage</a>";
        }
        $output .= "</td>\n\t\t\t<td align=right><b>#$post</b></td>\n\t\t\t</tr>\n\t\t\t<tr>\n\t\t\t<td style='border-top:1px #121212 solid; padding-top: 10px !important;' colspan='2'>" . nl2br(htmlspecialchars($row['Text'])) . "</td>\n\t\t\t</tr>\n\t\t</table>\n\t</div>\n";
        echo $output;
        $count++;
    }
    $con->close();
    unset($output, $count, $post);
}
/* ******** DISPLAY ALL POSTS END ******** */
?>
