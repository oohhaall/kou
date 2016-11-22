<?php 
  require_once "../config/global_cont.php";
		
	extract($_GET);
	extract($_POST);

		$dt_table = "personel";
		if($sid == 0 && @$islem!="sil"){
				$isim_s ="";
						if(!empty($_FILES["slider_resim"]["name"])){
							if(format_kontrol_resim($_FILES["slider_resim"]["tmp_name"])){
							$uzanti_f = pathinfo($_FILES["slider_resim"]["name"]);
							$uzanti = strtolower($uzanti_f["extension"]);
							$isim_s = $uzanti_f["filename"]."_".(substr(md5(rand()),0,5).".".$uzanti);
							@copy($_FILES["slider_resim"]["tmp_name"],$file_upload_path.$isim_s);
						}else{
							?>
				<div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
                   Lütfen jpeg,png,gif,bmp Formatında bir resim ekleyiniz.
                  </div>
							<?php
							exit;
						}
						}else{
							$isim_s = "";
						}
		
				
					$ekle_veri = $db->prepare("INSERT INTO $dt_table(sira,isim, email, oda, telefon, arastirma_alani_tr, arastirma_alani_en, url, resim,type) SELECT MAX(sira)+1 as sira,:isim as isim,:email as email,:oda as oda,:telefon as telefon,:arastirma_alani_tr as arastirma_alani_tr,:arastirma_alani_en as arastirma_alani_en,:url as url,:resim as resim,:type as type,:anabilim_dali as anabilim_dali FROM $dt_table WHERE type=:type");


					$ekle_veri->bindValue(":anabilim_dali",$anabilim_dali); 
					$ekle_veri->bindValue(":type","2"); 
					$ekle_veri->bindValue(":resim",$isim_s); 
					$ekle_veri->bindValue(":isim",$isim); 
					$ekle_veri->bindValue(":oda",$oda); 
					$ekle_veri->bindValue(":email",$email); 
					$ekle_veri->bindValue(":telefon",$telefon); 
					$ekle_veri->bindValue(":arastirma_alani_tr",$arastirma_alani_tr);
					$ekle_veri->bindValue(":arastirma_alani_en",$arastirma_alani_en); 
					$ekle_veri->bindValue(":url",$url); 
				
					$ekle_veri->execute() or die(print_r($ekle_veri->errorInfo(),true));

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
				$sor_slid = $db->prepare("SELECT * FROM $dt_table WHERE id=:sid");
				$sor_slid->bindValue(":sid",$sid);
				$sor_slid->execute();
				$oku_slid = $sor_slid->fetch();
			$isim_s ="";
						if(!empty($_FILES["slider_resim"]["name"])){
							if(format_kontrol_resim($_FILES["slider_resim"]["tmp_name"])){
							$uzanti_f = pathinfo($_FILES["slider_resim"]["name"]);
							$uzanti = strtolower($uzanti_f["extension"]);
							$isim_s = $uzanti_f["filename"]."_".(substr(md5(rand()),0,5).".".$uzanti);
							@unlink($file_upload_path.$oku_slid["resim"]);
							@copy($_FILES["slider_resim"]["tmp_name"],$file_upload_path.$isim_s);
						}else{
							?>
				<div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
                   Lütfen jpeg,png,gif,bmp Formatında bir resim ekleyiniz.
                  </div>
							<?php
							exit;
						}
						}else{
							$isim_s = $oku_slid["resim"];
						}
	
					$ekle_veri = $db->prepare("UPDATE $dt_table SET isim=:isim, email=:email, oda=:oda, telefon=:telefon, arastirma_alani_tr=:arastirma_alani_tr, arastirma_alani_en=:arastirma_alani_en, url=:url, resim=:resim,anabilim_dali=:anabilim_dali WHERE id=:sid");

					$ekle_veri->bindValue(":anabilim_dali",$anabilim_dali); 
					$ekle_veri->bindValue(":sid",$sid); 
					$ekle_veri->bindValue(":resim",$isim_s); 
					$ekle_veri->bindValue(":isim",$isim); 
					$ekle_veri->bindValue(":oda",$oda); 
					$ekle_veri->bindValue(":email",$email); 
					$ekle_veri->bindValue(":telefon",$telefon); 
					$ekle_veri->bindValue(":arastirma_alani_tr",$arastirma_alani_tr);
					$ekle_veri->bindValue(":arastirma_alani_en",$arastirma_alani_en); 
					$ekle_veri->bindValue(":url",$url); 
				
					$ekle_veri->execute() or die(print_r($ekle_veri->errorInfo(),true));


					if($ekle_veri->rowCount()>0){
							?>

				  <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                    İçerik başarıyla güncellendi listeden detaylı görüntüleme yapabilirsiniz.
                  </div>
							<?php

					}else{
							print_r($isim_s);
						?>
							<div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
                   	İçerik güncellenemedi lütfen yetkililere sorun hakkında bilgilendirme yapınız.
                  </div>
						<?php
					}


		}else{
				$sor_slider_bilgileri = $db->prepare("SELECT * FROM $dt_table WHERE id=:id");
				$sor_slider_bilgileri->bindValue(":id",$sid);
				$sor_slider_bilgileri->execute();


				$slider_bilgi = $sor_slider_bilgileri->fetch();
			
					@unlink($file_upload_path.$slider_bilgi["resim"]);
				

				$sil = $db->prepare("DELETE FROM $dt_table WHERE id=:id");
				$sil->bindValue(":id",$sid);
				$sil->execute();


					$upd = $db->prepare("UPDATE $dt_table SET sira=sira-1 WHERE sira>=:sira AND sira>1 AND type='2'");
					$upd->bindValue(":sira",$slider_bilgi["sira"]);
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