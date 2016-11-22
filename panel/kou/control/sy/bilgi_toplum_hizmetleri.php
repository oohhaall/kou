<?php
require_once "../config/global_cont.php";

$table = "statiksayfalar";
$page_list = "iletisim_list";

extract($_POST);
extract($_GET);


/*	UPDATE statiksayfalar SET id=[value-1],bilgitoplumu_tr=[value-2],bilgitoplumu_en=[value-3],bilgitoplumu_de=[value-4],bilgitoplumu_es=[value-5],bilgitoplumu_fr=[value-6],bilgitoplumu_ru=[value-7],bilgitoplumu_it=[value-8],iletisimGenelMail=[value-9],bilgitoplumu_tr=[value-10],bilgitoplumu_en=[value-11],bilgitoplumu_de=[value-12],bilgitoplumu_es=[value-13],bilgitoplumu_fr=[value-14],bilgitoplumu_ru=[value-15],bilgitoplumu_it=[value-16],popup=[value-17],popupResim=[value-18],popupLink=[value-19],popupResim_en=[value-20],popupResim_de=[value-21],popupResim_es=[value-22],popupResim_fr=[value-23],popupResim_ru=[value-24],popupResim_it=[value-25] WHERE 1*/

$sor_varmi = $db->prepare("SELECT * FROM $table");
$sor_varmi->execute();

if($sor_varmi->rowCount()>0){
	$up_gunc = $db->prepare("UPDATE $table SET bilgitoplumu_tr=:bilgitoplumu_tr,bilgitoplumu_en=:bilgitoplumu_en,bilgitoplumu_de=:bilgitoplumu_de,bilgitoplumu_es=:bilgitoplumu_es,bilgitoplumu_fr=:bilgitoplumu_fr,bilgitoplumu_ru=:bilgitoplumu_ru,bilgitoplumu_it=:bilgitoplumu_it");
	

foreach ($dil_text as $key => $value) {
	$up_gunc->bindValue(":bilgitoplumu_".$key,$_POST["bilgitoplumu_".$key]);
}	


	$up_gunc->execute();

	if($up_gunc->rowCount()>0){
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
                   	İçerik güncellenemedi lütfen yetkililere sorun hakkında bilgilendirme yapınız.
                  </div>
						<?php

	}
}else{
	$up_gunc = $db->prepare("INSERT INTO $table(bilgitoplumu_tr,bilgitoplumu_en,bilgitoplumu_de,bilgitoplumu_es,bilgitoplumu_fr,bilgitoplumu_ru,bilgitoplumu_it) VALUES(:bilgitoplumu_tr,:bilgitoplumu_en,:bilgitoplumu_de,:bilgitoplumu_es,:bilgitoplumu_fr,:bilgitoplumu_ru,:bilgitoplumu_it)");

	foreach ($dil_text as $key => $value) {
		$up_gunc->bindValue(":bilgitoplumu_".$key,$_POST["bilgitoplumu_".$key]);
	}
	$up_gunc->execute();

	if($up_gunc->rowCount()>0){
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
}

?>