<?php 
  require_once "../config/global_cont.php";
		
	extract($_GET);
	extract($_POST);
	
if($sid == 0 && @$islem!="sil"){
				$kucuk_resim 		= array();
				$buyuk_resim = array();
				$baslik = array();
				$detay = array();
				$alt_baslik = array();

				foreach ($dil_text as $key => $value) {
						if(!empty($_FILES["slider_resim_kucuk_$key"]["name"])){
							if(format_kontrol_resim($_FILES["slider_resim_kucuk_$key"]["tmp_name"])){
								$uzanti_f = pathinfo($_FILES["slider_resim_kucuk_$key"]["name"]);
								$uzanti = strtolower($uzanti_f["extension"]);
								$kucuk_resim[$key] = $uzanti_f["filename"]."_".(substr(md5(rand()),0,5).".".$uzanti);
								@copy($_FILES["slider_resim_kucuk_$key"]["tmp_name"],$file_upload_path.$kucuk_resim[$key]);
							}else{
								?>
								   <div class="alert alert-warning alert-dismissable">
					                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
					                   Lütfen haber resmi için jpg,png,gif,bmp Formatında bir resim ekleyiniz.
					                  </div>
								<?php
								exit;
							}
						}else{
							$kucuk_resim[$key] = "";
						}


						if(!empty($_FILES["slider_resim_$key"]["name"])){
								if(format_kontrol_resim($_FILES["slider_resim_$key"]["tmp_name"])){
									$uzanti_f = pathinfo($_FILES["slider_resim_$key"]["name"]);
									$uzanti = strtolower($uzanti_f["extension"]);
									$buyuk_resim[$key] = $uzanti_f["filename"]."_".(substr(md5(rand()),0,5).".".$uzanti);
									@copy($_FILES["slider_resim_$key"]["tmp_name"],$file_upload_path.$buyuk_resim[$key]);
								}else{
									?>
									  <div class="alert alert-warning alert-dismissable">
					                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
					                   Lütfen haber resmi için jpg,png,gif,bmp Formatında bir resim ekleyiniz.
					                  </div>
									<?php
									exit;
								}
						}else{
							$buyuk_resim[$key] = "";
						}

					if($_POST["baslik_".$key] != ""){
						$baslik[$key] = $_POST["baslik_".$key];
					}else{
						$baslik[$key] = "";
					}
					if($_POST["detay_".$key] != ""){
						$detay[$key] = $_POST["detay_".$key];
					}else{
						$detay[$key] = "";
					}

					if($_POST["altBaslik_".$key] != ""){
						$alt_baslik[$key] = $_POST["altBaslik_".$key];
					}else{
						$alt_baslik[$key] = "";
					}
				}
				

				$ekle_veri = $db->prepare("INSERT INTO haberler(tarih, kresim_tr, kresim_en, kresim_de, kresim_es, kresim_fr, kresim_ru, kresim_it, resim_tr, resim_en, resim_de, resim_es, resim_fr, resim_ru, resim_it, baslik_tr, baslik_en, baslik_de, baslik_es, baslik_fr, baslik_ru, baslik_it, altBaslik_tr, altBaslik_en, altBaslik_de, altBaslik_es, altBaslik_fr, altBaslik_ru, altBaslik_it, aciklama_tr, aciklama_en, aciklama_de, aciklama_es, aciklama_fr, aciklama_ru, aciklama_it) VALUES (:tarih, :kresim_tr, :kresim_en, :kresim_de, :kresim_es, :kresim_fr, :kresim_ru, :kresim_it, :resim_tr, :resim_en, :resim_de, :resim_es, :resim_fr, :resim_ru, :resim_it, :baslik_tr, :baslik_en, :baslik_de, :baslik_es, :baslik_fr, :baslik_ru, :baslik_it, :altBaslik_tr, :altBaslik_en, :altBaslik_de, :altBaslik_es, :altBaslik_fr, :altBaslik_ru, :altBaslik_it, :aciklama_tr, :aciklama_en, :aciklama_de, :aciklama_es, :aciklama_fr, :aciklama_ru, :aciklama_it)");


					$ekle_veri->bindValue(":tarih",date("Y-m-d",strtotime(str_replace("/","-",$tarih))));
					foreach ($dil_text as $key => $value) {
						$ekle_veri->bindValue(":kresim_".$key,$kucuk_resim[$key]);
						$ekle_veri->bindValue(":resim_".$key,$buyuk_resim[$key]);
						$ekle_veri->bindValue(":baslik_".$key,$baslik[$key]);
						$ekle_veri->bindValue(":aciklama_".$key,$detay[$key]);
						$ekle_veri->bindValue(":altBaslik_".$key,$alt_baslik[$key]);

					}
		

					$ekle_veri->execute();// or die(print_r($ekle_veri->errorInfo(), true));

					if($ekle_veri->rowCount()>0){
							?>

				  <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                    Haberler başarıyla eklendi listeden detaylı görüntüleme yapabilirsiniz.
                  </div>
							<?php

					}else{
						?>
							<div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
                   Haberler eklenemiyor lütfen yetkililere sorun hakkında bilgilendirme yapınız.
                  </div>
						<?php
					}

		}else if($sid != 0 && @$islem != "sil"){
				

				$kucuk_resim = array();
				$buyuk_resim = array();
				$baslik = array();
				$detay = array();
				$alt_baslik = array();
				$sor_hab = $db->prepare("SELECT * FROM haberler WHERE id=:id");
				$sor_hab->bindValue(":id",$sid);
				$sor_hab->execute();
				$oku_haber_detay = $sor_hab->fetch();

				foreach ($dil_text as $key => $value) {
						if(!empty($_FILES["slider_resim_kucuk_$key"]["name"])){
							if(format_kontrol_resim($_FILES["slider_resim_kucuk_$key"]["tmp_name"])){
								$uzanti_f = pathinfo($_FILES["slider_resim_kucuk_$key"]["name"]);
								$uzanti = strtolower($uzanti_f["extension"]);
								$kucuk_resim[$key] = $uzanti_f["filename"]."_".(substr(md5(rand()),0,5).".".$uzanti);
								@copy($_FILES["slider_resim_kucuk_$key"]["tmp_name"],$file_upload_path.$kucuk_resim[$key]);
								@unlink($file_upload_path.$oku_haber_detay["kresim_".$key]);
							}else{
								?>
								   <div class="alert alert-warning alert-dismissable">
					                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
					                   Lütfen haber resmi için jpg,png,gif,bmp Formatında bir resim ekleyiniz.
					                  </div>
								<?php
								exit;
							}
						}else{
							$kucuk_resim[$key] = $oku_haber_detay["kresim_".$key];
						}


						if(!empty($_FILES["slider_resim_$key"]["name"])){
								if(format_kontrol_resim($_FILES["slider_resim_$key"]["tmp_name"])){
									$uzanti_f = pathinfo($_FILES["slider_resim_$key"]["name"]);
									$uzanti = strtolower($uzanti_f["extension"]);
									$buyuk_resim[$key] = $uzanti_f["filename"]."_".(substr(md5(rand()),0,5).".".$uzanti);
									@copy($_FILES["slider_resim_$key"]["tmp_name"],$file_upload_path.$buyuk_resim[$key]);
									@unlink($file_upload_path.$oku_haber_detay["resim_".$key]);

								}else{
									?>
									  <div class="alert alert-warning alert-dismissable">
					                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
					                   Lütfen haber resmi için jpg,png,gif,bmp Formatında bir resim ekleyiniz.
					                  </div>
									<?php
									exit;
								}
						}else{
							$buyuk_resim[$key] = $oku_haber_detay["resim_".$key];;
						}

					if($_POST["baslik_".$key] != ""){
						$baslik[$key] = $_POST["baslik_".$key];
					}else{
						$baslik[$key] = $oku_haber_detay["baslik_".$key];
					}
					if($_POST["detay_".$key] != ""){
						$detay[$key] = $_POST["detay_".$key];
					}else{
						$detay[$key] =$oku_haber_detay["aciklama_".$key];
					}

					if($_POST["altBaslik_".$key] != ""){
						$alt_baslik[$key] = $_POST["altBaslik_".$key];
					}else{
						$alt_baslik[$key] = $oku_haber_detay["altBaslik_".$key];
					}
				}
				


					$ekle_veri = $db->prepare("UPDATE haberler SET tarih=:tarih, kresim_tr=:kresim_tr, kresim_en=:kresim_en, kresim_de=:kresim_de, kresim_es=:kresim_es, kresim_fr=:kresim_fr, kresim_ru=:kresim_ru, kresim_it=:kresim_it, resim_tr=:resim_tr, resim_en=:resim_en, resim_de=:resim_de, resim_es=:resim_es, resim_fr=:resim_fr, resim_ru=:resim_ru, resim_it=:resim_it, baslik_tr=:baslik_tr, baslik_en=:baslik_en, baslik_de=:baslik_de, baslik_es=:baslik_es, baslik_fr=:baslik_fr, baslik_ru=:baslik_ru, baslik_it=:baslik_it, altBaslik_tr=:altBaslik_tr, altBaslik_en=:altBaslik_en, altBaslik_de=:altBaslik_de, altBaslik_es=:altBaslik_es, altBaslik_fr=:altBaslik_fr, altBaslik_ru=:altBaslik_ru, altBaslik_it=:altBaslik_it, aciklama_tr=:aciklama_tr, aciklama_en=:aciklama_en, aciklama_de=:aciklama_de, aciklama_es=:aciklama_es, aciklama_fr=:aciklama_fr, aciklama_ru=:aciklama_ru, aciklama_it=:aciklama_it WHERE id=:sid");

						$ekle_veri->bindValue(":sid",$sid);
						$ekle_veri->bindValue(":tarih",date("Y-m-d",strtotime(str_replace("/","-",$tarih))));
					foreach ($dil_text as $key => $value) {
						$ekle_veri->bindValue(":kresim_".$key,$kucuk_resim[$key]);
						$ekle_veri->bindValue(":resim_".$key,$buyuk_resim[$key]);
						$ekle_veri->bindValue(":baslik_".$key,$baslik[$key]);
						$ekle_veri->bindValue(":aciklama_".$key,$detay[$key]);
						$ekle_veri->bindValue(":altBaslik_".$key,$alt_baslik[$key]);
					}
		

					$ekle_veri->execute();

					if($ekle_veri->rowCount()>0){
							?>
				  <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                    Haberler başarıyla güncellendi listeden detaylı görüntüleme yapabilirsiniz.
                  </div>
							<?php

					}else{
							print_r($isim_s);
						?>
							<div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
                   	Haberler güncellenemedi lütfen yetkililere sorun hakkında bilgilendirme yapınız.
                  </div>
						<?php
					}
		}else{  /// yapı gereçleri altındaki slider slincek ve ona ait tüm bilgiler bunuda unutma

				$sor_slider_bilgileri = $db->prepare("SELECT * FROM haberler WHERE id=:id");
				$sor_slider_bilgileri->bindValue(":id",$sid);
				$sor_slider_bilgileri->execute();
				$slider_bilgi = $sor_slider_bilgileri->fetch();
				foreach ($dil_text as $key => $value) {
					@unlink($file_upload_path.$slider_bilgi["kresim_".$key]);
					@unlink($file_upload_path.$slider_bilgi["resim_".$key]);
				}
					$sil = $db->prepare("DELETE FROM haberler WHERE id=:id");
					$sil->bindValue(":id",$sid);
					$sil->execute();
						?>
					 <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                    Haberler başarıyla silindi listeden detaylı görüntüleme yapabilirsiniz.
                  </div>
						<?php


		}


?>