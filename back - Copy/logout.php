<?
session_start();

include("../r/funciones.php");
$uId = $_SESSION["idMe"];
$sId = $_SESSION["sId"];
$dt="UPDATE `online` SET `fin`=NOW() WHERE `usuarioid`='$uId' AND `id`='$sId'";
$dq=mysql_query($dt);

session_destroy();
header("Location: ./?=logout");
?>