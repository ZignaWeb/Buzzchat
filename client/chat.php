<?

$yo 		= $_SESSION["idMe"];
$el		= $_GET["relid"];

if(isset($_POST["mensaje"])){
	$mje=$_POST["mensaje"];
	$mit="INSERT INTO `mensajes` SET `de`='$yo', `para`='$el', `mensaje`='$mje', `cuando`=NOW()";
	$miq=mysql_query($mit);
	// last active update
	$ot="UPDATE `online` SET `lastactive`=NOW() WHERE `usuarioid`='$yo' AND `id`='".$_SESSION["sId"]."'";
	$oq=mysql_query($ot);
}
?>
<div id="chat">
<?
chatlistMessages($yo,$el);
?>
</div>
<form class="chat" action="./?relid=<?=$el?>#bottom" method="post">
	<input name="mensaje" placeholder="Escribe tu mensaje aqui">
  <input type="submit">
</form>
<a name="bottom"></a>