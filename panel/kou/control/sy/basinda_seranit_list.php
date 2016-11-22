<?php 
	require_once "../config/global_cont.php";
	extract($_POST);
	extract($_GET);

	$dt_table = "basindaseranit";
		if($sid == 0 && @$islem!="sil"){
			$tarih = date("Y-m-d",strtotime(str_replace("/","-",$tarih)));

				$isim_s = "";
						if(!empty($_FILES["slider_resim"]["name"])){
							if(format_kontrol_resim($_FILES["slider_resim"]["tmp_name"])){
							$uzanti_f = pathinfo($_FILES["slider_resim"]["name"]);
							$uzanti = strtolower($uzanti_f["extension"]);
							$isim_s = (substr(md5(rand()),0,10).".".$uzanti);
							@copy($_FILES["slider_resim"]["tmp_name"],$file_upload_path.$isim_s);
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
							
		
			
				

			$ekle_veri = $db->prepare("INSERT INTO $dt_table(resim, tarih) VALUES (:resim,:tarih)");
					$ekle_veri->bindValue(":resim",$isim_s);
					$ekle_veri->bindValue(":tarih",$tarih);

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

		}else if($sid != 0 && @$islem != "sil"){
				$tarih = date("Y-m-d",strtotime(str_replace("/","-",$tarih)));
					
				$isim_s = array();
				$sor_slider_bilgileri = $db->prepare("SELECT * FROM basindaseranit WHERE id=:id");
				$sor_slider_bilgileri->bindValue(":id",$sid);
				$sor_slider_bilgileri->execute();


				$slider_bilgi = $sor_slider_bilgileri->fetch();

					$isim_s = "";
				//foreach ($dil_text as $key => $value) {
						if(!empty($_FILES["slider_resim"]["name"])){
							if(format_kontrol_resim($_FILES["slider_resim"]["tmp_name"])){
							$uzanti_f = pathinfo($_FILES["slider_resim"]["name"]);
							$uzanti = strtolower($uzanti_f["extension"]);
							$isim_s = (substr(md5(rand()),0,10).".".$uzanti);
							@unlink($file_upload_path.$slider_bilgi["resim"]);
							@copy($_FILES["slider_resim"]["tmp_name"],$file_upload_path.$isim_s);
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
							$isim_s = $slider_bilgi["resim"];
						}
							
					$ekle_veri = $db->prepare("UPDATE $dt_table SET resim=:resim,tarih=:tarih WHERE id=:id");

					$ekle_veri->bindValue(":resim",$isim_s);
					$ekle_veri->bindValue(":id",$sid);
					$ekle_veri->bindValue(":tarih",$tarih);



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
						//	print_r($isim_s);
						?>
							<div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
                   	İçerik güncellenemedi lütfen yetkililere sorun hakkında bilgilendirme yapınız.
                  </div>
						<?php
					}


		}else{
				$sor_slider_bilgileri = $db->prepare("SELECT * FROM $dt_table WHERE id=:id");
				$sor_slider_bilgileri->bindValue(":id",$sid);
				$sor_slider_bilgileri->execute();

				$slider_bilgi = $sor_slider_bilgileri->fetch();
				
					@unlink($file_upload_path.$slider_bilgi["resim"]);
				

				$sil = $db->prepare("DELETE FROM $dt_table WHERE id=:id");
				$sil->bindValue(":id",$sid);
				$sil->execute();


				
						?>
					 <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                    İçerik başarıyla slindi listeden detaylı görüntüleme yapabilirsiniz.
                  </div>
						<?php

		}

?>