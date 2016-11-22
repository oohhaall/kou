<?php 
		require_once "../config/global_cont.php";
		extract($_POST);
		extract($_GET);

$dt_table = "koleksiyonparcalari";

if($_POST){
			if($eid==0){
				$isim_s = "";
						
				if(!empty($_FILES["resim"]["name"])){
					if(format_kontrol_resim($_FILES["resim"]["tmp_name"])){
					$uzanti_f = pathinfo($_FILES["resim"]["name"]);
					$uzanti = strtolower($uzanti_f["extension"]);
					$isim_s = (substr(md5(rand()),0,10).".".$uzanti);
					@copy($_FILES["resim"]["tmp_name"],$file_upload_path.$isim_s);
				}else{
					?>
				<div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
                   Lütfen jpeg,png,gif,bmp Formatında bir resim ekleyiniz.
                  </div>
							<?php
							exit;
						}
						}else{
							$isim_s = "";
						}
		$ekle_detay = $db->prepare("INSERT INTO $dt_table(sra, uid, resim, renk) SELECT MAX(sra)+1 as sra,:uid as uid,:resim as resim,:renk as renk FROM $dt_table WHERE uid=:uid");
		$ekle_detay->bindValue(":uid",$sid);
		$ekle_detay->bindValue(":renk",$renk);
		$ekle_detay->bindValue(":resim",$isim_s);
		$ekle_detay->execute();

				if($ekle_detay->rowCount()!=0){
					?>
				  <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                    İçerik başarıyla eklendi listeden detaylı görüntüleme yapabilirsiniz.
                  </div>
							<?php

					}else{
						?>
							<div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
                   İçerik eklenemiyor lütfen yetkililere sorun hakkında bilgilendirme yapınız.
                  </div>
						<?php
					}
				}else if($eid != 0 && @$islem != "sil"){


					$sor_detay = $db->prepare("SELECT * FROM $dt_table WHERE id=:uid");
					$sor_detay->bindValue(":uid",$eid);
					$sor_detay->execute();
					$oku_detay = $sor_detay->fetch();
						$isim_s = "";
						
				if(!empty($_FILES["resim"]["name"])){
					if(format_kontrol_resim($_FILES["resim"]["tmp_name"])){
					$uzanti_f = pathinfo($_FILES["resim"]["name"]);
					$uzanti = strtolower($uzanti_f["extension"]);
					$isim_s = (substr(md5(rand()),0,10).".".$uzanti);
					@copy($_FILES["resim"]["tmp_name"],$file_upload_path.$isim_s);
					@unlink($file_upload_path.$oku_detay["resim"]);

				}else{
					?>
				<div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
                   Lütfen jpeg,png,gif,bmp Formatında bir resim ekleyiniz.
                  </div>
							<?php
							exit;
						}
						}else{
							$isim_s = $oku_detay["resim"];
						}
		$ekle_detay = $db->prepare("UPDATE $dt_table SET resim=:resim, renk=:renk  WHERE id=:uid");
		$ekle_detay->bindValue(":uid",$eid);
		$ekle_detay->bindValue(":renk",$renk);
		$ekle_detay->bindValue(":resim",$isim_s);
		$ekle_detay->execute();

				if($ekle_detay->rowCount()!=0){
					?>
				  <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                    İçerik başarıyla güncellendi listeden detaylı görüntüleme yapabilirsiniz.
                  </div>
							<?php

					}else{
						?>
							<div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
                   İçerik güncellenemiyor lütfen yetkililere sorun hakkında bilgilendirme yapınız.
                  </div>
						<?php
					}
				}else{
					$sor_varmi = $db->prepare("SELECT * FROM $dt_table WHERE id=:uid");
					$sor_varmi->bindValue(":uid",$eid);
					$sor_varmi->execute();
					$oku_v = $sor_varmi->fetch();

					@unlink($file_upload_path.$oku_v["resim"]);

						$sil_res = $db->prepare("DELETE FROM $dt_table WHERE id=:uid");
						$sil_res->bindValue(":uid",$eid);
						$sil_res->execute();
				   $upd = $db->prepare("UPDATE $dt_table SET sra=sra-1 WHERE sra>=:sra AND sra>1 AND uid=:uid");
					$upd->bindValue(":sra",$oku_v["sra"]);
					$upd->bindValue(":uid",$oku_v["uid"]);
					$upd->execute();
							if($sil_res->rowCount() != 0){
									?>
  <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                    İçerik başarıyla silindi listeden detaylı görüntüleme yapabilirsiniz.
                  </div>
									<?php
							}else{
								?>
<div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
                   İçerik silinemiyor lütfen yetkililere sorun hakkında bilgilendirme yapınız.
                  </div>
								<?php
							}
				}

}



?>