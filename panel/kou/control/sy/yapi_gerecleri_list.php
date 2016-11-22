<?php 
  require_once "../config/global_cont.php";

extract($_GET);
extract($_POST);


	if($sid == 0 && @$islem!="sil"){
				$katalog_name 		= array();
				$katalog_resim_name = array();
				$urun_adi = array();
				$aciklama = array();
				foreach ($dil_text as $key => $value) {
						if(!empty($_FILES["katalog_$key"]["name"])){
							if(format_kontrol_office($_FILES["katalog_$key"]["tmp_name"])){
								$uzanti_f = pathinfo($_FILES["katalog_$key"]["name"]);
								$uzanti = strtolower($uzanti_f["extension"]);
								$katalog_name[$key] = $uzanti_f["filename"]."_".(substr(md5(rand()),0,5).".".$uzanti);
								@copy($_FILES["katalog_$key"]["tmp_name"],$katalog_path.$katalog_name[$key]);
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
							$katalog_name[$key] = "";
						}


						if(!empty($_FILES["katalog_gorsel_$key"]["name"])){
								if(format_kontrol_resim($_FILES["katalog_gorsel_$key"]["tmp_name"])){
									$uzanti_f = pathinfo($_FILES["katalog_gorsel_$key"]["name"]);
									$uzanti = strtolower($uzanti_f["extension"]);
									$katalog_resim_name[$key] = $uzanti_f["filename"]."_".(substr(md5(rand()),0,5).".".$uzanti);
									@copy($_FILES["katalog_gorsel_$key"]["tmp_name"],$file_upload_path.$katalog_resim_name[$key]);
								}else{
									?>
									  <div class="alert alert-warning alert-dismissable">
					                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
					                   Lütfen katalog resmi için jpg,png,gif,bmp Formatında bir resim ekleyiniz.
					                  </div>
									<?php
									exit;
								}
						}else{
							$katalog_resim_name[$key] = "";
						}

					if($_POST["urunadi_".$key] != ""){
						$urun_adi[$key] = $_POST["urunadi_".$key];
					}else{
						$urun_adi[$key] = "";
					}
					if($_POST["aciklama_".$key] != ""){
						$aciklama[$key] = $_POST["aciklama_".$key];
					}else{
						$aciklama[$key] = "";
					}
				}
				

					if(!empty($_FILES["resim"]["name"])){
							if(format_kontrol_resim($_FILES["resim"]["tmp_name"])){
								$uzanti_f = pathinfo($_FILES["resim"]["name"]);
								$uzanti = strtolower($uzanti_f["extension"]);
								$urun_resim = $uzanti_f["filename"]."_".(substr(md5(rand()),0,5).".".$uzanti);
								@copy($_FILES["resim"]["tmp_name"],$file_upload_path.$urun_resim);
							}else{
								?>
								   <div class="alert alert-warning alert-dismissable">
				                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
				                   Lütfen ürün resmi için jpg,png,gif,bmp Formatında bir resim ekleyiniz.
				                  </div>
								<?php
								exit;
							}
						}else{
							$urun_resim = "";
						}
				
						if(!empty($_FILES["logo"]["name"])){
							if(format_kontrol_resim($_FILES["logo"]["tmp_name"])){
								$uzanti_f = pathinfo($_FILES["logo"]["name"]);
								$uzanti = strtolower($uzanti_f["extension"]);
								$urun_logo = $uzanti_f["filename"]."_".(substr(md5(rand()),0,5).".".$uzanti);
								@copy($_FILES["logo"]["tmp_name"],$file_upload_path.$urun_logo);
							}else{
								?>
								   <div class="alert alert-warning alert-dismissable">
				                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
				                   Lütfen logo için jpg,png,gif,bmp Formatında bir resim ekleyiniz.
				                  </div>
								<?php
								exit;
							}
						}else{
							$urun_logo = "";
						}

				$ekle_veri = $db->prepare("INSERT INTO yapigerecleri(kid, sra, resim, logo, katalog_tr, katalog_en, katalog_de, katalog_es, katalog_fr, katalog_ru, katalog_it, urunAdi_tr, urunAdi_en, urunAdi_de, urunAdi_es, urunAdi_fr, urunAdi_ru, urunAdi_it, aciklama_tr, aciklama_en, aciklama_de, aciklama_es, aciklama_fr, aciklama_ru, aciklama_it, katalogResim_tr, katalogResim_en, katalogResim_de, katalogResim_es, katalogResim_fr, katalogResim_ru, katalogResim_it) SELECT 1 as kid,(MAX(sra)+1) as sra,:resim as resim,:logo as logo, :katalog_tr as katalog_tr, :katalog_en as katalog_en, :katalog_de as katalog_de, :katalog_es as katalog_es, :katalog_fr as katalog_fr, :katalog_ru as katalog_ru, :katalog_it as katalog_it, :urunAdi_tr as urunAdi_tr,:urunAdi_en as urunAdi_en,:urunAdi_de as urunAdi_de,:urunAdi_es as urunAdi_es,:urunAdi_fr as urunAdi_fr,:urunAdi_ru as urunAdi_ru,:urunAdi_it as urunAdi_it,:aciklama_tr as aciklama_tr,:aciklama_en as aciklama_en,:aciklama_de as aciklama_de,:aciklama_es as aciklama_es,:aciklama_fr as aciklama_fr,:aciklama_ru as aciklama_ru,:aciklama_it as aciklama_it,:katalogResim_tr as katalogResim_tr,:katalogResim_en as katalogResim_en,:katalogResim_de as katalogResim_de, :katalogResim_es as katalogResim_es, :katalogResim_fr as katalogResim_fr, :katalogResim_ru as katalogResim_ru, :katalogResim_it as katalogResim_it FROM yapigerecleri");


					$ekle_veri->bindValue(":logo",$urun_logo);
					$ekle_veri->bindValue(":resim",$urun_resim);
					foreach ($dil_text as $key => $value) {
						$ekle_veri->bindValue(":katalog_".$key,$katalog_name[$key]);
						$ekle_veri->bindValue(":urunAdi_".$key,$urun_adi[$key]);
						$ekle_veri->bindValue(":aciklama_".$key,$aciklama[$key]);
						$ekle_veri->bindValue(":katalogResim_".$key,$katalog_resim_name[$key]);
					}
		

					$ekle_veri->execute();

					if($ekle_veri->rowCount()>0){
							?>

				  <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                    Yapıgereçleri başarıyla eklendi listeden detaylı görüntüleme yapabilirsiniz.
                  </div>
							<?php

					}else{
						?>
							<div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
                   Yapıgereçleri eklenemiyor lütfen yetkililere sorun hakkında bilgilendirme yapınız.
                  </div>
						<?php
					}

		}else if($sid != 0 && @$islem != "sil"){
				

				$katalog_name 		= array();
				$katalog_resim_name = array();
				$urun_adi = array();
				$aciklama = array();
				$ek = "";
				foreach ($dil_text as $key => $value) {
						if(!empty($_FILES["katalog_$key"]["name"])){
							if(format_kontrol_office($_FILES["katalog_$key"]["tmp_name"])){
								$uzanti_f = pathinfo($_FILES["katalog_$key"]["name"]);
								$uzanti = strtolower($uzanti_f["extension"]);
								$katalog_name[$key] = $uzanti_f["filename"]."_".(substr(md5(rand()),0,5).".".$uzanti);
								@copy($_FILES["katalog_$key"]["tmp_name"],$katalog_path.$katalog_name[$key]);

								$ek .= (",katalog_".$key."=:katalog_".$key);
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
							$katalog_name[$key] = "";
						}


						if(!empty($_FILES["katalog_gorsel_$key"]["name"])){
								if(format_kontrol_resim($_FILES["katalog_gorsel_$key"]["tmp_name"])){
									$uzanti_f = pathinfo($_FILES["katalog_gorsel_$key"]["name"]);
									$uzanti = strtolower($uzanti_f["extension"]);
									$katalog_resim_name[$key] = $uzanti_f["filename"]."_".(substr(md5(rand()),0,5).".".$uzanti);
									@copy($_FILES["katalog_gorsel_$key"]["tmp_name"],$file_upload_path.$katalog_resim_name[$key]);
									$ek .= (",katalogResim_".$key."=:katalogResim_".$key);

								}else{
									?>
									  <div class="alert alert-warning alert-dismissable">
					                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
					                   Lütfen katalog resmi için jpg,png,gif,bmp Formatında bir resim ekleyiniz.
					                  </div>
									<?php
									exit;
								}
						}else{
							$katalog_resim_name[$key] = "";
						}

					if($_POST["urunadi_".$key] != ""){
						$urun_adi[$key] = $_POST["urunadi_".$key];

						$ek .= (",urunAdi_".$key."=:urunAdi_".$key);
					}else{
						$urun_adi[$key] = "";
					}
					if($_POST["aciklama_".$key] != ""){
						$aciklama[$key] = $_POST["aciklama_".$key];
						$ek .= (",aciklama_".$key."=:aciklama_".$key);
					}else{
						$aciklama[$key] = "";
					}	
				}
				

					if(!empty($_FILES["resim"]["name"])){
							if(format_kontrol_resim($_FILES["resim"]["tmp_name"])){
								$uzanti_f = pathinfo($_FILES["resim"]["name"]);
								$uzanti = strtolower($uzanti_f["extension"]);
								$urun_resim = $uzanti_f["filename"]."_".(substr(md5(rand()),0,5).".".$uzanti);
								@copy($_FILES["resim"]["tmp_name"],$file_upload_path.$urun_resim);
								$ek .= ",resim=:resim";
							}else{
								?>
								   <div class="alert alert-warning alert-dismissable">
				                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
				                   Lütfen ürün resmi için jpg,png,gif,bmp Formatında bir resim ekleyiniz.
				                  </div>
								<?php
								exit;
							}
						}else{
							$urun_resim = "";
						}
				
						if(!empty($_FILES["logo"]["name"])){
							if(format_kontrol_resim($_FILES["logo"]["tmp_name"])){
								$uzanti_f = pathinfo($_FILES["logo"]["name"]);
								$uzanti = strtolower($uzanti_f["extension"]);
								$urun_logo = $uzanti_f["filename"]."_".(substr(md5(rand()),0,5).".".$uzanti);
								@copy($_FILES["logo"]["tmp_name"],$file_upload_path.$urun_logo);
								$ek .= ",logo=:logo";
							}else{
								?>
								   <div class="alert alert-warning alert-dismissable">
				                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
				                   Lütfen logo için jpg,png,gif,bmp Formatında bir resim ekleyiniz.
				                  </div>
								<?php
								exit;
							}
						}else{
							$urun_logo = "";
						}



		/*$ekle_veri = $db->prepare("INSERT INTO yapigerecleri(kid, sra, resim, logo, katalog_tr, katalog_en, katalog_de, katalog_es, katalog_fr, katalog_ru, katalog_it, urunAdi_tr, urunAdi_en, urunAdi_de, urunAdi_es, urunAdi_fr, urunAdi_ru, urunAdi_it, aciklama_tr, aciklama_en, aciklama_de, aciklama_es, aciklama_fr, aciklama_ru, aciklama_it, katalogResim_tr, katalogResim_en, katalogResim_de, katalogResim_es, katalogResim_fr, katalogResim_ru, katalogResim_it) SELECT 1 as kid,(MAX(sra)+1) as sra,:resim as resim,:logo as logo, :katalog_tr as katalog_tr, :katalog_en as katalog_en, :katalog_de as katalog_de, :katalog_es as katalog_es, :katalog_fr as katalog_fr, :katalog_ru as katalog_ru, :katalog_it as katalog_it, :urunAdi_tr as urunAdi_tr,:urunAdi_en as urunAdi_en,:urunAdi_de as urunAdi_de,:urunAdi_es as urunAdi_es,:urunAdi_fr as urunAdi_fr,:urunAdi_ru as urunAdi_ru,:urunAdi_it as urunAdi_it,:aciklama_tr as aciklama_tr,:aciklama_en as aciklama_en,:aciklama_de as aciklama_de,:aciklama_es as aciklama_es,:aciklama_fr as aciklama_fr,:aciklama_ru as aciklama_ru,:aciklama_it as aciklama_it,:katalogResim_tr as katalogResim_tr,:katalogResim_en as katalogResim_en,:katalogResim_de as katalogResim_de, :katalogResim_es as katalogResim_es, :katalogResim_fr as katalogResim_fr, :katalogResim_ru as katalogResim_ru, :katalogResim_it as katalogResim_it FROM yapigerecleri");*/


		/*
				$katalog_name 		= array();
				$katalog_resim_name = array();
				$urun_adi = array();
				$aciklama = array();
		*/
					$ek = substr($ek,1);

					/*foreach ($dil_text as $key => $value) {
						$ek .= ($katalog_name[$key]!=)?("katalog_".$key):NULL;
					}*/
					
					$ekle_veri = $db->prepare("UPDATE yapigerecleri SET $ek WHERE id=:sid");

					$ekle_veri->bindValue(":sid",$sid);

					if($urun_logo != ""){
						$ekle_veri->bindValue(":logo",$urun_logo);
					}

					if($urun_resim != ""){
						$ekle_veri->bindValue(":resim",$urun_resim);
					}
					
					foreach ($dil_text as $key => $value) {
						if($katalog_name[$key] != "")
						$ekle_veri->bindValue(":katalog_".$key,$katalog_name[$key]);

						if($urun_adi[$key])
						$ekle_veri->bindValue(":urunAdi_".$key,$urun_adi[$key]);

						if($aciklama[$key])
						$ekle_veri->bindValue(":aciklama_".$key,$aciklama[$key]);

						if($katalog_resim_name[$key])
						$ekle_veri->bindValue(":katalogResim_".$key,$katalog_resim_name[$key]);
					}
		

					$ekle_veri->execute();

					if($ekle_veri->rowCount()>0){
							?>
				  <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                    Yapıgereçleri başarıyla güncellendi listeden detaylı görüntüleme yapabilirsiniz.
                  </div>
							<?php

					}else{
							print_r($isim_s);
						?>
							<div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
                   	Yapıgereçleri güncellenemedi lütfen yetkililere sorun hakkında bilgilendirme yapınız.
                  </div>
						<?php
					}
		}else{  /// yapı gereçleri altındaki slider slincek ve ona ait tüm bilgiler bunuda unutma
				$sor_slider_bilgileri = $db->prepare("SELECT * FROM yapigerecleri WHERE id=:id");
				$sor_slider_bilgileri->bindValue(":id",$sid);
				$sor_slider_bilgileri->execute();
//resim : = 17 katalog = 11

				$slider_bilgi = $sor_slider_bilgileri->fetch();
				foreach ($dil_text as $key => $value) {
					@unlink($katalog_path.$slider_bilgi["katalog_".$key]);
					@unlink($file_upload_path.$slider_bilgi["katalogResim_".$key]);
				}
					@unlink($file_upload_path.$slider_bilgi["logo"]);
					@unlink($file_upload_path.$slider_bilgi["resim"]);

					$sil = $db->prepare("DELETE FROM yapigerecleri WHERE id=:id");
					$sil->bindValue(":id",$sid);
					$sil->execute();


					$upd = $db->prepare("UPDATE yapigerecleri SET sra=sra-1 WHERE sra>=:sra AND sra>1");
					$upd->bindValue(":sra",$slider_bilgi["sra"]);
					$upd->execute();
						?>
					 <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                    Yapıgereçleri başarıyla slindi listeden detaylı görüntüleme yapabilirsiniz.
                  </div>
						<?php


		}


?>