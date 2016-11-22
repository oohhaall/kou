<?php 
	set_time_limit(0);
	require_once "../config/global_cont.php";
	extract($_POST);
	extract($_GET);


if(isset($type) && $type == "duz"){

				if(isset($_FILES["docs"])){
					$error    = $_FILES["docs"]["error"];
					$f_name   = pathinfo($_FILES["docs"]["name"]);
					$f_uret   = $f_name["filename"]."_".(substr(md5(rand()),0,5)).".".$f_name["extension"];
			 	 	$fileName = $_FILES["docs"]["name"];
			 		move_uploaded_file($_FILES["docs"]["tmp_name"],$f_file_path.$f_uret);

	 				$ekle = $db->prepare("UPDATE brosurler SET file_name=:file,baslik=:baslik WHERE id=:sid");
			 		$ekle->bindValue(":file",$f_uret);
	 			}else{
	 				$ekle = $db->prepare("UPDATE brosurler SET baslik=:baslik WHERE id=:sid");

	 			}

	 		$ekle->bindValue(":baslik",$baslik);
	 		$ekle->bindValue(":sid",$sid);
	 		$ekle->execute();


	  		echo "ok";
}else if(isset($type) && $type=="sil"){
	
	$sor_belg = $db->query("SELECT * FROM brosurler WHERE id=$sid")->fetch();
	@unlink($f_file_path.$sor_belg["file_name"]);

	$db->query("DELETE FROM brosurler WHERE id=$sid");

	echo "ok";
}else{
			if(isset($_FILES["docs"])){
				$error    = $_FILES["docs"]["error"];
				$f_name   = pathinfo($_FILES["docs"]["name"]);
				$f_uret   = $f_name["filename"].(substr(md5(rand()),0,5)).".".$f_name["extension"];
		 	 	$fileName = $_FILES["docs"]["name"];
		 		move_uploaded_file($_FILES["docs"]["tmp_name"],$f_file_path.$f_uret);
		 		$sor_bros_max = $db->query("SELECT MAX(sira) FROM brosurler")->fetch();
		 		$ekle = $db->prepare("INSERT INTO brosurler(file_name,baslik,sira) VALUES(:file,:baslik,:sira)");
		 		$ekle->bindValue(":file",$f_uret);
		 		$ekle->bindValue(":baslik",$baslik);
		 		$ekle->bindValue(":sira",($sor_bros_max["MAX(sira)"]+1));
		 		$ekle->execute();

		  		echo "ok";
 		}else{
 				?>
 					<div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
                   Lütfen Dosya Seçin
                  </div>
 				<?php
 		}
}	


?>