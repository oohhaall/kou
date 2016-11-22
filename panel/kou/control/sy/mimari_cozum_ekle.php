<?php 
		require_once "../config/global_cont.php";
		extract($_POST);
		extract($_GET);
		$dt_table = "urunler";
		/*
Array ( 
[sid] => 87 
[tip] => 
[baslik_tr] => t 
[aciklama_tr] =>
ttxccxcxxc
[baslik_en] => e 
[aciklama_en] =>
ee
[baslik_de] => g 
[aciklama_de] =>
gg
[baslik_es] => s 
[aciklama_es] =>
ss
[baslik_fr] => f 
[aciklama_fr] =>
ff
[baslik_ru] => r 
[aciklama_ru] =>
rr
[baslik_it] => i 
[aciklama_it] =>
ii
[arka_plan] => undefined [mobil_resim] => undefined [kutu_palet] => undefined [aksesuar_doc] => undefined ) Array ( ) 


UPDATE urunler SET urunAdi_tr=:urunAdi_tr, urunAdi_en=:urunAdi_en, urunAdi_de=:urunAdi_de, urunAdi_es=:urunAdi_es, urunAdi_fr=:urunAdi_fr, urunAdi_ru=:urunAdi_ru, urunAdi_it=:urunAdi_it, resim=:resim, resim2=:resim2, aciklama_tr=:aciklama_tr, aciklama_en=:aciklama_en, aciklama_de=:aciklama_de, aciklama_es=:aciklama_es, aciklama_fr=:aciklama_fr, aciklama_ru=:aciklama_ru, aciklama_it=:aciklama_it,:kutupalet as kutuPaletPdf,:aksesuardoc as aksesuarDosya WHERE id=:uid

		*/

		if($_POST){
			if($sid!=0){
					$sor_urun = $db->prepare("SELECT * FROM $dt_table WHERE id=:uid");
					$sor_urun->bindValue(":uid",$sid);
					$sor_urun->execute();


					$oku_urun = $sor_urun->fetch();
			
				$isim_s = "";
				$isim_s2 = "";
						if(!empty($_FILES["arka_plan"]["name"])){
							if(format_kontrol_resim($_FILES["arka_plan"]["tmp_name"])){
							$uzanti_f = pathinfo($_FILES["arka_plan"]["name"]);
							$uzanti = strtolower($uzanti_f["extension"]);
							$isim_s = (substr(md5(rand()),0,10).".".$uzanti);
							@unlink($file_upload_path.$oku_urun["resim"]);
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
							$isim_s =$oku_urun["resim"];
						}

					if(!empty($_FILES["mobil_resim"]["name"])){
							if(format_kontrol_resim($_FILES["mobil_resim"]["tmp_name"])){
							$uzanti_f = pathinfo($_FILES["mobil_resim"]["name"]);
							$uzanti = strtolower($uzanti_f["extension"]);
							$isim_s2 = (substr(md5(rand()),0,10).".".$uzanti);
							@unlink($file_upload_path.$oku_urun["resim2"]);
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
							$isim_s2 = $oku_urun["resim2"];
						}
							$aksesuar = "";

						if(!empty($_FILES["aksesuar_doc"]["name"])){
							if(format_kontrol_office($_FILES["aksesuar_doc"]["tmp_name"])){
							$uzanti_f = pathinfo($_FILES["aksesuar_doc"]["name"]);
							$uzanti = strtolower($uzanti_f["extension"]);
							$aksesuar = (substr(md5(rand()),0,10).".".$uzanti);
							@unlink($file_upload_path.$oku_urun["aksesuarDosya"]);
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
							$aksesuar =$oku_urun["aksesuarDosya"];
						}

							$kutu_palet = "";

						if(!empty($_FILES["kutu_palet"]["name"])){
							if(format_kontrol_office($_FILES["kutu_palet"]["tmp_name"])){
							$uzanti_f = pathinfo($_FILES["kutu_palet"]["name"]);
							$uzanti = strtolower($uzanti_f["extension"]);
							$kutu_palet = (substr(md5(rand()),0,10).".".$uzanti);
							@unlink($file_upload_path.$oku_urun["kutuPaletPdf"]);

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
							$kutu_palet = $oku_urun["kutuPaletPdf"];;
						}


							$ekle_veri = $db->prepare("UPDATE $dt_table SET urunAdi_tr=:urunAdi_tr, urunAdi_en=:urunAdi_en, urunAdi_de=:urunAdi_de, urunAdi_es=:urunAdi_es, urunAdi_fr=:urunAdi_fr, urunAdi_ru=:urunAdi_ru, urunAdi_it=:urunAdi_it, resim=:resim, resim2=:resim2, aciklama_tr=:aciklama_tr, aciklama_en=:aciklama_en, aciklama_de=:aciklama_de, aciklama_es=:aciklama_es, aciklama_fr=:aciklama_fr, aciklama_ru=:aciklama_ru, aciklama_it=:aciklama_it,kutuPaletPdf=:kutupalet,aksesuarDosya=:aksesuardoc WHERE id=:uid");
					$ekle_veri->bindValue(":uid",$sid);
					$ekle_veri->bindValue(":aksesuardoc",$aksesuar);
					$ekle_veri->bindValue(":kutupalet",$kutu_palet);
					$ekle_veri->bindValue(":resim",$isim_s);
					$ekle_veri->bindValue(":resim2",$isim_s2);
						foreach ($dil_text as $key => $value) {
							$ekle_veri->bindValue(":urunAdi_".$key,$_POST["baslik_".$key]);
							$ekle_veri->bindValue(":aciklama_".$key,$_POST["aciklama_".$key]);
						}
					$ekle_veri->execute();
					if($ekle_veri->rowCount()>0){
							?>
				ok
							<?php

					}else{
						?>
										<div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
                   İşlem gerçekleştirilemiyor lütfen yetkililere sorun hakkında bilgilendirme yapınız.
                  </div>
						<?php
					}

		}
	}
?>