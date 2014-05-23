<h2>representantes conectados</h2>
<ol class="chatGuests">
<?
	$at="SELECT `usuarios`.`id`, `usuarios`.`nombre` 
	FROM `usuarios`,`online` 
	WHERE 
		`usuarios`.`nivel`='99' 
		AND `online`.`fin`='0000-00-00 00:00:00' 
		AND `usuarios`.`id`=`online`.`usuarioid`
		AND `lastactive` > date_sub(now(), interval 5 minute)
	GROUP BY `usuarios`.`id`";
	$aq=mysql_query($at);
	while ($ad=mysql_fetch_assoc($aq)) {
		$nombre=$ad["nombre"];
		$id=$ad["id"];
		echo "<li><a href='./?relid=$id'>$nombre</a></li>";
	}
?>
</ol>