<?php 
	require_once "../config/global_cont.php";

extract($_POST);
$db->query("UPDATE ".$_GET["dt"]." SET durum=IF(durum=1,0,1) WHERE id='".$lid."'");


?>