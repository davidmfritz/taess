<?php
if (@$_GET['p'] == 'gb_acp') {
    session_start();
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta name="google-site-verification" content="lZG28-hPgzz4lGgCBOm4CQPlndbJuRzs_l4OcdCt5Ls" />
		<title>BloodyScythe.taess.com / BloodyScythe.taess.net</title>
		<link type="text/css" rel="stylesheet" href="./css/style.css"/>
        <script language="JavaScript" src="./js/main.js"></script>
        <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
	</head>

    <?php
$body = "\t<body";
switch (@$_GET["p"]) {
    case "gb":
        $body .= " onLoad=\"document.querySelector('#name').focus();\"";
        break;
    case "gb_acp":
        $body .= " onLoad=\"document.querySelector('#pw').focus();\"";
        break;
}
$body .= ">";
echo $body;
?>
		<div id="container">
            <div id="top">
                <img src="img/index.png" alt="banner">
            </div>
            <div id="navi">
                <ul>
                    <li><a href="./">Home</a></li>
                    <li class="dir"><a href="#">Projekte</a>
                        <ul>
                            <li><a href="?p=sprites">Sprites</a></li>
                            <li><a href="?p=shinies">Shinies</a></li>
                        </ul>
                    </li>
                    <li class="dir"><a href="#">Interessen</a>
                        <ul>
                            <li><a href="?p=magic">Magic (MTG)</a></li>
                            <li><a href="?p=games">Spiele</a></li>
                            <li><a href="?p=wc3">DotA</a></li>
                            <li><a href="?p=gebote">Elf Gebote</a></li>
                        </ul>
                    </li>
                    <li><a href="?p=bio">&Uuml;ber mich</a></li>
                    <li class="dir"><a href="#">Kontakt</a>
                        <ul>
                            <li><a href="?p=gb">G&auml;stebuch</a></li>
                            <li><a href="?p=imprint">Impressum</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
			<div id="content">
				<?php
switch (@$_GET['p']) {
    default:
        echo "\n\t\t\t\t<h1 class=\"title\">Home</h1>";
        include "html/home.html";
        break;
    case "gb":
        echo "\n\t\t\t\t<h1 class=\"title\">G&auml;stebuch</h1>";
        include "html/gb/index.php";
        break;
    case "gb_acp":
        echo "\n\t\t\t\t<h1 class=\"title\">G&auml;stebuch &mdash; Admin Control Panel</h1>";
        include "html/gb/acp.php";
        break;
    case "gb_rmentry":
        echo "\n\t\t\t\t<h1 class=\"title\">G&auml;stebuch &mdash; Admin Control Panel</h1>";
        include "html/gb/rmentry.php";
        break;
    case "imprint":
        echo "\n\t\t\t\t<h1 class=\"title\">Impressum</h1>";
        include "html/imprint.html";
        break;
    case "danke":
        echo "\n\t\t\t\t<h1 class=\"title\">Danke f&uuml;r Ihr Mail</h1>";
        include "html/danke.php";
        break;
    case "bio":
        echo "\n\t\t\t\t<h1 class=\"title\">&Uuml;ber mich</h1>";
        include "html/biography.html";
        break;
    case "sprites":
        echo "\n\t\t\t\t<h1 class=\"title\">Sprites</h1>";
        include "html/sprites.html";
        break;
    case "sprites_nov07":
        echo "\n\t\t\t\t<h1 class=\"title\">Sprites &mdash; November 2007</h1>";
        include "html/recolor/nov07.html";
        break;
    case "sprites_dec07":
        echo "\n\t\t\t\t<h1 class=\"title\">Sprites &mdash; Dezember 2007</h1>";
        include "html/recolor/dec07.html";
        break;
    case "sprites_jan08":
        echo "\n\t\t\t\t<h1 class=\"title\">Sprites &mdash; J&auml;nner 2007</h1>";
        include "html/recolor/jan08.html";
        break;
    case "sprites_search":
        echo "\n\t\t\t\t<h1 class=\"title\">Sprites &mdash; Suche</h1>";
        include "html/search.html";
        break;
    case "sprites_random":
        echo "\n\t\t\t\t<h1 class=\"title\">Sprites &mdash; Random</h1>";
        include "html/random-for-breeding.html";
        break;
    case "shinies":
        echo "\n\t\t\t\t<h1 class=\"title\">Shinies</h1>";
        include "html/shinies.html";
        break;
    case "wc3":
        echo "\n\t\t\t\t<h1 class=\"title\">DotA - Defense of the Ancients</h1>";
        include "html/wc3.html";
        break;
    case "games":
        echo "\n\t\t\t\t<h1 class=\"title\">Spiele</h1>";
        include "html/games.html";
        break;
    case "magic":
        echo "\n\t\t\t\t<h1 class=\"title\">Magic: the Gathering</h1>";
        include "html/mtg.html";
        break;
    case "gebote":
    case "666":
        echo "\n\t\t\t\t<h1 class=\"title\">Elf Gebote</h1>";
        include "html/gebote.html";
        break;
    case "1337":
        echo "Wenn du 1337 suchst, bist du auf dieser Seite falsch! :P";
        break;
}
?>
			</div>

			<div id="scroll-top">
				BACK TO TOP
			</div>

			<div id="footer">
				<div class="social-icons">
					<a href="https://steamcommunity.com/id/bloodyscythe/" target="_blank"><img src="img/steam-logo-icon.svg" alt="Link to my Steam Profile" /></a>
					<a href="https://twitter.com/Scythic" target="_blank"><img src="img/twitter-logo-icon.svg" alt="Link to my Twitter Profile" /></a>
					<a href="https://deckstats.net/decks/17957/f36476" target="_blank"><img src="img/deckstats-logo-icon.svg" alt="Link to my Deckstats Profile" /></a>
					<a href="?p=imprint"><img src="img/email-icon.svg" alt="E-Mail me a message" /></a>
				</div>

				<?php if (@$_GET['p'] == 'gb') {
    echo "\n\t\t\t\t<p>";
    echo "\n\t\t\t\tDer Eigent&uuml;mer dieser Seite &uuml;bernimmt keinerlei Haftung f&uuml;r etwaige sexuelle,
		rassistische oder andere unakzeptable Ausdr&uuml;cke sowie Werbung im G&auml;stebuch.
		Selbstverst&auml;ndlich werden betroffene Eintr&auml;ge sobald wie m&ouml;glich gel&ouml;scht. Liebe
		Hacker, es ist sinnlos, eine Injection auf die Datenbank vorzunehmen, da in der Datenbank weder mehr
		noch weniger Informationen gespeichert sind, als sie hier angef&uuml;hrt werden.";
    echo "\n\t\t\t\t</p>";
    echo "\n\t\t\t\t<p>";
    echo "\n\t\t\t\tThe owner of this page is not responsible for sexual, racist or any other expressions and advertisement
		in the guestbook. If there are comments that include above mentioned content, they will be removed as
		soon as possible. Dear hackers, there's no meaning of doing an injection on the database, because there
		are not more than less informations in it.";
    echo "\n\t\t\t\t</p>";
}?>
				<p>
				    Copyright by BloodyScythe &copy; 2007-2018. Alle Rechte vorbehalten. All Rights reserved.<br/>
				    Optimale Darstellung mit/Optimal viewing in <a href="http://www.mozilla.com/firefox" target="_blank">Firefox</a>, 1024x768+.
				</p>
			</div>
		</div>
	</body>
</html>
