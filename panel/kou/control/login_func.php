<?php 
	require_once "../config/global_cont.php";
	extract($_POST);

	$sor_user = $db->prepare("SELECT id FROM panel_user WHERE user=:user_name and pass=:password");
	$sor_user->bindValue(":user_name",$user);
	$sor_user->bindValue(":password",md5(md5($pass)));
	$sor_user->execute();
	$val = $sor_user->fetch();
	if(!empty($val["id"])){
		$_SESSION["login"] = true;
		$_SESSION["user_id"] = $val["id"];
		echo "oks";
	}else{
		echo "hata";
	}
?>