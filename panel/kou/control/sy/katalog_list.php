<?php 
  require_once "../config/global_cont.php";
		
	extract($_GET);
	extract($_POST);
		/*print_r($_POST);
		print_r($_FILES);*/

		if($sid == 0 && @$islem!="sil"){
		$tarih = date("Y-m-d",strtotime(str_replace("/","-",$tarih)));

				$isim_s = "";
				//foreach ($dil_text as $key => $value) {
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
							$kat = "";

						if(!empty($_FILES["pdf"]["name"])){
							if(format_kontrol_office($_FILES["pdf"]["tmp_name"])){
							$uzanti_f = pathinfo($_FILES["pdf"]["name"]);
							$uzanti = strtolower($uzanti_f["extension"]);
							$kat = (substr(md5(rand()),0,10).".".$uzanti);
							@copy($_FILES["pdf"]["tmp_name"],$katalog_path.$kat);
						}else{
							?>
				<div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
				                   Lütfen katalog için pdf,doc,docx,ppt,pptx,xls,xlsx Formatında bir dosya ekleyiniz.
                  </div>
							<?php
							exit;
						}
						}else{
							$kat = "";
						}
				//}
				
			$ekle_veri = $db->prepare("INSERT INTO katalog(sra, resim, baslik_tr, baslik_en, baslik_de, baslik_es, baslik_fr, baslik_ru, baslik_it,tarih,pdf) SELECT (MAX(sra)+1) AS sra,:resim AS resim,:baslik_tr AS baslik_tr, :baslik_en AS baslik_en, :baslik_de AS baslik_de, :baslik_es AS baslik_es, :baslik_fr AS baslik_fr, :baslik_ru AS baslik_ru, :baslik_it AS baslik_it,:tarih AS tarih,:pdf as pdf FROM katalog");
					$ekle_veri->bindValue(":resim",$isim_s);
					$ekle_veri->bindValue(":pdf",$kat);
					$ekle_veri->bindValue(":tarih",$tarih);
						foreach ($dil_text as $key => $value) {
							$ekle_veri->bindValue(":baslik_".$key,$_POST["baslik_".$key]);
						}

					$ekle_veri->execute();

					if($ekle_veri->rowCount()>0){
							?>

				  <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                    Katalog başarıyla eklendi listeden detaylı görüntüleme yapabilirsiniz.
                  </div>
							<?php

					}else{
						?>
							<div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
                   Katalog eklenemiyor lütfen yetkililere sorun hakkında bilgilendirme yapınız.
                  </div>
						<?php
					}

		}else if($sid != 0 && @$islem != "sil"){
		$tarih = date("Y-m-d",strtotime(str_replace("/","-",$tarih)));
					
				$isim_s = array();
				$sor_slider_bilgileri = $db->prepare("SELECT * FROM katalog WHERE id=:id");
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
							$kat = "";

						if(!empty($_FILES["pdf"]["name"])){
							if(format_kontrol_office($_FILES["pdf"]["tmp_name"])){
							$uzanti_f = pathinfo($_FILES["pdf"]["name"]);
							$uzanti = strtolower($uzanti_f["extension"]);
							$kat = (substr(md5(rand()),0,10).".".$uzanti);
							@copy($_FILES["pdf"]["tmp_name"],$katalog_path.$kat);
						}else{
							?>
					<div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
				        Lütfen katalog için pdf,doc,docx,ppt,pptx,xls,xlsx Formatında bir dosya ekleyiniz.
                  	</div>
							<?php
							exit;
						}
						}else{
							$kat = $slider_bilgi["pdf"];
						}
				
				$ekle_veri = $db->prepare("UPDATE katalog SET resim=:resim,baslik_tr=:baslik_tr,baslik_en=:baslik_en,baslik_de=:baslik_de,baslik_es=:baslik_es,baslik_fr=:baslik_fr,baslik_ru=:baslik_ru,baslik_it=:baslik_it,pdf=:pdf,tarih=:tarih WHERE id=:id");

					$ekle_veri->bindValue(":resim",$isim_s);
					$ekle_veri->bindValue(":pdf",$kat);
					$ekle_veri->bindValue(":id",$sid);
					$ekle_veri->bindValue(":tarih",$tarih);

						foreach ($dil_text as $key => $value) {
							$ekle_veri->bindValue(":baslik_".$key,$_POST["baslik_".$key]);
						}

					$ekle_veri->execute();


					if($ekle_veri->rowCount()>0){
							?>

				  <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                    Katalog başarıyla güncellendi listeden detaylı görüntüleme yapabilirsiniz.
                  </div>
							<?php

					}else{
						//	print_r($isim_s);
						?>
							<div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
                   	Katalog güncellenemedi lütfen yetkililere sorun hakkında bilgilendirme yapınız.
                  </div>
						<?php
					}


		}else{
				$sor_slider_bilgileri = $db->prepare("SELECT * FROM katalog WHERE id=:id");
				$sor_slider_bilgileri->bindValue(":id",$sid);
				$sor_slider_bilgileri->execute();


				$slider_bilgi = $sor_slider_bilgileri->fetch();
				foreach ($dil_text as $key => $value) {
					@unlink($file_upload_path.$slider_bilgi["resim"]);
					@unlink($katalog_path.$slider_bilgi["pdf"]);
				}

				$sil = $db->prepare("DELETE FROM katalog WHERE id=:id");
				$sil->bindValue(":id",$sid);
				$sil->execute();


					$upd = $db->prepare("UPDATE katalog SET sra=sra-1 WHERE sra>=:sra AND sra>1");
					$upd->bindValue(":sra",$slider_bilgi["sra"]);
					$upd->execute();
						?>
					 <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                    Katalog başarıyla slindi listeden detaylı görüntüleme yapabilirsiniz.
                  </div>
						<?php

		}
?>