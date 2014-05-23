<?
include("../r/funciones.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Buzz Chat Front</title>
<link href="../r/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../r/jquery.js"></script>
<script type="text/javascript" src="../r/mainchat.js"></script>
</head>

<body id="client">
<?

	// conectado exitosamente	
	if (isset($_SESSION["idMe"])) {
		echo '<a href="logout.php">logout</a>';
		if (isset($_GET["relid"])){
			include("chat.php");
		}else{
			include("with.php");
		}
	}else{
		include("login.php");
	}
?>

</body>
</html>