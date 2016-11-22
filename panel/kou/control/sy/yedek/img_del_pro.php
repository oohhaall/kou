<?php
	require_once "../config/global_cont.php";
	extract($_POST);

	switch($page){
			case "program":
				$sor_sid = $db->query("SELECT * FROM program WHERE id='".$id."'")->fetch();
				@unlink($file_upload_path.$sor_sid["resim"]);
				$var_up = $db->prepare("UPDATE program SET resim='' WHERE id='".$id."'");
				$var_up->execute();
				if($var_up->rowCount()){
					echo $var_up->rowCount();
				}
			break;
			case "finans":
				$sor_sid = $db->query("SELECT * FROM finans WHERE id='".$id."'")->fetch();
				@unlink($file_upload_path.$sor_sid["resim"]);
				$var_up = $db->prepare("UPDATE finans SET resim='' WHERE id='".$id."'");
				$var_up->execute();
				if($var_up->rowCount()){
					echo $var_up->rowCount();
				}
			break;

			case "isveren_markasi_gelisimi":
				$sor_sid = $db->query("SELECT * FROM isveren_markasi WHERE id='".$id."'")->fetch();
				@unlink($file_upload_path.$sor_sid["resim"]);
				$var_up = $db->prepare("UPDATE isveren_markasi SET resim='' WHERE id='".$id."'");
				$var_up->execute();
				if($var_up->rowCount()){
					echo $var_up->rowCount();
				}
			break;

			case "insan_kaynaklari_gelisimi":
				$sor_sid = $db->query("SELECT * FROM insan_kaynaklari WHERE id='".$id."'")->fetch();
				@unlink($file_upload_path.$sor_sid["resim"]);
				$var_up = $db->prepare("UPDATE insan_kaynaklari SET resim='' WHERE id='".$id."'");
				$var_up->execute();
				if($var_up->rowCount()){
					echo $var_up->rowCount();
				}
			break;

	}

?>