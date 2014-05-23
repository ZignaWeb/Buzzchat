<?
session_start();
$db=mysql_connect("localhost","buzzchat_zigna","zigna2014") or die("Error ".mysql_error($db));
mysql_select_db("buzzchat_zigna");

// numeros generales
$fDate="Y-n-j";
$fDateTxt="AAAA/MM/DD";
$fDateTime="Y-n-j H:i:s";
$fDateTimeTxt="AAAA/MM/DD HH:MM:SS";

$hoy = date($fDate);
$ahora = date($fDateTime);

function chatlistMessages($yo,$el) {
	global $timetoold;
	$mt="SELECT * FROM `mensajes` WHERE (`de`='$yo' AND `para`='$el') OR (`para`='$yo' AND `de`='$el') ORDER BY `cuando` ASC LIMIT 50";
	$mq=mysql_query($mt);
	
	$yoN=mysql_fetch_assoc(mysql_query("SELECT `nombre` FROM `usuarios` WHERE `id`='$yo'"));$yoN=$yoN["nombre"];
	$elN=mysql_fetch_assoc(mysql_query("SELECT `nombre` FROM `usuarios` WHERE `id`='$el'"));$elN=$elN["nombre"];
	
	while ($md=mysql_fetch_assoc($mq)){
		if ($md["cuando"] < $timetoold){
			$old="old";
		}else{
			$old="";
		}
		if ($md["para"]==$yo){
			echo "<div class='de $old'><span>$elN:</span>".$md["mensaje"]."</div>";
		}else{
			echo "<div class='para $old'><span>$yoN:</span>".$md["mensaje"]."</div>";
		}
	}
}
?>