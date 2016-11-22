<?php 
  require_once "../config/global_cont.php";
		
	extract($_GET);
	extract($_POST);
		$dt_table = "slider";
		if($sid == 0 && @$islem!="sil"){
				$isim_s = array();
				foreach ($dil_text as $key => $value) {
						if(!empty($_FILES["slider_resim_$key"]["name"])){
							if(format_kontrol_resim($_FILES["slider_resim_$key"]["tmp_name"])){
							$uzanti_f = pathinfo($_FILES["slider_resim_$key"]["name"]);
							$uzanti = strtolower($uzanti_f["extension"]);
							$isim_s[$key] = $uzanti_f["filename"]."_".(substr(md5(rand()),0,5).".".$uzanti);
							@copy($_FILES["slider_resim_$key"]["tmp_name"],$file_upload_path.$isim_s[$key]);
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
							$isim_s[$key] = "";
						}
				}
				
					$ekle_veri = $db->prepare("INSERT INTO $dt_table(sira, resim_tr, baslik_tr, baslik_en,link, resim_en) SELECT (MAX(sira)+1) AS sira,:resim_tr AS resim_tr,:baslik_tr AS baslik_tr, :baslik_en AS baslik_en, :link AS link, :resim_en AS resim_en FROM $dt_table");


					$ekle_veri->bindValue(":resim_tr",$isim_s["tr"]); 
					$ekle_veri->bindValue(":resim_en",$isim_s["en"]);

					$ekle_veri->bindValue(":baslik_tr",$baslik_tr);
					$ekle_veri->bindValue(":baslik_en",$baslik_en); 
				
					$ekle_veri->bindValue(":link",$link); 
				
					$ekle_veri->execute() or die(print_r($ekle_veri->errorInfo(),true));

					if($ekle_veri->rowCount()>0){
							?>

				  <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                    Slider başarıyla eklendi listeden detaylı görüntüleme yapabilirsiniz.
                  </div>
							<?php

					}else{
						?>
							<div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
                   Slider eklenemiyor lütfen yetkililere sorun hakkında bilgilendirme yapınız.
                  </div>
						<?php
					}

		}else if($sid != 0 && @$islem != "sil"){

				$isim_s = array();
				$sor_slider_bilgileri = $db->prepare("SELECT * FROM $dt_table WHERE id=:id");
				$sor_slider_bilgileri->bindValue(":id",$sid);
				$sor_slider_bilgileri->execute();


				$slider_bilgi = $sor_slider_bilgileri->fetch();

				foreach ($dil_text as $key => $value) {
						if(!empty($_FILES["slider_resim_$key"]["name"])){
							if(format_kontrol_resim($_FILES["slider_resim_$key"]["tmp_name"])){
							$uzanti_f = pathinfo($_FILES["slider_resim_$key"]["name"]);
							$uzanti = strtolower($uzanti_f["extension"]);
							$isim_s[$key] = $uzanti_f["filename"]."_".(substr(md5(rand()),0,5).".".$uzanti);
							@copy($_FILES["slider_resim_$key"]["tmp_name"],$file_upload_path.$isim_s[$key]);
							@unlink($file_upload_path.$slider_bilgi["resim_".$key]);
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
							$isim_s[$key] = $slider_bilgi["resim_".$key];
						}
				}
				
				$ekle_veri = $db->prepare("UPDATE $dt_table SET resim_tr=:resim_tr,baslik_tr=:baslik_tr,baslik_en=:baslik_en,link=:link,resim_en=:resim_en WHERE id=:id");


					$ekle_veri->bindValue(":resim_tr",$isim_s["tr"]); 
					$ekle_veri->bindValue(":resim_en",$isim_s["en"]);
				

					$ekle_veri->bindValue(":baslik_tr",$baslik_tr);
					$ekle_veri->bindValue(":baslik_en",$baslik_en); 
					

					

					$ekle_veri->bindValue(":link",$link); 
					$ekle_veri->bindValue(":id",$sid); 
				


					$ekle_veri->execute();

					if($ekle_veri->rowCount()>0){
							?>

				  <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                    Slider başarıyla güncellendi listeden detaylı görüntüleme yapabilirsiniz.
                  </div>
							<?php

					}else{
							print_r($isim_s);
						?>
							<div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
                   	Slider güncellenemedi lütfen yetkililere sorun hakkında bilgilendirme yapınız.
                  </div>
						<?php
					}


		}else{
				$sor_slider_bilgileri = $db->prepare("SELECT * FROM $dt_table WHERE id=:id");
				$sor_slider_bilgileri->bindValue(":id",$sid);
				$sor_slider_bilgileri->execute();


				$slider_bilgi = $sor_slider_bilgileri->fetch();
				foreach ($dil_text as $key => $value) {
					@unlink($file_upload_path.$slider_bilgi["resim_".$key]);
				}

				$sil = $db->prepare("DELETE FROM $dt_table WHERE id=:id");
				$sil->bindValue(":id",$sid);
				$sil->execute();


					$upd = $db->prepare("UPDATE $dt_table SET sira=sira-1 WHERE sira>=:sira AND sira>1");
					$upd->bindValue(":sira",$slider_bilgi["sira"]);
					$upd->execute();
						?>
					 <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                    Slider başarıyla slindi listeden detaylı görüntüleme yapabilirsiniz.
                  </div>
						<?php

		}
?>