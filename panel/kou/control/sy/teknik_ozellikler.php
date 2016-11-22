<?php
require_once "../config/global_cont.php";
extract($_POST);
extract($_GET);


$dt_table = "fizikselozellikler";
/*
Array ( [sid] => 87 [tip] => 1 [eid] => 0 [teknik_grup] => undefined ) 
Array ( [dosya] => Array ( [name] => 31341376.pdf [type] => application/pdf [tmp_name] => D:\wamp\tmp\php2B43.tmp [error] => 0 [size] => 4009938 ) ) 
*/

	if($_POST){
			if($eid==0){

									$isim_s = "";
					if(!empty($_FILES["dosya"]["name"])){
							if(format_kontrol_office($_FILES["dosya"]["tmp_name"])){
							$uzanti_f = pathinfo($_FILES["dosya"]["name"]);
							$uzanti = strtolower($uzanti_f["extension"]);
							$isim_s = (substr(md5(rand()),0,10).".".$uzanti);
							@copy($_FILES["dosya"]["tmp_name"],$f_file_path.$isim_s);
						}else{
							?>

				
						<div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
				                   Lütfen katalog için pdf,doc,docx,ppt,pptx,xls,xlsx Formatında bir dosya ekleyiniz.
                  </div>
							<?php
							exit;
						}
						}else{
							$isim_s = "";
						}

		$ekle_detay = $db->prepare("INSERT INTO $dt_table(baslik,dosya) VALUES(:baslik,:dosya)");
		$ekle_detay->bindValue(":baslik",$teknik_grup);
		$ekle_detay->bindValue(":dosya",$isim_s);
		$ekle_detay->execute();

				if($ekle_detay->rowCount()!=0){
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

				}else if($eid != 0 && @$islem != "sil"){
						$sor_fizik = $db->prepare("SELECT * FROM $dt_table WHERE id=:eid");
						$sor_fizik->bindValue(":eid",$eid);
						$sor_fizik->execute();

						$oku_fizik = $sor_fizik->fetch();


					$isim_s = "";
					if(!empty($_FILES["dosya"]["name"])){
							if(format_kontrol_office($_FILES["dosya"]["tmp_name"])){
							$uzanti_f = pathinfo($_FILES["dosya"]["name"]);
							$uzanti = strtolower($uzanti_f["extension"]);
							$isim_s = (substr(md5(rand()),0,10).".".$uzanti);
							@unlink($f_file_path.$oku_fizik["dosya"]);
							@copy($_FILES["dosya"]["tmp_name"],$f_file_path.$isim_s);
						}else{
							?>

				
						<div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
				                   Lütfen katalog için pdf,doc,docx,ppt,pptx,xls,xlsx Formatında bir dosya ekleyiniz.
                  </div>
							<?php
							exit;
						}
						}else{
							$isim_s = $oku_fizik["dosya"];
						}

		$ekle_detay = $db->prepare("UPDATE $dt_table SET baslik=:baslik,dosya=:dosya WHERE id=:eid");
		$ekle_detay->bindValue(":baslik",$teknik_grup);
		$ekle_detay->bindValue(":dosya",$isim_s);
		$ekle_detay->bindValue(":eid",$eid);
		$ekle_detay->execute();

				if($ekle_detay->rowCount()!=0){
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
							@unlink($f_file_path.$slider_bilgi["dosya"]);

						$sil = $db->prepare("DELETE FROM $dt_table WHERE id=:id");
						$sil->bindValue(":id",$eid);
						$sil->execute();

								?>
							 <div class="alert alert-success alert-dismissable">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
		                    İçerik başarıyla silindi listeden detaylı görüntüleme yapabilirsiniz.
		                  </div>
								<?php
				}
			}
 ?>