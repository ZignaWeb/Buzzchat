<?
include("../r/funciones.php");
// error_reporting(0);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Buzz Chat</title>
<link href="../r/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../r/jquery.js"></script>
<script type="text/javascript" src="../r/mainchat.js"></script>
</head>

<body id="back" onload="refresh()">
<?

	// conectado exitosamente	
	if (isset($_SESSION["idMe"])) {
?>
    <div id="chatRoom">
<?
		if (isset($_GET["relid"])){include("chat.php");}
?>
		</div>
    <ol class="chatGuests">
	    <li><a id="cerrar" href="./">Cerrar</a></li>
    	<li><a id="logout" href="logout.php">Logout</a></li>    
    </ol>
    <h2><span>Convresacciones pendientes de respuesta</span></h2>
    <ol class="chatGuests">
<?
			// seleccionar los mensajes no repondidos
			$mnrt="SELECT * FROM `mensajes` WHERE `para`='".$_SESSION["idMe"]."' AND `visto`='0' GROUP BY `de` ORDER BY `cuando` ASC";
			$mnrq=mysql_query($mnrt);
			while($mnrd=mysql_fetch_assoc($mnrq)){
				$id=$mnrd["de"];
				$nombre=mysql_fetch_assoc(mysql_query("SELECT `nombre` FROM `usuarios` WHERE `id`='$id'"));
				$nombre=$nombre["nombre"];
				echo "<li class='user'><a href='./?relid=$id#bottom'>$nombre</a></li>";
			}
?>
    </ol>
    <h2><span>Usuarios registrados</span></h2>
    <ol class="chatGuests">
    	<?
			// mysql merge two results into $rnrd["ids"]?
			$rnrt="SELECT `user1id`, `user2id` FROM `relaciones`, `usuarios` WHERE (`user1id`=`usuarios`.`id` OR `user2id`=`usuarios`.`id`) AND `usuarios`.`id`='".$_SESSION["idMe"]."'";
			$rnrq=mysql_query($rnrt);
			$rnrn=mysql_num_rows($rnrq);
			$ids=array();
			while($rnrd=mysql_fetch_assoc($rnrq)){
				array_push($ids,$rnrd["user1id"]);
				array_push($ids,$rnrd["user2id"]);
			}
			$ids=array_unique($ids);
			sort($ids);
			foreach ($ids as $val) {
				$rt="SELECT `id`,`nombre` FROM `usuarios` WHERE `id`='$val'";
				$rq=mysql_query($rt);
				$rd=mysql_fetch_assoc($rq);
				if ($rd["id"]!=$_SESSION["idMe"]	) {
					echo "<li class='user'><a href='./?relid=".$rd["id"]."#bottom'>".$rd["nombre"]."</a></li>";
				}
			}
			?>
    </ol>
<?
	}else{
		include("login.php");
	}
?>
</body>
</html>