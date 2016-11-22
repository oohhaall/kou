 <?php
 require_once "../config/global_cont.php";
			$dt_table = "urunler";
	extract($_GET);
	extract($_POST);

		

		if($sid == 0 && @$islem!="sil"){

				$isim_s = "";
				$isim_s2 = "";
						if(!empty($_FILES["arka_plan"]["name"])){
							if(format_kontrol_resim($_FILES["arka_plan"]["tmp_name"])){
							$uzanti_f = pathinfo($_FILES["arka_plan"]["name"]);
							$uzanti = strtolower($uzanti_f["extension"]);
							$isim_s = (substr(md5(rand()),0,10).".".$uzanti);
							@copy($_FILES["arka_plan"]["tmp_name"],$file_upload_path.$isim_s);
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


						if(!empty($_FILES["mobil_resim"]["name"])){
							if(format_kontrol_resim($_FILES["mobil_resim"]["tmp_name"])){
							$uzanti_f = pathinfo($_FILES["mobil_resim"]["name"]);
							$uzanti = strtolower($uzanti_f["extension"]);
							$isim_s2 = (substr(md5(rand()),0,10).".".$uzanti);
							@copy($_FILES["mobil_resim"]["tmp_name"],$file_upload_path.$isim_s2);
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
							$isim_s2 = "";
						}
						
						$aksesuar = "";

						if(!empty($_FILES["aksesuar_doc"]["name"])){
							if(format_kontrol_office($_FILES["aksesuar_doc"]["tmp_name"])){
							$uzanti_f = pathinfo($_FILES["aksesuar_doc"]["name"]);
							$uzanti = strtolower($uzanti_f["extension"]);
							$aksesuar = (substr(md5(rand()),0,10).".".$uzanti);
							@copy($_FILES["aksesuar_doc"]["tmp_name"],$f_file_path.$aksesuar);
						}else{
							?>
				<div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
				                   Lütfen pdf,doc,docx,ppt,pptx,xls,xlsx Formatında bir dosya ekleyiniz.
                  </div>
							<?php
							exit;
						}
						}else{
							$aksesuar = "";
						}

							$kutu_palet = "";

						if(!empty($_FILES["kutu_palet"]["name"])){
							if(format_kontrol_office($_FILES["kutu_palet"]["tmp_name"])){
							$uzanti_f = pathinfo($_FILES["kutu_palet"]["name"]);
							$uzanti = strtolower($uzanti_f["extension"]);
							$kutu_palet = (substr(md5(rand()),0,10).".".$uzanti);
							@copy($_FILES["kutu_palet"]["tmp_name"],$f_pdf_path.$kutu_palet);
						}else{
							?>
				<div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
				                   Lütfen pdf,doc,docx,ppt,pptx,xls,xlsx Formatında bir dosya ekleyiniz.
                  </div>
							<?php
							exit;
						}
						}else{
							$kutu_palet = "";
						}
				
			$ekle_veri = $db->prepare("INSERT INTO $dt_table(kid, sra, urunAdi_tr, urunAdi_en, urunAdi_de, urunAdi_es, urunAdi_fr, urunAdi_ru, urunAdi_it, resim, resim2,kutuPaletPdf, aciklama_tr, aciklama_en, aciklama_de, aciklama_es, aciklama_fr, aciklama_ru, aciklama_it, aksesuarDosya) SELECT 0 as kid,(MAX(sra)+1) AS sra,:baslik_tr as urunAdi_tr,:baslik_en as urunAdi_en,:baslik_de as urunAdi_de,:baslik_es as urunAdi_es,:baslik_fr as urunAdi_fr,:baslik_ru as urunAdi_ru,:baslik_it as urunAdi_it,:resim as resim,:resim2 as resim2,:kutupalet as kutuPaletPdf,:aciklama_tr as aciklama_tr, :aciklama_en as aciklama_en, :aciklama_de as aciklama_de, :aciklama_es as aciklama_es, :aciklama_fr as aciklama_fr, :aciklama_ru as aciklama_ru, :aciklama_it as aciklama_it,:aksesuardoc as aksesuarDosya FROM $dt_table");
					$ekle_veri->bindValue(":aksesuardoc",$aksesuar);
					$ekle_veri->bindValue(":kutupalet",$kutu_palet);
					$ekle_veri->bindValue(":resim",$isim_s);
					$ekle_veri->bindValue(":resim2",$isim_s2);
						foreach ($dil_text as $key => $value) {
							$ekle_veri->bindValue(":baslik_".$key,$_POST["baslik_".$key]);
							$ekle_veri->bindValue(":aciklama_".$key,$_POST["aciklama_".$key]);
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

		}else{
				$sor_slider_bilgileri = $db->prepare("SELECT * FROM $dt_table WHERE id=:id");
				$sor_slider_bilgileri->bindValue(":id",$sid);
				$sor_slider_bilgileri->execute();

				$slider_bilgi = $sor_slider_bilgileri->fetch();
				//foreach ($dil_text as $key => $value) {
					@unlink($file_upload_path.$slider_bilgi["resim"]);
					@unlink($file_upload_path.$slider_bilgi["resim2"]);
					@unlink($f_pdf_path.$slider_bilgi["kutupalet"]);
					@unlink($f_file_path.$slider_bilgi["aksesuarDosya"]);
				//}

				$sil = $db->prepare("DELETE FROM $dt_table WHERE id=:id");
				$sil->bindValue(":id",$sid);
				$sil->execute();

					$upd = $db->prepare("UPDATE $dt_table SET sra=sra-1 WHERE sra>=:sra AND sra>1");
					$upd->bindValue(":sra",$slider_bilgi["sra"]);
					$upd->execute();
						?>
					 <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                    İçerik başarıyla silindi listeden detaylı görüntüleme yapabilirsiniz.
                  </div>
						<?php
		}
?>