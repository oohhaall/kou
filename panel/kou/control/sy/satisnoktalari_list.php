<?php 
	require_once "../config/global_cont.php";
	extract($_GET);
	extract($_POST);
	

	//print_r($_POST);
$db_tab = "satisnoktalari";
if($sid == 0 && @$islem!="sil"){
		

				$ekle_veri = $db->prepare("INSERT INTO $db_tab(ulke, sehir, ilce, firma, adres, tel, fax, email, harita) VALUES(:ulke, :sehir, :ilce, :firma, :adres, :tel, :fax, :email, :harita)");


					$ekle_veri->bindValue(":ulke",$ulke);
					$ekle_veri->bindValue(":sehir",$sehir);
					$ekle_veri->bindValue(":ilce",$ilce);
					$ekle_veri->bindValue(":firma",$unvan);
					$ekle_veri->bindValue(":adres",$adres);
					$ekle_veri->bindValue(":tel",$tel);
					$ekle_veri->bindValue(":fax",$fax);
					$ekle_veri->bindValue(":email",$email);
					$ekle_veri->bindValue(":harita",$maps);


					$ekle_veri->execute();

					if($ekle_veri->rowCount()>0){
							?>

				  <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                    Satış noktası başarıyla eklendi listeden detaylı görüntüleme yapabilirsiniz.
                  </div>
							<?php

					}else{
						?>
							<div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
                   Satış noktası eklenemiyor lütfen yetkililere sorun hakkında bilgilendirme yapınız.
                  </div>
						<?php
					}

		}else if($sid != 0 && @$islem != "sil"){
			$sor_ref = $db->prepare("SELECT * FROM $db_tab WHERE id=:sid");
			$sor_ref->bindValue(":sid",$sid);
			$sor_ref->execute();

				$ref_bilgi = $sor_ref->fetch();

					$baslik = array();
		
				
		
			
				$ekle_veri = $db->prepare("UPDATE $db_tab SET ulke=:ulke, sehir=:sehir, ilce=:ilce, firma=:firma, adres=:adres, tel=:tel, fax=:fax, email=:email, harita=:harita WHERE id=:id");


					$ekle_veri->bindValue(":ulke",$ulke);
					$ekle_veri->bindValue(":sehir",$sehir);
					$ekle_veri->bindValue(":ilce",$ilce);
					$ekle_veri->bindValue(":firma",$unvan);
					$ekle_veri->bindValue(":adres",$adres);
					$ekle_veri->bindValue(":tel",$tel);
					$ekle_veri->bindValue(":fax",$fax);
					$ekle_veri->bindValue(":email",$email);
					$ekle_veri->bindValue(":harita",$maps);
					$ekle_veri->bindValue(":id",$sid);


					$ekle_veri->execute();

					if($ekle_veri->rowCount()>0){
							?>

				  <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                    Satış noktası başarıyla güncellendi listeden detaylı görüntüleme yapabilirsiniz.
                  </div>
							<?php

					}else{
						?>
							<div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
                   Satış noktası güncellenemiyor lütfen yetkililere sorun hakkında bilgilendirme yapınız.
                  </div>
						<?php
					}
		}else{  /// yapı gereçleri altındaki slider slincek ve ona ait tüm bilgiler bunuda unutma
				$sor_slider_bilgileri = $db->prepare("SELECT * FROM $db_tab WHERE id=:id");
				$sor_slider_bilgileri->bindValue(":id",$sid);
				$sor_slider_bilgileri->execute();
//resim : = 17 katalog = 11

				$slider_bilgi = $sor_slider_bilgileri->fetch();
				/*foreach ($dil_text as $key => $value) {
					@unlink($katalog_path.$slider_bilgi["katalog_".$key]);
					//@unlink($file_upload_path.$slider_bilgi["katalogResim_".$key]);
				}*/
					//@unlink($file_upload_path.$slider_bilgi["logo"]);
				//	@unlink($file_upload_path.$slider_bilgi["resim"]);

					$sil = $db->prepare("DELETE FROM $db_tab WHERE id=:id");
					$sil->bindValue(":id",$sid);
					$sil->execute();


					/*$upd = $db->prepare("UPDATE $db_tab SET sra=sra-1 WHERE sra>=:sra AND sra>1");
					$upd->bindValue(":sra",$slider_bilgi["sra"]);
					$upd->execute();*/
						?>
					 <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                    Satış noktası başarıyla slindi listeden detaylı görüntüleme yapabilirsiniz.
                  </div>
						<?php


		}
?>