<?php 
require_once "../config/global_cont.php";
	extract($_POST);


if((empty($baslik) || empty($icerik)) && $islem != "sil"){
	?>
	 <div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
                  Lütfen Boş alan bırakmayınız
                  </div>
	<?php
	exit;
}

if($sid==0 && (!isset($islem) || $islem != "sil")){

		$res_ekle = $db->prepare("INSERT INTO bizim_icin_ne_soylediler(baslik,icerik,sira) values(:baslik,:icerik,:sira)");
		$res_sira = $db->query("SELECT MAX(sira) FROM bizim_icin_ne_soylediler")->fetch();
		$res_ekle->bindValue(":baslik",$baslik);
		$res_ekle->bindValue(":icerik",$icerik);
		$res_ekle->bindValue(":sira",($res_sira["MAX(sira)"]+1));
		$res_ekle->execute();

		if($res_ekle->rowCount() != 0){
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


}else if(isset($islem) && $islem=="sil"){ /// Silerken grubun altındaki tüm resimleride silmek gerekiyor
		
		//echo "galiba_emin - ".$sid;
		/*$sor_sid = $db->query("SELECT * FROM galeri WHERE grup_id='".$sid."'");

		foreach ($sor_sid->fetchAll() as $key => $value) {
			@unlink($file_upload_path.$value["resim"]);
		}
		$sil_d_2 = $db->prepare("DELETE FROM galeri WHERE grup_id='".$sid."'");
		*/
		$sil_d = $db->prepare("DELETE FROM bizim_icin_ne_soylediler WHERE id='".$sid."'");
		$sil_d->execute();
		//$sil_d_2->execute(); || $sil_d_2->rowCount() > 0
		if($sil_d->rowCount() > 0){
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
		                   İçerik silinemiyor lütfen yetkililere sorun hakkında bilgilendirme yapınız.
		                  </div>
			<?php
		}
		///
		/*$db->query("UPDATE galeri_grup SET sira=sira-1 WHERE sira>='".$sor_sid["sira"]."' AND sira>1");
		$sil_d = $db->prepare("DELETE FROM galeri_grup WHERE id='".$sid."'");
		$sil_d->execute();

		if($sil_d->rowCount() > 0){
				?>
				      <div class="alert alert-success alert-dismissable">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
		                    Galeri grubu başarıyla silindi listeden detaylı görüntüleme yapabilirsiniz.
		                  </div>
<?php 
		}else{
			?>
 						<div class="alert alert-warning alert-dismissable">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
		                   Galeri grubu silinemiyor lütfen yetkililere sorun hakkında bilgilendirme yapınız.
		                  </div>
			<?php
		}
*/
}else{
		$sor_sid = $db->query("SELECT * FROM bizim_icin_ne_soylediler WHERE id='".$sid."'")->fetch();

				$res_ekle = $db->prepare("UPDATE bizim_icin_ne_soylediler SET baslik=:baslik,icerik=:icerik  WHERE id=:id");
				$res_ekle->bindValue(":baslik",$baslik);
				$res_ekle->bindValue(":icerik",$icerik);
				$res_ekle->bindValue(":id",$sid);
				$res_ekle->execute();
				if($res_ekle->rowCount() != 0){
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
	
}
?>