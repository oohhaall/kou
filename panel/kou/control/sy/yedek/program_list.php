<?php 
	require_once "../config/global_cont.php";
	extract($_POST);

if(@$tip==0 && (!isset($islem) || $islem != "sil")){
		
	if(!empty($_FILES["icerik_resim"]["name"])){
		$uzanti_f = pathinfo($_FILES["icerik_resim"]["name"]);
		$uzanti = strtolower($uzanti_f["extension"]);
		$isim_s = (substr(md5(rand()),0,10).".".$uzanti);
		@copy($_FILES["icerik_resim"]["tmp_name"],$file_upload_path.$isim_s);
	}else{
		$isim_s = "";
	}
		$res_ekle = $db->prepare("INSERT INTO program(baslik,sira,resim,icerik,filtre_id) values(:baslik,:sira,:resim,:icerik,:filtre_id)");
		$res_sira = $db->query("SELECT MAX(sira) FROM program")->fetch();
		$res_ekle->bindValue(":baslik",$baslik);
		$res_ekle->bindValue(":icerik",$icerik);
		$res_ekle->bindValue(":filtre_id",$filtre_id);
		$res_ekle->bindValue(":resim",$isim_s);
		$res_ekle->bindValue(":sira",($res_sira["MAX(sira)"]+1));
		$res_ekle->execute();

		if($res_ekle->rowCount() != 0){
			?>
      <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                    Program Kategori başarıyla eklendi listeden detaylı görüntüleme yapabilirsiniz.
                  </div>
			<?php
		}else{
			?>
    		 <div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
                   Program Kategori eklenemiyor lütfen yetkililere sorun hakkında bilgilendirme yapınız.
                  </div>
			<?php
		}


}else if(@$tip==1 && (!isset($islem) || $islem != "sil")){


		if(!empty($_FILES["icerik_resim"]["name"])){	
			$uzanti_f = pathinfo($_FILES["icerik_resim"]["name"]);
			$uzanti = strtolower($uzanti_f["extension"]);
			$isim_s = (substr(md5(rand()),0,10).".".$uzanti);
			//@unlink($file_upload_path.$sor_sid["resim"]);
			@copy($_FILES["icerik_resim"]["tmp_name"],$file_upload_path.$isim_s);
		}else{
			$isim_s = "";
		}
		$res_ekle = $db->prepare("INSERT INTO program(baslik,sira,resim,icerik,tur,ust_kt,filtre_id) values(:baslik,:sira,:resim,:icerik,:tur,:alt_kt,:filtre_id)");
		$res_sira = $db->query("SELECT MAX(sira) FROM program WHERE ust_kt='$alt_kt'")->fetch();
		$res_ekle->bindValue(":baslik",$baslik);
		$res_ekle->bindValue(":icerik",$icerik);
		$res_ekle->bindValue(":filtre_id",$filtre_id);
		$res_ekle->bindValue(":resim",$isim_s);
		$res_ekle->bindValue(":tur",2);
		$res_ekle->bindValue(":alt_kt",$alt_kt);
		$res_ekle->bindValue(":sira",($res_sira["MAX(sira)"]+1));
		$res_ekle->execute();

		if($res_ekle->rowCount() != 0){
			?>
      <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                    Program Kategori başarıyla eklendi listeden detaylı görüntüleme yapabilirsiniz.
                  </div>
			<?php
		}else{
			?>
    		 <div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
                   Program Kategori eklenemiyor lütfen yetkililere sorun hakkında bilgilendirme yapınız.
                  </div>
			<?php
		}

}else if(isset($islem) && $islem=="sil"){ /// Silerken grubun altındaki tüm resimleride silmek gerekiyor
		
		$sor_sid = $db->query("SELECT * FROM program WHERE id='".$sid."'")->fetch();

		if($sor_sid["ust_kt"] == 0){
			@unlink($file_upload_path.$sor_sid["resim"]);

			$sor_ana_sid = $db->query("SELECT * FROM program WHERE ust_kt='".$sid."'");
			foreach ($sor_ana_sid->fetchAll() as $key => $value) {
				@unlink($file_upload_path.$value["resim"]);
			}
			$sil_d = $db->prepare("DELETE FROM program WHERE id='".$sid."' OR ust_kt='".$sid."'");		
			$sil_d->execute();
			if($sil_d->rowCount() > 0){
				?>
				      <div class="alert alert-success alert-dismissable">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
		                    Menü grubu başarıyla silindi listeden detaylı görüntüleme yapabilirsiniz.
		                  </div>
					<?php 
				}else{
					?>
		 						<div class="alert alert-warning alert-dismissable">
				                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
				                   Menü grubu silinemiyor lütfen yetkililere sorun hakkında bilgilendirme yapınız.
				                  </div>
					<?php
				}
		}else{
			@unlink($file_upload_path.$sor_sid["resim"]);
				$sil_d = $db->prepare("DELETE FROM program WHERE id='".$sid."'");		
				$sil_d->execute();
			if($sil_d->rowCount() > 0){
				?>
				      <div class="alert alert-success alert-dismissable">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
		                    Alt menü sayfası başarıyla silindi listeden detaylı görüntüleme yapabilirsiniz.
		                  </div>
					<?php 
				}else{
					?>
		 						<div class="alert alert-warning alert-dismissable">
				                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
				                   Alt menü sayfası silinemiyor lütfen yetkililere sorun hakkında bilgilendirme yapınız.
				                  </div>
					<?php
				}
		}

		/*foreach ($sor_sid->fetchAll() as $key => $value) {
			@unlink($file_upload_path.$value["resim"]);
		}*/



}else{

				if(!empty($_FILES["icerik_resim"]["name"])){
					$sor_sid = $db->query("SELECT * FROM program WHERE id='".$sid."'")->fetch();
						@unlink($file_upload_path.$sor_sid["resim"]);
						$uzanti_f = pathinfo($_FILES["icerik_resim"]["name"]);
						$uzanti = strtolower($uzanti_f["extension"]);
						$isim_s = (substr(md5(rand()),0,10).".".$uzanti);
						@copy($_FILES["icerik_resim"]["tmp_name"],$file_upload_path.$isim_s);
						$res_ekle = $db->prepare("UPDATE program SET baslik=:grup_name,icerik=:icerik,resim=:res,filtre_id=:filtre_id  WHERE id=:id");
						$res_ekle->bindValue(":grup_name",$baslik);
						$res_ekle->bindValue(":filtre_id",$filtre_id);
						$res_ekle->bindValue(":icerik",$icerik);
						$res_ekle->bindValue(":res",$isim_s);
						$res_ekle->bindValue(":id",$sid);
						$res_ekle->execute();

				}else{
						$res_ekle = $db->prepare("UPDATE program SET baslik=:grup_name,icerik=:icerik,filtre_id=:filtre_id  WHERE id=:id");
						$res_ekle->bindValue(":grup_name",$baslik);
						$res_ekle->bindValue(":icerik",$icerik);
						$res_ekle->bindValue(":filtre_id",$filtre_id);
						//$res_ekle->bindValue(":res",$isim_s);
						$res_ekle->bindValue(":id",$sid);
						$res_ekle->execute();
				}


				if($res_ekle->rowCount() != 0){
					?>
		      <div class="alert alert-success alert-dismissable">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
		                    Program kategorisi başarıyla güncellendi listeden detaylı görüntüleme yapabilirsiniz.
		                  </div>
					<?php
				}else{
					?>
		    		 <div class="alert alert-warning alert-dismissable">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
		                   Program kategorisi güncellenemiyor lütfen yetkililere sorun hakkında bilgilendirme yapınız.
		                  </div>
					<?php
				}
	
}
?>