<?
session_start();
$db=mysql_connect("localhost","web","zibeigfrgna") or die("Error ".mysql_error($db));
mysql_select_db("buzzchat");
$id = $_SESSION["id"];
if (isset($_POST["usr"]) && isset($_POST["tel"])) {
	
	// preprar las variables
	$usr=strip_tags($_POST["usr"]);
	$tel=strip_tags($_POST["tel"]);
	
	// generar login unicos por si ponen los datos de forma diferente
	$delete=array(" ","-","_",":",".","(",")","[","]","#","/","*",",","+");
	$usrlg=mysql_real_escape_string(strtolower(str_replace($delete,"",$usr)));
	$tellg=mysql_real_escape_string(strtolower(str_replace($delete,"",$tel)));
	
	// ver si ya existe + falta corroborar que el nombre de usuario no exista
	$ut="SELECT `id` FROM `usuarios` WHERE `nombre_login`='$usrlg' AND `telefono_login`='$tellg'";
	$uq=mysql_query($ut) or die(mysql_error());
	$un=mysql_num_rows($uq);
	
	if ($un==1) {
		// si existe, sacar el id e ir al chat
		$ud=mysql_fetch_assoc($uq);
		$_SESSION["idMe"]=$ud["id"];
		$hash="login";
	}else{
		// si no existe, crear el registro, sacar el id e ir al chat
		$qit="INSERT INTO `usuarios` SET `nombre`='$usr', `telefono`='$tel', `nombre_login`='$usrlg', `telefono_login`='$tellg'";
		$qiq=mysql_query($qit);
		$lastid=mysql_insert_id();
		$_SESSION["idMe"]=$lastid;
		
		$qit="INSERT INTO `relaciones` SET `user1id`='$lastid', `user2id`='$id'";
		$qiq=mysql_query($qit);
		$hash="signup";
	}
	
	$ot="INSERT INTO `online` SET `usuarioid`='".$_SESSION["idMe"]."', `inicio`=NOW(), `lastactive`=NOW()";
	$oq=mysql_query($ot);
	$sId=mysql_insert_id();
	$_SESSION["sId"]=$sId;
	
	header("Location: ./?$hash:".$_SESSION["idMe"]);
}
?>