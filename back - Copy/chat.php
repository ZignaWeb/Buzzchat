<?
$yo = $_SESSION["idMe"];
$el = $_GET["relid"];

// time variables
$timetoold=date("Y-n-j H:i:s", time() - 60 * 60 * 24);

if(isset($_POST["mensaje"])){
	// insert message
	$mje=$_POST["mensaje"];
	$mit="INSERT INTO `mensajes` SET `de`='$yo', `para`='$el', `mensaje`='$mje', `cuando`=NOW()";
	$miq=mysql_query($mit);
	// last active update
	$ot="UPDATE `online` SET `lastactive`=NOW() WHERE `usuarioid`='".$_SESSION["idMe"]."' AND `id`='".$_SESSION["sId"]."'";
	$oq=mysql_query($ot);
}
?>
<div id="chat">
	<?
	chatlistMessages($yo,$el);
	?>
</div>
<?
mysql_query("UPDATE `mensajes` SET `visto`='1' WHERE `de`='$el' AND `para`='$yo'");
?>
<form class="chat" action="./?relid=<?=$el?>#bottom" method="post">
	<input name="mensaje" placeholder="Escribe tu mensaje aqui">
  <input type="submit">
</form>
<a name="bottom"></a>