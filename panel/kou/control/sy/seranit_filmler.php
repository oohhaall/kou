<?php 
		require_once "../config/global_cont.php";
		extract($_POST);
		extract($_GET);
$dt_table = "televizyondaseranit";

	/*
INSERT INTO televizyondaseranit(sra, baslik_tr, baslik_en, baslik_de, baslik_es, baslik_fr, baslik_ru, baslik_it, video_tr, video_en, video_de, video_es, video_fr, video_ru, video_it) SELECT ()


Array ( [eid] => 0 [baslik_tr] => t [video_kodu_tr] => dsadas [baslik_en] => e [video_kodu_en] => dsadas [baslik_de] => dsa [video_kodu_de] => dsa [baslik_es] => das [video_kodu_es] => dsadasda [baslik_fr] => dsada [video_kodu_fr] => dsada [baslik_ru] => dsadas [video_kodu_ru] => dsadasd [baslik_it] => dsadas [video_kodu_it] => dsada ) Array ( ) 
	*/
			

		if($_POST){
			if($eid==0){
				$ekle = $db->prepare("INSERT INTO $dt_table(sra, baslik_tr, baslik_en, baslik_de, baslik_es, baslik_fr, baslik_ru, baslik_it, video_tr, video_en, video_de, video_es, video_fr, video_ru, video_it) SELECT MAX(sra)+1 as sra,:baslik_tr, :baslik_en, :baslik_de, :baslik_es, :baslik_fr, :baslik_ru, :baslik_it, :video_tr, :video_en, :video_de, :video_es, :video_fr, :video_ru, :video_it FROM $dt_table");
				foreach ($dil_text as $key => $value) {
					$ekle->bindValue(":baslik_".$key,$_POST["baslik_".$key]);		
					$ekle->bindValue(":video_".$key,$_POST["video_kodu_".$key]);		
				}

				$ekle->execute();
				if($ekle->rowCount()>0){
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
			}else if($eid!=0 && @$islem!="sil"){
				$ekle = $db->prepare("UPDATE $dt_table SET baslik_tr=:baslik_tr, baslik_en=:baslik_en, baslik_de=:baslik_de, baslik_es=:baslik_es, baslik_fr=:baslik_fr, baslik_ru=:baslik_ru, baslik_it=:baslik_it, video_tr=:video_tr, video_en=:video_en, video_de=:video_de, video_es=:video_es, video_fr=:video_fr, video_ru=:video_ru, video_it=:video_it WHERE id=:uid");
					
					$ekle->bindValue(":uid",$eid);		
				foreach ($dil_text as $key => $value) {
					$ekle->bindValue(":baslik_".$key,$_POST["baslik_".$key]);		
					$ekle->bindValue(":video_".$key,$_POST["video_kodu_".$key]);		
				}

				$ekle->execute();
				if($ekle->rowCount()>0){
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
				$sor_slider_bilgileri->bindValue(":id",$eid);
				$sor_slider_bilgileri->execute();

				$slider_bilgi = $sor_slider_bilgileri->fetch();
		

					$sil = $db->prepare("DELETE FROM $dt_table WHERE id=:id");
					$sil->bindValue(":id",$eid);
					$sil->execute();
					$upd = $db->prepare("UPDATE $dt_table SET sra=sra-1 WHERE sra>=:sra AND sra>1");
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
		}

?>