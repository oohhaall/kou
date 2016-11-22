<?php 

require_once "../config/global_cont.php";
extract($_POST);
extract($_GET);
$dt_table = "tabmozaikdekor";	

	if($eid==0){
			$isim_s = "";
				//foreach ($dil_text as $key => $value) {
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
							/*
							INSERT INTO $dt_table(sra, resim, baslik_tr, baslik_en, baslik_de, baslik_es, baslik_fr, baslik_ru, baslik_it) SELECT MAX(sra)+1 AS sra,:resim as resim,:baslik_tr as baslik_tr, :baslik_en as baslik_en, :baslik_de as baslik_de, :baslik_es as baslik_es, :baslik_fr as baslik_fr, :baslik_ru as baslik_ru, :baslik_it as baslik_it FROM $dt_table
							*/
						$ekle_veri = $db->prepare("INSERT INTO $dt_table(sra, resim, baslik_tr, baslik_en, baslik_de, baslik_es, baslik_fr, baslik_ru, baslik_it) SELECT MAX(sra)+1 as sra,:resim as resim,:baslik_tr as baslik_tr, :baslik_en as baslik_en, :baslik_de as baslik_de, :baslik_es as baslik_es, :baslik_fr as baslik_fr, :baslik_ru as baslik_ru, :baslik_it as baslik_it FROM $dt_table");
					$ekle_veri->bindValue(":resim",$isim_s);
						foreach ($dil_text as $key => $value) {
							$ekle_veri->bindValue(":baslik_".$key,$_POST["tab_dekor_baslik_".$key]);
						}

					$ekle_veri->execute();

					if($ekle_veri->rowCount()>0){
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
				$sor_dekor = $db->prepare("SELECT * FROM $dt_table WHERE id=:eid");
				$sor_dekor->bindValue(":eid",$eid);
				$sor_dekor->execute();

				$oku_dekor = $sor_dekor->fetch();

						if(!empty($_FILES["resim"]["name"])){
							if(format_kontrol_resim($_FILES["resim"]["tmp_name"])){
							$uzanti_f = pathinfo($_FILES["resim"]["name"]);
							$uzanti = strtolower($uzanti_f["extension"]);
							$isim_s = (substr(md5(rand()),0,10).".".$uzanti);
							@copy($_FILES["resim"]["tmp_name"],$file_upload_path.$isim_s);
							@unlink($file_upload_path.$oku_dekor["resim"]);
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
							$isim_s =$oku_dekor["resim"];
						}
							/*
							INSERT INTO $dt_table(sra, resim, baslik_tr, baslik_en, baslik_de, baslik_es, baslik_fr, baslik_ru, baslik_it) SELECT MAX(sra)+1 AS sra,:resim as resim,:baslik_tr as baslik_tr, :baslik_en as baslik_en, :baslik_de as baslik_de, :baslik_es as baslik_es, :baslik_fr as baslik_fr, :baslik_ru as baslik_ru, :baslik_it as baslik_it FROM $dt_table
							*/
						$ekle_veri = $db->prepare("UPDATE $dt_table SET resim=:resim, baslik_tr=:baslik_tr, baslik_en=:baslik_en, baslik_de=:baslik_de, baslik_es=:baslik_es, baslik_fr=:baslik_fr, baslik_ru=:baslik_ru, baslik_it=:baslik_it WHERE id=:uid");

						$ekle_veri->bindValue(":uid",$eid);
						$ekle_veri->bindValue(":resim",$isim_s);
						foreach ($dil_text as $key => $value) {
							$ekle_veri->bindValue(":baslik_".$key,$_POST["tab_dekor_baslik_".$key]);
						}

					$ekle_veri->execute();

					if($ekle_veri->rowCount()>0){
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
				   $upd = $db->prepare("UPDATE $dt_table SET sra=sra-1 WHERE sra>=:sra AND sra>1");
					$upd->bindValue(":sra",$oku_v["sra"]);
					$upd->execute();
							if($sil_res->rowCount() != 0){
									echo "ok";
							}
				
	}
?>