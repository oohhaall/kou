<?php 
  require_once "../config/global_cont.php";
		
	extract($_GET);
	extract($_POST);
	$db_tab = "sss";

if($sid == 0 && @$islem!="sil"){
				$soru = array();
				$cevap = array();
		
				

				foreach ($dil_text as $key => $value) {
					if($_POST["soru_".$key] != ""){
						$soru[$key] = $_POST["soru_".$key];
					}else{
						$soru[$key] = "";
					}

					if($_POST["cevap_".$key] != ""){
						$cevap[$key] = $_POST["cevap_".$key];
					}else{
						$cevap[$key] = "";
					}
				}
			
			$ekle_veri = $db->prepare("INSERT INTO $db_tab(soru_tr, soru_en, soru_de, soru_es, soru_fr, soru_ru, soru_it, cevap_tr, cevap_en, cevap_de, cevap_es, cevap_fr, cevap_ru, cevap_it, tarih) VALUES (:soru_tr,:soru_en,:soru_de,:soru_es,:soru_fr,:soru_ru,:soru_it,:cevap_tr,:cevap_en,:cevap_de,:cevap_es,:cevap_fr,:cevap_ru,:cevap_it,:tarih)");

					foreach ($dil_text as $key => $value) {
						$ekle_veri->bindValue(":soru_".$key,$soru[$key]);
						$ekle_veri->bindValue(":cevap_".$key,$cevap[$key]);
					}
						$ekle_veri->bindValue(":tarih",date("Y-m-d",strtotime(str_replace("/","-",$tarih))));


					$ekle_veri->execute();

					if($ekle_veri->rowCount()>0){
							?>

				  <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                    Soru cevap başarıyla eklendi listeden detaylı görüntüleme yapabilirsiniz.
                  </div>
							<?php

					}else{
						?>
							<div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
                   Soru cevap eklenemiyor lütfen yetkililere sorun hakkında bilgilendirme yapınız.
                  </div>
						<?php
					}

		}else if($sid != 0 && @$islem != "sil"){

			$soru = array();
				$cevap = array();


			$sor_ref = $db->prepare("SELECT * FROM $db_tab WHERE id=:sid");
			$sor_ref->bindValue(":sid",$sid);
			$sor_ref->execute();

				$ref_bilgi = $sor_ref->fetch();
				foreach ($dil_text as $key => $value) {
					if($_POST["soru_".$key] != ""){
						$soru[$key] = $_POST["soru_".$key];
					}else{
						$soru[$key] = "";
					}

					if($_POST["cevap_".$key] != ""){
						$cevap[$key] = $_POST["cevap_".$key];
					}else{
						$cevap[$key] = "";
					}
				}
				$ekle_veri = $db->prepare("UPDATE $db_tab SET soru_tr=:soru_tr, soru_en=:soru_en, soru_de=:soru_de, soru_es=:soru_es, soru_fr=:soru_fr, soru_ru=:soru_ru, soru_it=:soru_it, cevap_tr=:cevap_tr, cevap_en=:cevap_en, cevap_de=:cevap_de, cevap_es=:cevap_es, cevap_fr=:cevap_fr, cevap_ru=:cevap_ru, cevap_it=:cevap_it, tarih=:tarih WHERE id=:id");
					$ekle_veri->bindValue(":id",$sid);
						foreach ($dil_text as $key => $value) {
						$ekle_veri->bindValue(":soru_".$key,$soru[$key]);
						$ekle_veri->bindValue(":cevap_".$key,$cevap[$key]);
					}
						$ekle_veri->bindValue(":tarih",date("Y-m-d",strtotime(str_replace("/","-",$tarih))));

					$ekle_veri->execute();
					if($ekle_veri->rowCount()>0){
							?>

				  <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                    Soru cevap başarıyla düzenlendi listeden detaylı görüntüleme yapabilirsiniz.
                  </div>
							<?php

					}else{
						?>
							<div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
                   Soru cevap düzenlenemiyor lütfen yetkililere sorun hakkında bilgilendirme yapınız.
                  </div>
						<?php
					}
		}else{  

				$sor_slider_bilgileri = $db->prepare("SELECT * FROM $db_tab WHERE id=:id");
				$sor_slider_bilgileri->bindValue(":id",$sid);
				$sor_slider_bilgileri->execute();

				$slider_bilgi = $sor_slider_bilgileri->fetch();
		

					$sil = $db->prepare("DELETE FROM $db_tab WHERE id=:id");
					$sil->bindValue(":id",$sid);
					$sil->execute();


				?>
					 <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                    Soru cevap başarıyla slindi listeden detaylı görüntüleme yapabilirsiniz.
                  </div>
				<?php


		}
		?>