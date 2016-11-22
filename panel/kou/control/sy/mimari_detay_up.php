<?php 
		require_once "../config/global_cont.php";
		extract($_POST);
		extract($_GET);

		if($_POST){
			$val_up = implode(",", $up_val);
			$db_up = $db->prepare("UPDATE urunler SET $up_tab=:val_up WHERE id=:uid");
			$db_up->bindValue(":val_up",$val_up);
			$db_up->bindValue(":uid",$mid);
			$db_up->execute();
		}
?>

