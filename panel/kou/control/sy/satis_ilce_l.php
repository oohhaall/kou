<?php 
	require_once "../config/global_cont.php";
	extract($_GET);
	extract($_POST);
	$dt_table = "satisilce";
	$sor_sehir = $db->prepare("SELECT * FROM $dt_table WHERE uid=:uid AND sid=:sid ORDER BY baslik ASC");

	$sor_sehir->bindValue(":uid",$uid);
	$sor_sehir->bindValue(":sid",$sid);
	$sor_sehir->execute();
	foreach ($sor_sehir->fetchAll() as $key => $value) {
			if(isset($sec) && $value["id"]==$sec){
					?>
						 <option value="<?php echo $value["id"]; ?>" selected><?php echo $value["baslik"]; ?></option>
					<?php
			}else{
		?>
          <option value="<?php echo $value["id"]; ?>"><?php echo $value["baslik"]; ?></option>
		<?php
		}
	}

?>