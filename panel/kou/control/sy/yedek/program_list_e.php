<?php 
	require_once "../config/global_cont.php";
	extract($_POST);

if($sid==0 && (!isset($islem) || $islem != "sil")){
	/*
baslik
icerik
icerik_resim
	*/
		$uzanti_f = pathinfo($_FILES["icerik_resim"]["name"]);
		$uzanti = strtolower($uzanti_f["extension"]);
		$isim_s = (substr(md5(rand()),0,10).".".$uzanti);
		//@unlink($file_upload_path.$sor_sid["resim"]);
		@copy($_FILES["slider_resim"]["tmp_name"],$file_upload_path.$isim_s);
	


		$res_ekle = $db->prepare("INSERT INTO program(baslik,sira,resim,icerik) values(:baslik,:sira,:resim,:icerik)");
		$res_sira = $db->query("SELECT MAX(sira) FROM program")->fetch();
		$res_ekle->bindValue(":baslik",$baslik);
		$res_ekle->bindValue(":icerik",$icerik);
		$res_ekle->bindValue(":resim",$isim_s);
		$res_ekle->bindValue(":sira",($res_sira["MAX(sira)"]+1));
		$res_ekle->execute();

		if($res_ekle->rowCount() != 0){
			?>
      <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                    Finans Kategori başarıyla eklendi listeden detaylı görüntüleme yapabilirsiniz.
                  </div>
			<?php
		}else{
			?>
    		 <div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
                   Finans Kategori eklenemiyor lütfen yetkililere sorun hakkında bilgilendirme yapınız.
                  </div>
			<?php
		}


}else if($sid==1 && (!isset($islem) || $islem != "sil")){
		$uzanti_f = pathinfo($_FILES["icerik_resim"]["name"]);
		$uzanti = strtolower($uzanti_f["extension"]);
		$isim_s = (substr(md5(rand()),0,10).".".$uzanti);
		//@unlink($file_upload_path.$sor_sid["resim"]);
		@copy($_FILES["slider_resim"]["tmp_name"],$file_upload_path.$isim_s);
	
		$res_ekle = $db->prepare("INSERT INTO program(baslik,sira,resim,icerik,tur,ust_kt) values(:baslik,:sira,:resim,:icerik,:tur,:ust_kt)");
		$res_sira = $db->query("SELECT MAX(sira) FROM program WHERE ust_kt='$tip'")->fetch();
		$res_ekle->bindValue(":baslik",$baslik);
		$res_ekle->bindValue(":icerik",$icerik);
		$res_ekle->bindValue(":resim",$isim_s);
		$res_ekle->bindValue(":tur",2);
		$res_ekle->bindValue(":ust_kt",$tip);
		$res_ekle->bindValue(":sira",($res_sira["MAX(sira)"]+1));
		$res_ekle->execute();

		if($res_ekle->rowCount() != 0){
			?>
      <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                    Finans Kategori başarıyla eklendi listeden detaylı görüntüleme yapabilirsiniz.
                  </div>
			<?php
		}else{
			?>
    		 <div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
                   Finans Kategori eklenemiyor lütfen yetkililere sorun hakkında bilgilendirme yapınız.
                  </div>
			<?php
		}

}else if(isset($islem) && $islem=="sil"){ /// Silerken grubun altındaki tüm resimleride silmek gerekiyor
		
		//echo "galiba_emin - ".$sid;
		$sor_sid = $db->query("SELECT * FROM arkaplan WHERE sayfa='".$sid."'");

		foreach ($sor_sid->fetchAll() as $key => $value) {
			@unlink($file_upload_path.$value["resim"]);
		}
		$sil_d = $db->prepare("DELETE FROM sayfa WHERE id='".$sid."'");
		$sil_d_2 = $db->prepare("DELETE FROM arkaplan WHERE sayfa='".$sid."'");
		$sil_d->execute();
		$sil_d_2->execute();
		if($sil_d->rowCount() > 0 || $sil_d_2->rowCount() > 0){
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

}else{
		$sor_sid = $db->query("SELECT * FROM sayfa WHERE id='".$sid."'")->fetch();

				$res_ekle = $db->prepare("UPDATE sayfa SET sayfa_adi=:grup_name  WHERE id=:id");
				$res_ekle->bindValue(":grup_name",$baslik);
				$res_ekle->bindValue(":id",$sid);
				$res_ekle->execute();
				if($res_ekle->rowCount() != 0){
					?>
		      <div class="alert alert-success alert-dismissable">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
		                    Galeri grubu başarıyla güncellendi listeden detaylı görüntüleme yapabilirsiniz.
		                  </div>
					<?php
				}else{
					?>
		    		 <div class="alert alert-warning alert-dismissable">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
		                   Galeri grubu güncellenemiyor lütfen yetkililere sorun hakkında bilgilendirme yapınız.
		                  </div>
					<?php
				}
	
}
?>