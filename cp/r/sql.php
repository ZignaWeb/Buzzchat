<?
$db_server="localhost";
$db_usr="buzzchat_zigna";
$db_psw="bubeigfrzzchat";
$db_name="buzzchat_zigna";

$dbh = mysql_connect ($db_server, $db_usr, $db_psw) or die ('I cannot connect to the database because: ' . mysql_error()); mysql_select_db ($db_name);
?>