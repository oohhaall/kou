<?php 
  require_once "../config/global_cont.php";
		
	extract($_GET);
	extract($_POST);
		
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
				
					$ekle_veri = $db->prepare("INSERT INTO slayt(sra, resim_tr, baslik_tr, baslik_en, baslik_de, baslik_es, baslik_fr, baslik_ru, baslik_it, aciklama_tr, aciklama_en, aciklama_de, aciklama_es, aciklama_fr, aciklama_ru, aciklama_it, link, resim_en, resim_de, resim_es, resim_fr, resim_ru, resim_it) SELECT (MAX(sra)+1) AS sra,:resim_tr AS resim_tr,:baslik_tr AS baslik_tr, :baslik_en AS baslik_en, :baslik_de AS baslik_de, :baslik_es AS baslik_es, :baslik_fr AS baslik_fr, :baslik_ru AS baslik_ru, :baslik_it AS baslik_it, :aciklama_tr AS aciklama_tr, :aciklama_en AS aciklama_en, :aciklama_de AS aciklama_de, :aciklama_es AS aciklama_es, :aciklama_fr AS aciklama_fr, :aciklama_ru AS aciklama_ru, :aciklama_it AS aciklama_it, :link AS link, :resim_en AS resim_en, :resim_de AS resim_de, :resim_es AS resim_es, :resim_fr AS resim_fr, :resim_ru AS resim_ru, :resim_it AS resim_it FROM slayt");


					$ekle_veri->bindValue(":resim_tr",$isim_s["tr"]); 
					$ekle_veri->bindValue(":baslik_tr",$baslik_tr);
					$ekle_veri->bindValue(":baslik_en",$baslik_en); 
					$ekle_veri->bindValue(":baslik_de",$baslik_de);
					$ekle_veri->bindValue(":baslik_es",$baslik_es);
					$ekle_veri->bindValue(":baslik_fr",$baslik_fr);
					$ekle_veri->bindValue(":baslik_ru",$baslik_ru);
					$ekle_veri->bindValue(":baslik_it",$baslik_it);
					$ekle_veri->bindValue(":aciklama_tr",$aciklama_tr);
					$ekle_veri->bindValue(":aciklama_en",$aciklama_en);
					$ekle_veri->bindValue(":aciklama_de",$aciklama_de);
					$ekle_veri->bindValue(":aciklama_es",$aciklama_es);
					$ekle_veri->bindValue(":aciklama_fr",$aciklama_fr); 
					$ekle_veri->bindValue(":aciklama_ru",$aciklama_ru); 
					$ekle_veri->bindValue(":aciklama_it",$aciklama_it);
					$ekle_veri->bindValue(":link",$link); 
					$ekle_veri->bindValue(":resim_en",$isim_s["en"]);
					$ekle_veri->bindValue(":resim_de",$isim_s["de"]); 
					$ekle_veri->bindValue(":resim_es",$isim_s["es"]);
					$ekle_veri->bindValue(":resim_fr",$isim_s["fr"]);
					$ekle_veri->bindValue(":resim_ru",$isim_s["ru"]); 
					$ekle_veri->bindValue(":resim_it",$isim_s["it"]); 
					$ekle_veri->execute();

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

		}else if($sid != 0 && $islem != "sil"){

				$isim_s = array();
				$sor_slider_bilgileri = $db->prepare("SELECT * FROM slayt WHERE id=:id");
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
				
				$ekle_veri = $db->prepare("UPDATE slayt SET resim_tr=:resim_tr,baslik_tr=:baslik_tr,baslik_en=:baslik_en,baslik_de=:baslik_de,baslik_es=:baslik_es,baslik_fr=:baslik_fr,baslik_ru=:baslik_ru,baslik_it=:baslik_it,aciklama_tr=:aciklama_tr,aciklama_en=:aciklama_en,aciklama_de=:aciklama_de,aciklama_es=:aciklama_es,aciklama_fr=:aciklama_fr,aciklama_ru=:aciklama_ru,aciklama_it=:aciklama_it,link=:link,resim_en=:resim_en,resim_de=:resim_de,resim_es=:resim_es,resim_fr=:resim_fr,resim_ru=:resim_ru,resim_it=:resim_it WHERE id=:id");


					$ekle_veri->bindValue(":resim_tr",$isim_s["tr"]); 
					$ekle_veri->bindValue(":resim_en",$isim_s["en"]);
					$ekle_veri->bindValue(":resim_de",$isim_s["de"]); 
					$ekle_veri->bindValue(":resim_es",$isim_s["es"]);
					$ekle_veri->bindValue(":resim_fr",$isim_s["fr"]);
					$ekle_veri->bindValue(":resim_ru",$isim_s["ru"]); 
					$ekle_veri->bindValue(":resim_it",$isim_s["it"]); 

					$ekle_veri->bindValue(":baslik_tr",$baslik_tr);
					$ekle_veri->bindValue(":baslik_en",$baslik_en); 
					$ekle_veri->bindValue(":baslik_de",$baslik_de);
					$ekle_veri->bindValue(":baslik_es",$baslik_es);
					$ekle_veri->bindValue(":baslik_fr",$baslik_fr);
					$ekle_veri->bindValue(":baslik_ru",$baslik_ru);
					$ekle_veri->bindValue(":baslik_it",$baslik_it);

					$ekle_veri->bindValue(":aciklama_tr",$aciklama_tr);
					$ekle_veri->bindValue(":aciklama_en",$aciklama_en);
					$ekle_veri->bindValue(":aciklama_de",$aciklama_de);
					$ekle_veri->bindValue(":aciklama_es",$aciklama_es);
					$ekle_veri->bindValue(":aciklama_fr",$aciklama_fr); 
					$ekle_veri->bindValue(":aciklama_ru",$aciklama_ru); 
					$ekle_veri->bindValue(":aciklama_it",$aciklama_it);

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
				$sor_slider_bilgileri = $db->prepare("SELECT * FROM slayt WHERE id=:id");
				$sor_slider_bilgileri->bindValue(":id",$sid);
				$sor_slider_bilgileri->execute();


				$slider_bilgi = $sor_slider_bilgileri->fetch();
				foreach ($dil_text as $key => $value) {
					@unlink($file_upload_path.$slider_bilgi["resim_".$key]);
				}

				$sil = $db->prepare("DELETE FROM slayt WHERE id=:id");
				$sil->bindValue(":id",$sid);
				$sil->execute();


					$upd = $db->prepare("UPDATE slayt SET sra=sra-1 WHERE sra>=:sra AND sra>1");
					$upd->bindValue(":sra",$slider_bilgi["sra"]);
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