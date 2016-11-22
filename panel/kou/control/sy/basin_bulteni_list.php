<?php 
		require_once "../config/global_cont.php";
		extract($_POST);
		extract($_GET);

		$dt_table = "basinbultenleri";
	if($sid == 0 && @$islem!="sil"){
		/*
INSERT INTO seranitguncel(tarih, baslik_tr, baslik_en, baslik_de, baslik_es, baslik_fr, baslik_ru, baslik_it, aciklama_tr, aciklama_en, aciklama_de, aciklama_es, aciklama_fr, aciklama_ru, aciklama_it) VALUES ()
		*/
	$ekle_veri = $db->prepare("INSERT INTO $dt_table(tarih,grup,baslik_tr, baslik_en, baslik_de, baslik_es, baslik_fr, baslik_ru, baslik_it, aciklama_tr, aciklama_en, aciklama_de, aciklama_es, aciklama_fr, aciklama_ru, aciklama_it) VALUES (:tarih,:grup,:baslik_tr,:baslik_en,:baslik_de,:baslik_es,:baslik_fr,:baslik_ru,:baslik_it,:aciklama_tr,:aciklama_en,:aciklama_de,:aciklama_es,:aciklama_fr,:aciklama_ru,:aciklama_it)");
		foreach ($dil_text as $key => $value) {
			$ekle_veri->bindValue(":aciklama_".$key,$_POST["aciklama_".$key]);
			$ekle_veri->bindValue(":baslik_".$key,$_POST["baslik_".$key]);
		}
			$ekle_veri->bindValue(":grup",$kategori);

		$tar_ = explode("/", $tarih);
		$ekle_veri->bindValue(":tarih",($tar_[2]."-".$tar_[1]."-".$tar_[0]));
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
				$ekle_veri = $db->prepare("UPDATE $dt_table SET tarih=:tarih, baslik_tr=:baslik_tr, baslik_en=:baslik_en, baslik_de=:baslik_de, baslik_es=:baslik_es, baslik_fr=:baslik_fr, baslik_ru=:baslik_ru, baslik_it=:baslik_it, aciklama_tr=:aciklama_tr, aciklama_en=:aciklama_en, aciklama_de=:aciklama_de, aciklama_es=:aciklama_es, aciklama_fr=:aciklama_fr, aciklama_ru=:aciklama_ru, aciklama_it=:aciklama_it,grup=:grup WHERE id=:uid");
			
			$ekle_veri->bindValue(":uid",$sid);
		foreach ($dil_text as $key => $value) {
			$ekle_veri->bindValue(":aciklama_".$key,$_POST["aciklama_".$key]);
			$ekle_veri->bindValue(":baslik_".$key,$_POST["baslik_".$key]);
		}
			$ekle_veri->bindValue(":grup",$kategori);
		
		$tar_ = explode("/", $tarih);
		$ekle_veri->bindValue(":tarih",($tar_[2]."-".$tar_[1]."-".$tar_[0]));
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

				$sor_res = $db->prepare("SELECT * FROM seranitguncelgaleri WHERE uid=:uid");
				$sor_res->bindValue(":uid",$sid);
				$sor_res->execute();
				foreach ($sor_res->fetchAll() as $key => $value) {
					@unlink($file_upload_path.$value["resim"]);
				}
				
					$sil = $db->prepare("DELETE FROM $dt_table WHERE id=:id");
					$sil->bindValue(":id",$sid);
					$sil->execute();
						?>
					 <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                    İçerik başarıyla silindi listeden detaylı görüntüleme yapabilirsiniz.
                  </div>
						<?php
	}
?>