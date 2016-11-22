<?php
	require_once "../config/global_cont.php";
	extract($_POST);
	extract($_GET);
	$dt_table = "yuzeyler";




	if($_POST){
			if($eid==0){
				$icerik_gir = $db->prepare("INSERT INTO $dt_table(baslik_tr, baslik_en, baslik_de, baslik_es, baslik_fr, baslik_ru, baslik_it) VALUES (:baslik_tr, :baslik_en, :baslik_de, :baslik_es, :baslik_fr, :baslik_ru, :baslik_it)");

				foreach ($dil_text as $dil_key => $dil_val) {
					$icerik_gir->bindValue(":baslik_".$dil_key,$_POST["yuzeybaslik_".$dil_key]);
				}
				$icerik_gir->execute();

				if($icerik_gir->rowCount()>0){
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
			}else if($eid!=0 && @$islem != "sil"){
				$icerik_gir = $db->prepare("UPDATE $dt_table SET baslik_tr=:baslik_tr, baslik_en=:baslik_en, baslik_de=:baslik_de, baslik_es=:baslik_es, baslik_fr=:baslik_fr, baslik_ru=:baslik_ru, baslik_it=:baslik_it WHERE id=:eid");
				$icerik_gir->bindValue(":eid",$eid);
				foreach ($dil_text as $dil_key => $dil_val) {
					$icerik_gir->bindValue(":baslik_".$dil_key,$_POST["yuzeybaslik_".$dil_key]);
				}
				$icerik_gir->execute();

				if($icerik_gir->rowCount()>0){
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
                   	İçerik güncellenemedi lütfen yetkililere sorun hakkında bilgilendirme yapınız.
                  </div>
						<?php
				}
			}else{
				$sil_ic = $db->prepare("DELETE FROM $dt_table WHERE id=:eid");
				$sil_ic->bindValue(":eid",$eid);
				$sil_ic->execute();
				if($sil_ic->rowCount()>0){
					?>
	 <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                    İçerik başarıyla silindi listeden detaylı görüntüleme yapabilirsiniz.
                  </div>
					<?php
				}else{
					?>
					<div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
                   	İçerik silinemedi lütfen yetkililere sorun hakkında bilgilendirme yapınız.
                  </div>
					<?php
				}
			}
		}
?>


