<?php
if (@$_GET['p'] == 'gb_acp') {
    session_start();
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="google-site-verification" content="lZG28-hPgzz4lGgCBOm4CQPlndbJuRzs_l4OcdCt5Ls" />
	<title>BloodyScythe.taess.com / BloodyScythe.taess.net</title>
	<link type="text/css" rel="stylesheet" href="css/styles.css"/>
</head>
<body <?php if (@$_GET['p'] == ('gb')) {echo "onLoad='javascript:document.getElementById(\"name\").focus();'";}?>	<?php if (@$_GET['p'] == ('gb_acp')) {echo "onLoad='javascript:document.getElementById(\'pw\').focus();'";}?>>
<div id="container">

<div id="top">
	<img src="img/index.png" alt="banner">
</div>

<!-- NAVIGATION -->
<div id="navi">
	<ul>
		<li style="margin-left: 2px;"><a href="./">Home</a></li>
		<li class="dir"><a href="#">Projekte</a>
			<ul>
				<li><a href="?p=sprites">Sprites</a></li>
				<li><a href="?p=shinies">Shinys</a></li>
			</ul>
		</li>
		<li class="dir"><a href="#">Interessen</a>
			<ul>
				<li><a href="?p=wc3">DotA</a></li>
				<li><a href="?p=games">Spiele</a></li>
				<li><a href="?p=magic">Magic (MTG)</a></li>
				<li><a href="?p=gebote">Elf Gebote</a></li>
				<li><a href="?p=stuff">N&uuml;tzl. Prog.</a></li>
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
<!-- END NAVIGATION -->

	<div id="content">
		<?php
switch (@$_GET['p']) {
    default:include "html/home.html";
        break;
    case "gb":include "html/gb/index.php";
        break;
    case "gb_acp":include "html/gb/acp.php";
        break;
    case "gb_rmentry":include "html/gb/rmentry.php";
        break;
    case "imprint":include "html/imprint.html";
        break;
    case "danke":include "html/danke.php";
        break;
    case "bio":include "html/biography.html";
        break;
    case "sprites":include "html/sprites.html";
        break;
    case "sprites_nov07":include "html/recolor/nov07.html";
        break;
    case "sprites_dec07":include "html/recolor/dec07.html";
        break;
    case "sprites_jan08":include "html/recolor/jan08.html";
        break;
    case "sprites_search":include "html/search.html";
        break;
    case "sprites_random":include "html/random-for-breeding.html";
        break;
    case "shinies":include "html/shinies.html";
        break;
    case "wc3":include "html/wc3.html";
        break;
    case "games":include "html/games.html";
        break;
    case "magic":include "html/mtg.html";
        break;
    case "gebote":include "html/gebote.html";
        break;
    case "666":include "html/gebote.html";
        break;
    case "stuff":include "html/useful_stuff.html";
        break;
    case "1337":echo "Wenn du 1337 suchst, bist du auf dieser Seite falsch! :P";
        break;
}
?>
	</div>

	<?php if (@$_GET['p'] == 'gb') {?>
	<div id="footer" align="center">
		<table width="100%">
			<tr>
			<td><small>
			Der Eigent&uuml;mer dieser Seite &uuml;bernimmt keinerlei Haftung f�r etwaige sexuelle, rassistische oder andere
			unakzeptable Ausdr&uuml;cke sowie Werbung im G&auml;stebuch. Selbstverst&auml;ndlich werden betroffene Eintr&auml;ge sobald
			wie m&ouml;glich gel&ouml;scht. Liebe Hacker, es ist sinnlos, eine Injection auf die Datenbank vorzunehmen, da in der Datenbank
			weder mehr noch weniger Informationen gespeichert sind, als sie hier angef&uuml;hrt werden. MfG <i>BloodyScythe</i>

			The owner of this page is not responsible to sexual, racistic or some different expressions and advertisement in the guestbook.
			Of course if there are some things like that, they will be removed as soon as possible. Dear hackers, it's senseless, to do an injection on the database, because
			there are not more than less informations in it. Best regards <i>BloodyScythe</i>
			</small></td>
			</tr>
		</table>
	</div>
	<?php }?>

	<div id="footer" align="center">
		<table width="100%">
			<tr>
			<td><a href="javascript:scroll(0,0);"><small>&uarr;top&uarr;</small></a></td>
			<td><small>
			Copyright by BloodyScythe &copy; 2007-2012. Alle Rechte vorbehalten. All Rights reserved.<br />
			Optimale Darstellung mit/Optimal viewing in <a href="http://www.mozilla.com/firefox" target="_blank">Firefox</a>, 1024x768+.
			</small></td>
			</tr>
		</table>
	</div>

	</div>
</body>
</html>
