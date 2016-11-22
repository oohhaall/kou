<?php
	require_once "../config/global_cont.php";
		
	extract($_GET);
	extract($_POST);
	$db_tab = "koleksiyonlar";
	//print_r($_POST);

if($sid == 0 && @$islem!="sil"){
				$baslik = array();
		
				//$isim_s = "";
				

				foreach ($dil_text as $key => $value) {
					if($_POST["baslik_".$key] != ""){
						$baslik[$key] = $_POST["baslik_".$key];
					}else{
						$baslik[$key] = "";
					}
				}
			
			$ekle_veri = $db->prepare("INSERT INTO $db_tab(sra,baslik_tr, baslik_en, baslik_de, baslik_es, baslik_fr, baslik_ru, baslik_it) SELECT  MAX(sra)+1 as sra,:baslik_tr as baslik_tr,:baslik_en as baslik_en,:baslik_de as baslik_de,:baslik_es as baslik_es,:baslik_fr as baslik_fr,:baslik_ru as baslik_ru,:baslik_it as baslik_it FROM $db_tab");


					//$ekle_veri->bindValue(":logo",$urun_logo);
					/*$ekle_veri->bindValue(":resim",$isim_s);
					$ekle_veri->bindValue(":kid",$İçerik);
					$ekle_veri->bindValue(":uid",$ulke);
					$ekle_veri->bindValue(":sid",$sehir);*/
					foreach ($dil_text as $key => $value) {
						$ekle_veri->bindValue(":baslik_".$key,$baslik[$key]);
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

		}else if($sid != 0 && @$islem != "sil"){
			$sor_ref = $db->prepare("SELECT * FROM $db_tab WHERE id=:sid");
			$sor_ref->bindValue(":sid",$sid);
			$sor_ref->execute();

				$ref_bilgi = $sor_ref->fetch();
				$baslik = array();
				foreach ($dil_text as $key => $value) {
					if($_POST["baslik_".$key] != ""){
						$baslik[$key] = $_POST["baslik_".$key];
					}else{
						$baslik[$key] = "";
					}
				}
				$ekle_veri = $db->prepare("UPDATE $db_tab SET baslik_tr=:baslik_tr, baslik_en=:baslik_en, baslik_de=:baslik_de, baslik_es=:baslik_es, baslik_fr=:baslik_fr, baslik_ru=:baslik_ru, baslik_it=:baslik_it WHERE id=:id");
					$ekle_veri->bindValue(":id",$sid);
					foreach ($dil_text as $key => $value) {
						$ekle_veri->bindValue(":baslik_".$key,$baslik[$key]);
					}
					$ekle_veri->execute();
					if($ekle_veri->rowCount()>0){
							?>

				  <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                    İçerik başarıyla düzenlendi listeden detaylı görüntüleme yapabilirsiniz.
                  </div>
							<?php

					}else{
						?>
							<div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
                   İçerik düzenlenemiyor lütfen yetkililere sorun hakkında bilgilendirme yapınız.
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
					$upd = $db->prepare("UPDATE $db_tab SET sra=sra-1 WHERE sra>=:sra AND sra>1");
					$upd->bindValue(":sra",$slider_bilgi["sra"]);
					$upd->execute();

				?>
					 <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                    İçerik başarıyla slindi listeden detaylı görüntüleme yapabilirsiniz.
                  </div>
				<?php


		}
		?>