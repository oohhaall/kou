<?php 
	require_once "../config/global_cont.php";


	extract($_GET);
	extract($_POST);
		$dt_table = "duyurular";
		if($sid == 0 && @$islem!="sil"){

				$duyuru_ek = array();
				
					foreach ($dil_text as $key => $value) {
						if(!empty($_FILES["slider_resim_$key"]["name"])){
							if(format_kontrol_resim($_FILES["slider_resim_$key"]["tmp_name"]) || format_kontrol_zip($_FILES["slider_resim_$key"]["tmp_name"]) || format_kontrol_office($_FILES["slider_resim_$key"]["tmp_name"])){
								$uzanti_f = pathinfo($_FILES["slider_resim_$key"]["name"]);
								$uzanti = strtolower($uzanti_f["extension"]);
								$duyuru_ek[$key] = $uzanti_f["filename"]."_".(substr(md5(rand()),0,5).".".$uzanti);
								@copy($_FILES["slider_resim_$key"]["tmp_name"],$f_file_path.$duyuru_ek[$key]);
							}else{
								?>
								   <div class="alert alert-warning alert-dismissable">
					                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
					                   Lütfen ek için için jpg,png,gif,bmp Formatında bir resim veya bir zip,rar dosyası veya bir pdf,doc,docx,ppt,pptx,xls,xlsx Formatında dosya ekleyiniz.
					                  </div>
								<?php
								exit;
							}
						}else{
							$duyuru_ek[$key] = "";
						}
				}
				
					$ekle_veri = $db->prepare("INSERT INTO $dt_table(baslik_tr, baslik_en, aciklama_tr, aciklama_en, tarih, ek_tr, ek_en, yazar,type) VALUES(:baslik_tr,:baslik_en,:aciklama_tr,:aciklama_en,:tarih,:ek_tr,:ek_en,:yazar,:type)");

					foreach ($dil_text as $key => $value) {
							$ekle_veri->bindValue(":baslik_".$key,$_POST["baslik_".$key]);
							$ekle_veri->bindValue(":aciklama_".$key,$_POST["aciklama_".$key]);
							$ekle_veri->bindValue(":ek_".$key,$duyuru_ek[$key]);
					}
						$ekle_veri->bindValue(":tarih",date("Y-m-d",strtotime(str_replace("/","-",$tarih))));
						$ekle_veri->bindValue(":yazar",$yazar);
						$ekle_veri->bindValue(":type","2");
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


						$sor_kayit = $db->prepare("SELECT * FROM $dt_table WHERE id=:sid");
						$sor_kayit->bindValue(":sid",$sid);
						$sor_kayit->execute();

						$oku_kayit = $sor_kayit->fetch();
				$duyuru_ek = array();
				
					foreach ($dil_text as $key => $value) {
						if(!empty($_FILES["slider_resim_$key"]["name"])){
							if(format_kontrol_resim($_FILES["slider_resim_$key"]["tmp_name"]) || format_kontrol_zip($_FILES["slider_resim_$key"]["tmp_name"]) || format_kontrol_office($_FILES["slider_resim_$key"]["tmp_name"])){
								$uzanti_f = pathinfo($_FILES["slider_resim_$key"]["name"]);
								$uzanti = strtolower($uzanti_f["extension"]);
								$duyuru_ek[$key] = $uzanti_f["filename"]."_".(substr(md5(rand()),0,5).".".$uzanti);
								@unlink($f_file_path.$oku_kayit["ek_$key"]);
								@copy($_FILES["slider_resim_$key"]["tmp_name"],$f_file_path.$duyuru_ek[$key]);
							}else{
								?>
								   <div class="alert alert-warning alert-dismissable">
					                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
					                   Lütfen ek için için jpg,png,gif,bmp Formatında bir resim veya bir zip,rar dosyası veya bir pdf,doc,docx,ppt,pptx,xls,xlsx Formatında dosya ekleyiniz.
					                  </div>
								<?php
								exit;
							}
						}else{
							$duyuru_ek[$key] = $oku_kayit["ek_$key"];
						}
				}
				
					$ekle_veri = $db->prepare("UPDATE $dt_table SET baslik_tr=:baslik_tr, baslik_en=:baslik_en, aciklama_tr=:aciklama_tr, aciklama_en=:aciklama_en, tarih=:tarih, ek_tr=:ek_tr, ek_en=:ek_en, yazar=:yazar WHERE id=:uid");
					$ekle_veri->bindValue(":uid",$sid);
					foreach ($dil_text as $key => $value) {
							$ekle_veri->bindValue(":baslik_".$key,$_POST["baslik_".$key]);
							$ekle_veri->bindValue(":aciklama_".$key,$_POST["aciklama_".$key]);
							$ekle_veri->bindValue(":ek_".$key,$duyuru_ek[$key]);
					}
						$ekle_veri->bindValue(":tarih",date("Y-m-d",strtotime(str_replace("/","-",$tarih))));
						$ekle_veri->bindValue(":yazar",$yazar);
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
				$sor_slider_bilgileri = $db->prepare("SELECT * FROM $dt_table WHERE id=:id");
				$sor_slider_bilgileri->bindValue(":id",$sid);
				$sor_slider_bilgileri->execute();


				$slider_bilgi = $sor_slider_bilgileri->fetch();
				foreach ($dil_text as $key => $value) {
					@unlink($f_file_path.$slider_bilgi["ek_$key"]);
				}

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