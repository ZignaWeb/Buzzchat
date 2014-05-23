<?
include("../r/funciones.php");
$id = $_SESSION["idMe"];
if (isset($_POST["usr"]) && isset($_POST["tel"])) {
	
	// preprar las variables
	$usr=strip_tags($_POST["usr"]);
	$tel=strip_tags($_POST["tel"]);
	
	// generar login unicos por si ponen los datos de forma diferente
	$delete=array(" ","-","_",":",".","(",")","[","]","#","/","*",",","+");
	$usrlg=mysql_real_escape_string(strtolower(str_replace($delete,"",$usr)));
	$tellg=mysql_real_escape_string(strtolower(str_replace($delete,"",$tel)));
	
	// ver si ya existe
	$ut="SELECT `id`,`nombre` FROM `usuarios` WHERE `nombre_login`='$usrlg' AND `telefono_login`='$tellg'";
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
		// check for admins to add default relations
		$at="SELECT `id` FROM `usuarios` WHERE `nivel`='99'";
		$aq=mysql_query($at);
		while($ad=mysql_fetch_assoc($aq)){
			$qit="INSERT INTO `relaciones` SET `user1id`='$lastid', `user2id`='".$ad["id"]."'";
			$qiq=mysql_query($qit);
		}
		
		$_SESSION["idMe"]=$lastid;
		$hash="signup";
	}
	$ot="INSERT INTO `online` SET `usuarioid`='".$_SESSION["idMe"]."', `inicio`=NOW(), `lastactive`=NOW()";
	$oq=mysql_query($ot);
	$sId=mysql_insert_id();
	$_SESSION["sId"]=$sId;
	header("Location: ./?$hash");
}
?>