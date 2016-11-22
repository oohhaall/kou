<?php 
	require_once "../config/global_cont.php";
	extract($_POST);

if($sid==0 && (!isset($islem) || $islem != "sil")){

		$res_ekle = $db->prepare("INSERT INTO referanslar(isim,sira) values(:isim,:sira)");
		$res_sira = $db->query("SELECT MAX(sira) FROM referanslar")->fetch(); // Güncellenebilir veya birlestirilebilir bir sorgu
		$res_ekle->bindValue(":isim",$baslik);
		$res_ekle->bindValue(":sira",($res_sira["MAX(sira)"]+1));
		$res_ekle->execute();
		if($res_ekle->rowCount() != 0){
			?>
      <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                    Referans başarıyla eklendi listeden detaylı görüntüleme yapabilirsiniz.
                  </div>
			<?php
		}else{
			echo $res_ekle->errorCode();
			?>
    		 <div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
                   Referans eklenemiyor lütfen yetkililere sorun hakkında bilgilendirme yapınız.
                  </div>
			<?php
		}




	
}else if(isset($islem) && $islem=="sil"){
		$sor_sid = $db->query("SELECT * FROM referanslar WHERE id='".$sid."'")->fetch();
		//@unlink($file_upload_path.$sor_sid["resim"]);
		$db->query("UPDATE referanslar SET sira=sira-1 WHERE sira>='".$sor_sid["sira"]."' AND sira>1");
		$sil_d = $db->prepare("DELETE FROM referanslar WHERE id='".$sid."'");
		$sil_d->execute();

		if($sil_d->rowCount() > 0){
				?>
				      <div class="alert alert-success alert-dismissable">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
		                    Referans başarıyla silindi listeden detaylı görüntüleme yapabilirsiniz.
		                  </div>
<?php 
		}else{
			?>
 						<div class="alert alert-warning alert-dismissable">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
		                   Referans silinemiyor lütfen yetkililere sorun hakkında bilgilendirme yapınız.
		                  </div>
			<?php
		}

}else{
		//$sor_sid = $db->query("SELECT * FROM slider WHERE id='".$sid."'")->fetch();

				$res_ekle = $db->prepare("UPDATE referanslar SET isim=:baslik  WHERE id=:id");
				///$res_ekle->bindValue(":baslik",$baslik);
				$res_ekle->bindValue(":baslik",$baslik);
				$res_ekle->bindValue(":id",$sid);
				$res_ekle->execute();
				if($res_ekle->rowCount() != 0){
					?>
		      <div class="alert alert-success alert-dismissable">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
		                    Referans başarıyla güncellendi listeden detaylı görüntüleme yapabilirsiniz.
		                  </div>
					<?php
				}else{
					?>
		    		 <div class="alert alert-warning alert-dismissable">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
		                   Referans güncellenemiyor lütfen yetkililere sorun hakkında bilgilendirme yapınız.
		                  </div>
					<?php
				}
	}

?>