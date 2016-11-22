<?php 
require_once "../config/global_cont.php";

$table = "departman";
$page_list = "iletisim_list";

extract($_POST);
extract($_GET);


		if($sid == 0 && @$islem!="sil"){
				
			

						
				
			$ekle_veri = $db->prepare("INSERT INTO $table(sra, baslik_tr, baslik_en, baslik_de, baslik_es, baslik_fr, baslik_ru, baslik_it, mail) SELECT (MAX(sra)+1) AS sra, :baslik_tr as baslik_tr, :baslik_en as baslik_en, :baslik_de as baslik_de, :baslik_es as baslik_es, :baslik_fr as baslik_fr, :baslik_ru as baslik_ru, :baslik_it as baslik_it, :mail as mail FROM $table");



						foreach ($dil_text as $key => $value) {
							$ekle_veri->bindValue(":baslik_".$key,$_POST["baslik_".$key]);
						}
							$ekle_veri->bindValue(":mail",$mail);

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
					
		


				$ekle_veri = $db->prepare("UPDATE $table SET baslik_tr=:baslik_tr, baslik_en=:baslik_en, baslik_de=:baslik_de, baslik_es=:baslik_es, baslik_fr=:baslik_fr, baslik_ru=:baslik_ru, baslik_it=:baslik_it, mail=:mail WHERE id=:id");

					$ekle_veri->bindValue(":id",$sid);
					$ekle_veri->bindValue(":mail",$mail);

						foreach ($dil_text as $key => $value) {
							$ekle_veri->bindValue(":baslik_".$key,$_POST["baslik_".$key]);
						}

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
				$sor_slider_bilgileri = $db->prepare("SELECT * FROM $table WHERE id=:id");
				$sor_slider_bilgileri->bindValue(":id",$sid);
				$sor_slider_bilgileri->execute();


				$slider_bilgi = $sor_slider_bilgileri->fetch();
		
				$sil = $db->prepare("DELETE FROM $table WHERE id=:id");
				$sil->bindValue(":id",$sid);
				$sil->execute();


					$upd = $db->prepare("UPDATE $table SET sra=sra-1 WHERE sra>=:sra AND sra>1");
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