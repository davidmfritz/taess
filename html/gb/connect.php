<?php
include "credentials.php";
mysql_connect($sql_server, $sql_db_user, $sql_db_password);
mysql_select_db($sql_db_name) or die("Verbindung zur Datenbank nicht m&ouml;glich");
