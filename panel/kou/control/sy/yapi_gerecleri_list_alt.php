<?php 
  require_once "../config/global_cont.php";

extract($_GET);
extract($_POST);

	/*	print_r($_POST);
		echo $_FILES["resim"]["name"];*/
		/*
Array ( [uid] => 10 [dil_key] => tr ) 1734969890.jpg
		*/
		if(!empty($_FILES["resim"]["name"])){
				if(format_kontrol_resim($_FILES["resim"]["tmp_name"])){
					$uzanti_f = pathinfo($_FILES["resim"]["name"]);
					$uzanti = strtolower($uzanti_f["extension"]);
					$urun_resim = $uzanti_f["filename"]."_".(substr(md5(rand()),0,5).".".$uzanti);
					@copy($_FILES["resim"]["tmp_name"],$file_upload_path.$urun_resim);
					
					if($sid != 0){
							$sor_eski = $db->prepare("SELECT * FROM yapigereclerislayt WHERE id=:id");
							$sor_eski->bindValue(":id",$sid);
							$sor_eski->execute();
							$veri = $sor_eski->fetch();
							@unlink($file_upload_path.$veri["resim"]);

						$ekle = $db->prepare("UPDATE yapigereclerislayt SET uid=:uid,dil=:dil,resim=:resim WHERE id=:sid");

						$ekle->bindValue(":sid",$sid);
						$inf = '<div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                    Alt Slider başarıyla güncellendi listeden detaylı görüntüleme yapabilirsiniz.
                  </div>';
					}else{

						$ekle = $db->prepare("INSERT INTO yapigereclerislayt(sra,uid,dil,resim) SELECT (MAX(sra)+1) as sra,:uid as uid,:dil as dil,:resim as resim FROM yapigereclerislayt");
									$inf = '<div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                    Alt Slider başarıyla eklendi listeden detaylı görüntüleme yapabilirsiniz.
                  </div>';
						
					}
						$ekle->bindValue(":uid",$uid);
						$ekle->bindValue(":dil",$dil_key);
						$ekle->bindValue(":resim",$urun_resim);



				}else{
					?>
					   <div class="alert alert-warning alert-dismissable">
	                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
	                   Lütfen Alt slider resmi için jpg,png,gif,bmp Formatında bir resim ekleyiniz.
	                  </div>
					<?php
					exit;
				}

		}else{

				$sor_eski = $db->prepare("SELECT * FROM yapigereclerislayt WHERE id=:id");
				$sor_eski->bindValue(":id",$sid);
				$sor_eski->execute();
				$veri = $sor_eski->fetch();
				@unlink($file_upload_path.$veri["resim"]);
				$ekle = $db->prepare("DELETE FROM yapigereclerislayt WHERE id=:sid");
				$ekle->bindValue(":sid",$sid);
							$inf = '<div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                    Alt Slider başarıyla silindi listeden detaylı görüntüleme yapabilirsiniz.
                  </div>';
		}

		$ekle->execute();

		if($ekle->rowCount()){
			echo $inf;
		}else{
			?>
				<div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
                   Alt Slider işlemi gerçekleştirilemiyor lütfen yetkililere sorun hakkında bilgilendirme yapınız.
                  </div>
			<?php
		}

?>