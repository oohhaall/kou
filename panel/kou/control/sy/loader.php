<?php
	require_once "../config/global_cont.php";

extract($_GET);
  
 
switch ($_GET["page"]) {
	case 'haber_list_tr':
		  $sor_slider = $db->prepare("SELECT * FROM haberler WHERE dil_tur=1 ORDER BY sira DESC");
		  $sor_slider->execute();
		  foreach ($sor_slider->fetchAll() as $key => $value) {
		?>

		                   <li id="<?php echo "list_update_".$value["id"]; ?>" sira='<?php echo $value["sira"]; ?>' m_id='<?php echo $value["id"]; ?>'>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      <!-- checkbox -->
                     <!-- <input type="checkbox" value="" name=""> -->
                      <!-- todo text -->
                      <span class="text"><a href="#"><img width="180" height="40" m_id='<?php echo $value["id"]; ?>' src="<?php echo $file_read_path.$value["haber_resim"]; ?>"></a> <k m_id='<?php echo $value["id"]; ?>'><?php echo $value["haber_baslik"]; ?></k>
<p style="display: none;" m_id='<?php echo $value["id"]; ?>'></p>
                      </span>
                      <div m_id='<?php echo $value["id"]; ?>' style='display:none;'><?php echo $value["haber_icerik"]; ?></div>
                      <!-- Emphasis label -->
                      <small class="label label-danger"><i class="fa fa-clock-o"></i><?php echo $value["tarih"]; ?></small>
                      <!-- General tools such as edit or delete-->
                             <div class="list_active_control">
                      <div class="slider-track <?php echo ($value["durum"]==1)?"acik_on":NULL; ?>" onclick='gunc_durum("<?php echo $value["id"]; ?>")' item_id="<?php echo $value["id"]; ?>" post_type="haberler">
                          <div class="slider-handle"></div>
                        </div>
                        </div>
                      <div class="tools">
                        <i class="fa fa-edit" onclick="slider_duzenle('a_slider_ekle','<?php echo $value["id"]; ?>','alt_slider_ekle')"></i>
                        <i class="fa fa-trash-o" onclick="slider_sil('<?php echo $value["id"]; ?>','haber_list_tr','info_field','a_slider_ekle')"></i>
                      </div>
                    </li>
		        <?php } 
	break;
case 'haber_list_en':
      $sor_slider = $db->prepare("SELECT * FROM haberler WHERE dil_tur=2 ORDER BY sira DESC");
      $sor_slider->execute();
      foreach ($sor_slider->fetchAll() as $key => $value) {
    ?>

                       <li id="<?php echo "list_update_".$value["id"]; ?>" sira='<?php echo $value["sira"]; ?>' m_id='<?php echo $value["id"]; ?>'>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      <!-- checkbox -->
                     <!-- <input type="checkbox" value="" name=""> -->
                      <!-- todo text -->
                      <span class="text"><a href="#"><img width="180" height="40" m_id='<?php echo $value["id"]; ?>' src="<?php echo $file_read_path.$value["haber_resim"]; ?>"></a> <k m_id='<?php echo $value["id"]; ?>'><?php echo $value["haber_baslik"]; ?></k>
<p style="display: none;" m_id='<?php echo $value["id"]; ?>'></p>
                      </span>
                      <div m_id='<?php echo $value["id"]; ?>' style='display:none;'><?php echo $value["haber_icerik"]; ?></div>
                      <!-- Emphasis label -->
                      <small class="label label-danger"><i class="fa fa-clock-o"></i><?php echo $value["tarih"]; ?></small>
                      <!-- General tools such as edit or delete-->
                             <div class="list_active_control">
                      <div class="slider-track <?php echo ($value["durum"]==1)?"acik_on":NULL; ?>" onclick='gunc_durum("<?php echo $value["id"]; ?>")' item_id="<?php echo $value["id"]; ?>" post_type="haberler">
                          <div class="slider-handle"></div>
                        </div>
                        </div>
                      <div class="tools">
                        <i class="fa fa-edit" onclick="slider_duzenle('a_slider_ekle','<?php echo $value["id"]; ?>','alt_slider_ekle')"></i>
                        <i class="fa fa-trash-o" onclick="slider_sil('<?php echo $value["id"]; ?>','haber_list_en','info_field','a_slider_ekle')"></i>
                      </div>
                    </li>
            <?php } 
  break;

  case 'haber_list_gr':
      $sor_slider = $db->prepare("SELECT * FROM haberler WHERE dil_tur=3 ORDER BY sira DESC");
      $sor_slider->execute();
      foreach ($sor_slider->fetchAll() as $key => $value) {
    ?>

                       <li id="<?php echo "list_update_".$value["id"]; ?>" sira='<?php echo $value["sira"]; ?>' m_id='<?php echo $value["id"]; ?>'>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      <!-- checkbox -->
                     <!-- <input type="checkbox" value="" name=""> -->
                      <!-- todo text -->
                      <span class="text"><a href="#"><img width="180" height="40" m_id='<?php echo $value["id"]; ?>' src="<?php echo $file_read_path.$value["haber_resim"]; ?>"></a> <k m_id='<?php echo $value["id"]; ?>'><?php echo $value["haber_baslik"]; ?></k>
<p style="display: none;" m_id='<?php echo $value["id"]; ?>'></p>
                      </span>
                      <div m_id='<?php echo $value["id"]; ?>' style='display:none;'><?php echo $value["haber_icerik"]; ?></div>
                      <!-- Emphasis label -->
                      <small class="label label-danger"><i class="fa fa-clock-o"></i><?php echo $value["tarih"]; ?></small>
                      <!-- General tools such as edit or delete-->
                             <div class="list_active_control">
                      <div class="slider-track <?php echo ($value["durum"]==1)?"acik_on":NULL; ?>" onclick='gunc_durum("<?php echo $value["id"]; ?>")' item_id="<?php echo $value["id"]; ?>" post_type="haberler">
                          <div class="slider-handle"></div>
                        </div>
                        </div>
                      <div class="tools">
                        <i class="fa fa-edit" onclick="slider_duzenle('a_slider_ekle','<?php echo $value["id"]; ?>','alt_slider_ekle')"></i>
                        <i class="fa fa-trash-o" onclick="slider_sil('<?php echo $value["id"]; ?>','haber_list_gr','info_field','a_slider_ekle')"></i>
                      </div>
                    </li>
            <?php } 
  break;
  case 'haber_list_hu':
      $sor_slider = $db->prepare("SELECT * FROM haberler WHERE dil_tur=4 ORDER BY sira DESC");
      $sor_slider->execute();
      foreach ($sor_slider->fetchAll() as $key => $value) {
    ?>

                       <li id="<?php echo "list_update_".$value["id"]; ?>" sira='<?php echo $value["sira"]; ?>' m_id='<?php echo $value["id"]; ?>'>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      <!-- checkbox -->
                     <!-- <input type="checkbox" value="" name=""> -->
                      <!-- todo text -->
                      <span class="text"><a href="#"><img width="180" height="40" m_id='<?php echo $value["id"]; ?>' src="<?php echo $file_read_path.$value["haber_resim"]; ?>"></a> <k m_id='<?php echo $value["id"]; ?>'><?php echo $value["haber_baslik"]; ?></k>
<p style="display: none;" m_id='<?php echo $value["id"]; ?>'></p>
                      </span>
                      <div m_id='<?php echo $value["id"]; ?>' style='display:none;'><?php echo $value["haber_icerik"]; ?></div>
                      <!-- Emphasis label -->
                      <small class="label label-danger"><i class="fa fa-clock-o"></i><?php echo $value["tarih"]; ?></small>
                      <!-- General tools such as edit or delete-->
                             <div class="list_active_control">
                      <div class="slider-track <?php echo ($value["durum"]==1)?"acik_on":NULL; ?>" onclick='gunc_durum("<?php echo $value["id"]; ?>")' item_id="<?php echo $value["id"]; ?>" post_type="haberler">
                          <div class="slider-handle"></div>
                        </div>
                        </div>
                      <div class="tools">
                        <i class="fa fa-edit" onclick="slider_duzenle('a_slider_ekle','<?php echo $value["id"]; ?>','alt_slider_ekle')"></i>
                        <i class="fa fa-trash-o" onclick="slider_sil('<?php echo $value["id"]; ?>','haber_list_hu','info_field','a_slider_ekle')"></i>
                      </div>
                    </li>
            <?php } 
  break;
case "bunlari_biliyormusun":
    $sor_slider = $db->prepare("SELECT * FROM videolar ORDER BY sira DESC");
      $sor_slider->execute();
      foreach ($sor_slider->fetchAll() as $key => $value) {
    ?>

                      <li id="<?php echo "list_update_".$value["id"]; ?>" sira='<?php echo $value["sira"]; ?>' m_id='<?php echo $value["id"]; ?>'>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      <!-- checkbox -->
                     <!-- <input type="checkbox" value="" name=""> -->
                      <!-- todo text -->
                      <span class="text"><!--<a href="#"><img width="180" height="40" m_id='<?php echo $value["id"]; ?>' src="<?php echo $file_read_path.$value["haber_resim"]; ?>"></a>-->
                      <k m_id='<?php echo $value["id"]; ?>'><?php echo $value["baslik"]; ?></k>
                      <ac style="display:none;" m_id='<?php echo $value["id"]; ?>'><?php echo $value["aciklama"]; ?></ac>
<p style="display: none;" m_id='<?php echo $value["id"]; ?>'></p>
                      </span>
                      <div m_id='<?php echo $value["id"]; ?>' style='display:none;'><?php echo $value["icerik"]; ?></div>
                      <!-- Emphasis label -->
                      <small class="label label-danger"><i class="fa fa-clock-o"></i><?php echo $value["tarih"]; ?></small>
                      <!-- General tools such as edit or delete-->
                             <div class="list_active_control">
                      <div class="slider-track <?php echo ($value["durum"]==1)?"acik_on":NULL; ?>" onclick='gunc_durum("<?php echo $value["id"]; ?>")' item_id="<?php echo $value["id"]; ?>" post_type="haberler">
                          <div class="slider-handle"></div>
                        </div>
                        </div>
                      <div class="tools">
                       <i class="fa fa-edit" onclick="biliyormusun_duzenle('a_slider_ekle','<?php echo $value["id"]; ?>','alt_slider_ekle')"></i>
                        <i class="fa fa-trash-o" onclick="biliyormusun_sil('<?php echo $value["id"]; ?>','bunlari_biliyormusun','info_field','a_slider_ekle')"></i>
                   </div>
                    </li>
            <?php } 
  

break;


case "bizim_icin_ne_soylediler":
    $sor_slider = $db->prepare("SELECT * FROM bizim_icin_ne_soylediler ORDER BY sira DESC");
      $sor_slider->execute();
      foreach ($sor_slider->fetchAll() as $key => $value) {
    ?>

                         <li id="<?php echo "list_update_".$value["id"]; ?>" sira='<?php echo $value["sira"]; ?>' m_id='<?php echo $value["id"]; ?>'>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      <!-- checkbox -->
                     <!-- <input type="checkbox" value="" name=""> -->
                      <!-- todo text -->
                      <span class="text"><!--<a href="#"><img width="180" height="40" m_id='<?php echo $value["id"]; ?>' src="<?php echo $file_read_path.$value["haber_resim"]; ?>"></a>-->
                      <k m_id='<?php echo $value["id"]; ?>'><?php echo $value["baslik"]; ?></k>
                      <x m_id="<?php echo $value["id"]; ?>" style="display: none;"><?php echo $value["baslik"]; ?></x>

                      </span>
                      <div m_id='<?php echo $value["id"]; ?>' style='display:none;'><?php echo $value["icerik"]; ?></div>
                      <!-- Emphasis label -->
                      <small class="label label-danger"><i class="fa fa-clock-o"></i><?php echo $value["tarih"]; ?></small>
                      <!-- General tools such as edit or delete-->
                             <div class="list_active_control">
                      <div class="slider-track <?php echo ($value["durum"]==1)?"acik_on":NULL; ?>" onclick='gunc_durum("<?php echo $value["id"]; ?>")' item_id="<?php echo $value["id"]; ?>" post_type="bizim_icin_ne_soylediler">
                          <div class="slider-handle"></div>
                        </div>
                        </div>
                      <div class="tools">
                        <i class="fa fa-edit" onclick="biliyormusun_duzenle('a_slider_ekle','<?php echo $value["id"]; ?>','alt_slider_ekle')"></i>
                        <i class="fa fa-trash-o" onclick="biliyormusun_sil('<?php echo $value["id"]; ?>','bizim_icin_ne_soylediler','info_field','a_slider_ekle')"></i>
                      </div>
                    </li>
            <?php } 
  

break;


		case 'alt_slider':
		  $sor_slider = $db->prepare("SELECT * FROM slider WHERE tip='2' ORDER BY sira DESC");
		  $sor_slider->execute();
		  foreach ($sor_slider->fetchAll() as $key => $value) {
		?>

		                   <li id="<?php echo "list_update_".$value["sira"]; ?>" sira='<?php echo $value["sira"]; ?>' m_id='<?php echo $value["id"]; ?>'>
		                      <!-- drag handle -->
		                      <span class="handle">
		                        <i class="fa fa-ellipsis-v"></i>
		                        <i class="fa fa-ellipsis-v"></i>
		                      </span>
		                      <!-- checkbox -->
		                     <!-- <input type="checkbox" value="" name=""> -->
		                      <!-- todo text -->
		                      <span class="text"><a href="#"><img width="80" height="80" m_id='<?php echo $value["id"]; ?>' src="<?php echo $file_read_path.$value["resim"]; ?>"></a> <k m_id='<?php echo $value["id"]; ?>'><?php echo $value["baslik"]; ?></k>
								<p style="display: none;" m_id='<?php echo $value["id"]; ?>'></p>
		                      </span>
		                      <!-- Emphasis label -->
		                      <small class="label label-danger"><i class="fa fa-clock-o"></i><?php echo $value["tarih"]; ?></small>
		                      <!-- General tools such as edit or delete-->
		                     <div class="list_active_control">
                      <div class="slider-track <?php echo ($value["durum"]==1)?"acik_on":NULL; ?>" onclick='gunc_durum("<?php echo $value["id"]; ?>")' item_id="<?php echo $value["id"]; ?>" post_type="alt_slider">
                          <div class="slider-handle"></div>
                        </div>
                        </div>
		                      <div class="tools">
		                        <i class="fa fa-edit" onclick="slider_duzenle('a_slider_ekle','<?php echo $value["id"]; ?>','a_slider_ekle')"></i>
		                        <i class="fa fa-trash-o" onclick="slider_sil('<?php echo $value["id"]; ?>','ana_slider','info_field','a_slider_ekle')"></i>
		                      </div>
		                    </li>
		        <?php } 
	break;
  case "ark_planekle":

        $sor_slider = $db->prepare("SELECT * FROM arkaplan WHERE sayfa=:grup_id ORDER BY sira DESC");
        $sor_slider->bindValue(":grup_id",@$_GET["grup_id"]);          
        $sor_slider->execute();

            if($sor_slider->rowCount() == 0){
                ?>

                        <div class="callout callout-info">
                          <h4>Listede hiç resim bulunamadı</h4>
                          <p>Lütfen önce resim ekleyin</p>
                        </div>
                    <?php }else{  
             foreach ($sor_slider->fetchAll() as $key => $value) {
          ?>
                   <li id="<?php echo "list_update_".$value["id"]; ?>" sira='<?php echo $value["sira"]; ?>' m_id='<?php echo $value["id"]; ?>'>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      <!-- checkbox -->
                     <!-- <input type="checkbox" value="" name=""> -->
                      <!-- todo text -->
                      <span class="text"><a href="#">
                      <img width="300" height="63" class="ark_plan" m_id='<?php echo $value["id"]; ?>' src="<?php echo $file_read_path.$value["resim"]; ?>"></a>
                      <img class="pro_hid" style="display:none;" m_id='<?php echo $value["id"]; ?>' src="<?php echo $file_read_path.$value["profil"]; ?>">
                      <k type="tr" m_id='<?php echo @$value["id"]; ?>'><?php echo @$value["title_tr"]; ?></k>
                      <k type="en" style="display:none;" m_id='<?php echo @$value["id"]; ?>'><?php echo @$value["name"]; ?></k>
                      <k type="gr" style="display:none;" m_id='<?php echo @$value["id"]; ?>'><?php echo @$value["title_gr"]; ?></k>
                      <k type="hu" style="display:none;" m_id='<?php echo @$value["id"]; ?>'><?php echo @$value["title_hu"]; ?></k>

                      </span>
                      <!-- Emphasis label -->
                      <small class="label label-danger"><i class="fa fa-clock-o"></i><?php echo $value["tarih"]; ?></small>
                      <!-- General tools such as edit or delete-->
                      <div class="list_active_control">
                      <div class="slider-track <?php echo ($value["durum"]==1)?"acik_on":NULL; ?>" onclick='gunc_durum("<?php echo $value["id"]; ?>")' item_id="<?php echo $value["id"]; ?>" post_type="arkaplan">
                          <div class="slider-handle"></div>
                        </div>
                        </div>
                      <div class="tools">
                        <i class="fa fa-edit" onclick="slider_duzenle2('a_slider_ekle','<?php echo $value["id"]; ?>','galeri')"></i>
                        <i class="fa fa-trash-o" onclick="slider_sil('<?php echo $value["id"]; ?>','galeri','info_field','a_slider_ekle')"></i>
                      </div>
                    </li>
        <?php }  }
  break;
  case "arkaplan_list":
        $sor_grup = $db->prepare("SELECT * FROM sayfa ORDER BY sira DESC");
                      $sor_grup->execute();

                      if($sor_grup->rowCount() == 0){
                    ?>

                        <div class="callout callout-info">
                          <h4>Listede hiç grup bulunamadı</h4>
                          <p>Lütfen önce grup ekleyin</p>
                        </div>
                    <?php }else{  ?>
                    <?php
                      foreach ($sor_grup->fetchAll() as $key => $value) {
                    ?>
            <li id="<?php echo "list_update_".$value["id"]; ?>" sira='<?php echo $value["sira"]; ?>' m_id='g_<?php echo $value["id"]; ?>'>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      <!-- checkbox -->
                      
                      <!-- todo text -->
                      <span class="text"><g id='grup_name' class="grub_name" onclick="list_goruntule('<?php echo $value["id"]; ?>')"><?php echo $value["sayfa_adi"]; ?></g></span>
                      <!-- Emphasis label -->
                      <small class="label label-default"><i class="fa fa-clock-o"></i><?php echo $value["tarih"]; ?></small>
                      <!-- General tools such as edit or delete-->
                        <div class="list_active_control">
                        <div class="slider-track <?php echo ($value["durum"]==1)?"acik_on":NULL; ?>" onclick='gunc_durum("<?php echo $value["id"]; ?>")' item_id="<?php echo $value["id"]; ?>" post_type="galeri_grup">
                          <div class="slider-handle"></div>
                        </div>
                        </div>
                      <div class="tools">
                        <i class="fa fa-edit" onclick="galeri_grup_duzenle('galeri_grub_form','<?php echo $value["id"]; ?>','galeri_grup')"></i>
                        <i class="fa fa-trash-o" onclick="galeri_grup_sil('<?php echo $value["id"]; ?>','galeri_grup','info_field_2','galeri_grub_ekle')"></i>
                      </div>
                    </li>
                    <?php } } 
  break;
case "arkaplan":
      $sor_slider = $db->prepare("SELECT * FROM arkaplan WHERE sayfa=:grup_id ORDER BY sira DESC");
        $sor_slider->bindValue(":grup_id",@$_GET["grup_id"]);          
        $sor_slider->execute();

            if($sor_slider->rowCount() == 0){
                ?>

                        <div class="callout callout-info">
                          <h4>Listede hiç resim bulunamadı</h4>
                          <p>Lütfen önce resim ekleyin</p>
                        </div>
                    <?php }else{  
             foreach ($sor_slider->fetchAll() as $key => $value) {
          ?>
                   <li id="<?php echo "list_update_".$value["id"]; ?>" sira='<?php echo $value["sira"]; ?>' m_id='<?php echo $value["id"]; ?>'>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      <!-- checkbox -->
                     <!-- <input type="checkbox" value="" name=""> -->
                      <!-- todo text -->
                      <span class="text"><a href="#"><img width="300" height="63" class="ark_plan" m_id='<?php echo $value["id"]; ?>' src="<?php echo $file_read_path.$value["resim"]; ?>"></a>
                      <img class="pro_hid" style="display:none;" m_id='<?php echo $value["id"]; ?>' src="<?php echo $file_read_path.$value["profil"]; ?>">     
                      <k type="tr" m_id='<?php echo @$value["id"]; ?>'><?php echo @$value["title_tr"]; ?></k>
                      <k type="en" style="display:none;" m_id='<?php echo @$value["id"]; ?>'><?php echo @$value["name"]; ?></k>
                      <k type="gr" style="display:none;" m_id='<?php echo @$value["id"]; ?>'><?php echo @$value["title_gr"]; ?></k>
                      <k type="hu" style="display:none;" m_id='<?php echo @$value["id"]; ?>'><?php echo @$value["title_hu"]; ?></k>
                      </span>
                      <!-- Emphasis label -->
                      <small class="label label-danger"><i class="fa fa-clock-o"></i><?php echo $value["tarih"]; ?></small>
                      <!-- General tools such as edit or delete-->
                      <div class="list_active_control">
                      <div class="slider-track g <?php echo ($value["durum"]==1)?"acik_on":NULL; ?>" onclick='gunc_durum("<?php echo $value["id"]; ?>","g")' item_id="<?php echo $value["id"]; ?>" post_type="arkaplan">
                          <div class="slider-handle"></div>
                        </div>
                        </div>
                      <div class="tools">
                        <i class="fa fa-edit" onclick="slider_duzenle2('a_slider_ekle','<?php echo $value["id"]; ?>','galeri')"></i>
                        <i class="fa fa-trash-o" onclick="slider_sil('<?php echo $value["id"]; ?>','ark_planekle','info_field','a_slider_ekle')"></i>
                      </div>
                    </li>
        <?php }  }

  break;

	case "galeri":
	   	$sor_slider = $db->prepare("SELECT * FROM galeri WHERE grup_id=:grup_id ORDER BY sira DESC");
        $sor_slider->bindValue(":grup_id",@$_GET["grup_id"]);          
        $sor_slider->execute();

            if($sor_slider->rowCount() == 0){
                ?>

                        <div class="callout callout-info">
                          <h4>Listede hiç resim bulunamadı</h4>
                          <p>Lütfen önce resim ekleyin</p>
                        </div>
                    <?php }else{  
						 foreach ($sor_slider->fetchAll() as $key => $value) {
					?>
                   <li id="<?php echo "list_update_".$value["id"]; ?>" sira='<?php echo $value["sira"]; ?>' m_id='<?php echo $value["id"]; ?>'>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      <!-- checkbox -->
                     <!-- <input type="checkbox" value="" name=""> -->
                      <!-- todo text -->
                      <span class="text"><a href="#"><img width="80" height="80" m_id='<?php echo $value["id"]; ?>' src="<?php echo $file_read_path.$value["resim"]; ?>"></a> <k m_id='<?php echo $value["id"]; ?>'><?php echo $value["baslik"]; ?></k></span>
                      <!-- Emphasis label -->
                      <small class="label label-danger"><i class="fa fa-clock-o"></i><?php echo $value["tarih"]; ?></small>
                      <!-- General tools such as edit or delete-->
                      <div class="list_active_control">
                      <div class="slider-track <?php echo ($value["durum"]==1)?"acik_on":NULL; ?>" onclick='gunc_durum("<?php echo $value["id"]; ?>")' item_id="<?php echo $value["id"]; ?>" post_type="galeri">
                          <div class="slider-handle"></div>
                        </div>
                        </div>
                      <div class="tools">
                        <i class="fa fa-edit" onclick="slider_duzenle('a_slider_ekle','<?php echo $value["id"]; ?>','galeri')"></i>
                        <i class="fa fa-trash-o" onclick="slider_sil('<?php echo $value["id"]; ?>','galeri','info_field','a_slider_ekle')"></i>
                      </div>
                    </li>
        <?php }  }

	break;


	case "galeri_grup":

                      $sor_grup = $db->prepare("SELECT * FROM galeri_grup ORDER BY sira DESC");
                      $sor_grup->execute();

                      if($sor_grup->rowCount() == 0){
                    ?>

                        <div class="callout callout-info">
                          <h4>Listede hiç grup bulunamadı</h4>
                          <p>Lütfen önce grup ekleyin</p>
                        </div>
                    <?php }else{  ?>
                    <?php
                      foreach ($sor_grup->fetchAll() as $key => $value) {
                    ?>
  					<li id="<?php echo "list_update_".$value["id"]; ?>" sira='<?php echo $value["sira"]; ?>' m_id='g_<?php echo $value["id"]; ?>'>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      <!-- checkbox -->
                      
                      <!-- todo text -->
                      <span class="text"><g id='grup_name' class="grub_name" onclick="list_goruntule('<?php echo $value["id"]; ?>')"><?php echo $value["grup_name"]; ?></g></span>
                      <!-- Emphasis label -->
                      <small class="label label-default"><i class="fa fa-clock-o"></i><?php echo $value["tarih"]; ?></small>
                      <!-- General tools such as edit or delete-->
                        <div class="list_active_control">
                        <div class="slider-track <?php echo ($value["durum"]==1)?"acik_on":NULL; ?>" onclick='gunc_durum("<?php echo $value["id"]; ?>")' item_id="<?php echo $value["id"]; ?>" post_type="arkaplan_grup">
                          <div class="slider-handle"></div>
                        </div>
                        </div>
                      <div class="tools">
                        <i class="fa fa-edit" onclick="galeri_grup_duzenle('galeri_grub_form','<?php echo $value["id"]; ?>','galeri_grup')"></i>
                        <i class="fa fa-trash-o" onclick="galeri_grup_sil('<?php echo $value["id"]; ?>','galeri_grup','info_field_2','galeri_grub_ekle')"></i>
                      </div>
                    </li>
                    <?php } } 
	break;

  case "finans_list":
          $sor_grup = $db->prepare("SELECT * FROM finans WHERE tur=1 ORDER BY sira DESC");
                      $sor_grup->execute();

                      if($sor_grup->rowCount() == 0){
                    ?>

                        <div class="callout callout-info">
                          <h4>Listede hiç kategori bulunamadı</h4>
                          <p>Lütfen önce kategori ekleyin</p>
                        </div>
                    <?php }else{  ?>
                    <?php
                      foreach ($sor_grup->fetchAll() as $key => $value) {
                    ?>
            <li id="<?php echo "list_update_".$value["id"]; ?>" sira='<?php echo $value["sira"]; ?>' m_id='g_<?php echo $value["id"]; ?>'>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      <!-- checkbox -->
                      
                      <!-- todo text -->
                      <span class="text"><g id='grup_name' class="grub_name" onclick="list_goruntule_finans('<?php echo $value["id"]; ?>')"><?php echo $value["baslik"]; ?></g></span>
                        <div style="display:none;" class="ic_bilg" m_id='<?php echo $value["id"]; ?>'><?php echo $value["icerik"]; ?></div>
                      <!-- Emphasis label -->
                      <small class="label label-default"><i class="fa fa-clock-o"></i><?php echo $value["tarih"]; ?></small>
                      <!-- General tools such as edit or delete-->

                        <div class="list_active_control">
                        <div class="slider-track <?php echo ($value["durum"]==1)?"acik_on":NULL; ?>" onclick='gunc_durum("<?php echo $value["id"]; ?>")' item_id="<?php echo $value["id"]; ?>" post_type="finans_list">
                               <img src="<?php echo $file_read_path.$value["resim"]; ?>" style="display:none;" m_id="<?php echo $value["id"]; ?>">
                          <div class="slider-handle"></div>
                        </div>
                        </div>
                      <div class="tools">
                        <i class="fa fa-edit" onclick="galeri_grup_duzenle('galeri_grub_form','<?php echo $value["id"]; ?>','finans_list')"></i>
                        <i class="fa fa-trash-o" onclick="galeri_grup_sil_ana('<?php echo $value["id"]; ?>','finans_list','info_field_2','galeri_grub_ekle')"></i>
                      </div>
                    </li>
                    <?php } } 
  break;



  case "finans_list_2":
//AND ust_kt=

          $sor_grup = $db->prepare("SELECT * FROM finans WHERE tur=2 AND ust_kt='".$grup_id."' ORDER BY sira DESC");
                      $sor_grup->execute();

                      if($sor_grup->rowCount() == 0){
                    ?>

                        <div class="callout callout-info">
                          <h4>Listede hiç kategori bulunamadı</h4>
                          <p>Lütfen önce kategori ekleyin</p>
                        </div>
                    <?php }else{  ?>
                    <?php
                      foreach ($sor_grup->fetchAll() as $key => $value) {
                    ?>
        <li id="<?php echo "list_update_".$value["id"]; ?>" sira='<?php echo $value["sira"]; ?>' m_id='<?php echo $value["id"]; ?>'>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      <!-- checkbox -->
                     <!-- <input type="checkbox" value="" name=""> -->
                      <!-- todo text -->
                      <span class="text">
                      <a href="#"><img width="80" height="80" m_id='<?php echo $value["id"]; ?>' src="<?php echo $file_read_path.$value["resim"]; ?>"></a> 
                      <k m_id="<?php echo $value["id"]; ?>"><?php echo $value["baslik"]; ?></k>
                      </span>
                      <div style="display:none;" class="ic_bilg2" m_id='<?php echo $value["id"]; ?>'><?php echo $value["icerik"]; ?></div>

                      <!-- Emphasis label -->
                      <small class="label label-danger"><i class="fa fa-clock-o"></i><?php echo $value["tarih"]; ?></small>
                      <!-- General tools such as edit or delete-->
                      <div class="list_active_control">
                      <div class="slider-track g <?php echo ($value["durum"]==1)?"acik_on":NULL; ?>" onclick='gunc_durum("<?php echo $value["id"]; ?>","g")' item_id="<?php echo $value["id"]; ?>" post_type="finans_list">
                          <div class="slider-handle"></div>
                        </div>
                        </div>
                      <div class="tools">
                        <i class="fa fa-edit" onclick="alt_kt_duz('alt_kt','<?php echo $value["id"]; ?>','finans_list')"></i>
                        <i class="fa fa-trash-o" onclick="slider_sil('<?php echo $value["id"]; ?>','finans_list','info_field','a_slider_ekle')"></i>
                      </div>
                    </li>
                    <?php } 
                  } 
  break;





case "program_list":
          $sor_grup = $db->prepare("SELECT * FROM program WHERE tur=1 ORDER BY sira DESC");
                      $sor_grup->execute();

                      if($sor_grup->rowCount() == 0){
                    ?>

                        <div class="callout callout-info">
                          <h4>Listede hiç kategori bulunamadı</h4>
                          <p>Lütfen önce kategori ekleyin</p>
                        </div>
                    <?php }else{  ?>
                    <?php
                      foreach ($sor_grup->fetchAll() as $key => $value) {
                    ?>
            <li id="<?php echo "list_update_".$value["id"]; ?>" sira='<?php echo $value["sira"]; ?>' m_id='g_<?php echo $value["id"]; ?>'>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      <!-- checkbox -->
                      
                      <!-- todo text -->
                      <span class="text"><g id='grup_name' class="grub_name" onclick="list_goruntule_program('<?php echo $value["id"]; ?>')"><?php echo $value["baslik"]; ?></g></span>
                      <div style="display:none;" class="ic_bilg" m_id='<?php echo $value["id"]; ?>'><?php echo $value["icerik"]; ?></div>
                      <l m_id='<?php echo $value["id"]; ?>' style="display:none;"><?php echo $value["filtre_id"]; ?></l>

                      <!-- Emphasis label -->
                      <small class="label label-default"><i class="fa fa-clock-o"></i><?php echo $value["tarih"]; ?></small>
                      <!-- General tools such as edit or delete-->
                        <div class="list_active_control">
                        <div class="slider-track <?php echo ($value["durum"]==1)?"acik_on":NULL; ?>" onclick='gunc_durum("<?php echo $value["id"]; ?>")' item_id="<?php echo $value["id"]; ?>" post_type="program_list">
                          <div class="slider-handle"></div>
                        </div>
                        </div>
                      <div class="tools">
                        <i class="fa fa-edit" onclick="galeri_grup_duzenle('galeri_grub_form','<?php echo $value["id"]; ?>','program_list')"></i>
                        <i class="fa fa-trash-o" onclick="galeri_grup_sil('<?php echo $value["id"]; ?>','program_list','info_field_2','galeri_grub_ekle')"></i>
                      </div>
                    </li>
                    <?php } } 
  break;



  case "program_list_2":
//AND ust_kt=
        
                   $sor_grup = $db->prepare("SELECT * FROM program WHERE tur=2 AND ust_kt='".$grup_id."' ORDER BY sira DESC");
                      $sor_grup->execute();

                      if($sor_grup->rowCount() == 0){
                    ?>

                        <div class="callout callout-info">
                          <h4>Listede hiç kategori bulunamadı</h4>
                          <p>Lütfen önce kategori ekleyin</p>
                        </div>
                    <?php }else{  ?>
                    <?php
                      foreach ($sor_grup->fetchAll() as $key => $value) {
                    ?>
        <li id="<?php echo "list_update_".$value["id"]; ?>" sira='<?php echo $value["sira"]; ?>' m_id='<?php echo $value["id"]; ?>'>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      <!-- checkbox -->
                     <!-- <input type="checkbox" value="" name=""> -->
                      <!-- todo text -->
                      <span class="text">
                                 <?php 
                      if(!empty($value["resim"])){
                    ?>  

                      <a href="#">
                    <img width="80" height="80" m_id='<?php echo $value["id"]; ?>' src="<?php echo $file_read_path.$value["resim"]; ?>"></a> 
                    <?php  } ?>
                      
                      <k m_id="<?php echo $value["id"]; ?>"><?php echo $value["baslik"]; ?></k>
                      </span>
                      <div style="display:none;" class="ic_bilg2" m_id='<?php echo $value["id"]; ?>'><?php echo $value["icerik"]; ?></div>
                      <l m_id='<?php echo $value["id"]; ?>' style="display:none;"><?php echo $value["filtre_id"]; ?></l>
                      
                      <!-- Emphasis label -->
                      <small class="label label-danger"><i class="fa fa-clock-o"></i><?php echo $value["tarih"]; ?></small>
                      <!-- General tools such as edit or delete-->
                      <div class="list_active_control">
                      <div class="slider-track g <?php echo ($value["durum"]==1)?"acik_on":NULL; ?>" onclick='gunc_durum("<?php echo $value["id"]; ?>","g")' item_id="<?php echo $value["id"]; ?>" post_type="program_list">
                          <div class="slider-handle"></div>
                        </div>
                        </div>
                      <div class="tools">
                        <i class="fa fa-edit" onclick="alt_kt_duz('alt_kt','<?php echo $value["id"]; ?>','program_list')"></i>
                        <i class="fa fa-trash-o" onclick="slider_sil('<?php echo $value["id"]; ?>','program_list','info_field','a_slider_ekle')"></i>
                      </div>
                    </li>
                    <?php } } 
  break;

  case "white_papers":

                      $sor_slider = $db->prepare("SELECT * FROM slider WHERE tip='1' ORDER BY sira DESC");
                      $sor_slider->execute();
  foreach ($sor_slider->fetchAll() as $key => $value) {
?>
                   <li id="<?php echo "list_update_".$value["id"]; ?>" sira='<?php echo $value["sira"]; ?>' m_id='<?php echo $value["id"]; ?>'>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      <!-- checkbox -->
                     <!-- <input type="checkbox" value="" name=""> -->
                      <!-- todo text -->
                      <span class="text"><!--<a href="#"><img width="80" height="80" m_id='<?php echo $value["id"]; ?>' src="<?php echo $file_read_path.$value["resim"]; ?>"></a>--> <k m_id='<?php echo $value["id"]; ?>' style="display:inline-block;"><?php echo $value["baslik"]; ?></k>
<div style="display: none;" m_id='<?php echo $value["id"]; ?>'><?php echo $value["paragraf"]; ?></div>
                                </span>
                      <!-- Emphasis label -->
                      <small class="label label-danger"><i class="fa fa-clock-o"></i><?php echo $value["tarih"]; ?></small>
                      <!-- General tools such as edit or delete-->
                          <div class="list_active_control">
                      <div class="slider-track <?php echo ($value["durum"]==1)?"acik_on":NULL; ?>" onclick='gunc_durum("<?php echo $value["id"]; ?>")' item_id="<?php echo $value["id"]; ?>" post_type="ana_slider">
                          <div class="slider-handle"></div>
                        </div>
                        </div>
                      <div class="tools">
                        <i class="fa fa-edit" onclick="slider_duzenle('a_slider_ekle','<?php echo $value["id"]; ?>','a_slider_ekle')"></i>
                        <i class="fa fa-trash-o" onclick="slider_sil('<?php echo $value["id"]; ?>','ana_slider','info_field','a_slider_ekle')"></i>
                      </div>
                  
                    </li>
                    <?php 
 } 
  break;


  case "referans":

   $sor_slider = $db->prepare("SELECT * FROM referanslar ORDER BY sira DESC");
                      $sor_slider->execute();
  foreach ($sor_slider->fetchAll() as $key => $value) {
?>

                   <li id="<?php echo "list_update_".$value["id"]; ?>" sira='<?php echo $value["sira"]; ?>' m_id='<?php echo $value["id"]; ?>'>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      <!-- checkbox -->
                     <!-- <input type="checkbox" value="" name=""> -->
                      <!-- todo text -->
                      <span class="text"> <k m_id='<?php echo $value["id"]; ?>' style="display:inline-block;"><?php echo $value["isim"]; ?></k>

                                </span>
                      <!-- Emphasis label -->
                      <small class="label label-danger"><i class="fa fa-clock-o"></i><?php echo $value["tarih"]; ?></small>
                      <!-- General tools such as edit or delete-->
                          <div class="list_active_control">
                      <div class="slider-track <?php echo ($value["durum"]==1)?"acik_on":NULL; ?>" onclick='gunc_durum("<?php echo $value["id"]; ?>")' item_id="<?php echo $value["id"]; ?>" post_type="referans">
                          <div class="slider-handle"></div>
                        </div>
                        </div>
                      <div class="tools">
                        <i class="fa fa-edit" onclick="referans_duzenle('a_slider_ekle','<?php echo $value["id"]; ?>','a_slider_ekle')"></i>
                        <i class="fa fa-trash-o" onclick="slider_sil('<?php echo $value["id"]; ?>','referans','info_field','a_slider_ekle')"></i>
                      </div>
                  
                    </li>
        <?php } 

  break;

  case "isveren_markasi":
          $sor_grup = $db->prepare("SELECT * FROM isveren_markasi WHERE tur=1 ORDER BY sira DESC");
                      $sor_grup->execute();

                      if($sor_grup->rowCount() == 0){
                    ?>

                        <div class="callout callout-info">
                          <h4>Listede hiç kategori bulunamadı</h4>
                          <p>Lütfen önce kategori ekleyin</p>
                        </div>
                    <?php }else{  ?>
                    <?php
                      foreach ($sor_grup->fetchAll() as $key => $value) {
                    ?>
            <li id="<?php echo "list_update_".$value["id"]; ?>" sira='<?php echo $value["sira"]; ?>' m_id='g_<?php echo $value["id"]; ?>'>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      <!-- checkbox -->
                      
                      <!-- todo text -->
                      <span class="text"><g id='grup_name' class="grub_name" onclick="list_goruntule_isveren_markasi('<?php echo $value["id"]; ?>')"><?php echo $value["baslik"]; ?></g></span>
                      <div style="display:none;" class="ic_bilg" m_id='<?php echo $value["id"]; ?>'><?php echo $value["icerik"]; ?></div>

                      <!-- Emphasis label -->
                      <small class="label label-default"><i class="fa fa-clock-o"></i><?php echo $value["tarih"]; ?></small>
                      <!-- General tools such as edit or delete-->
                        <div class="list_active_control">
                        <div class="slider-track <?php echo ($value["durum"]==1)?"acik_on":NULL; ?>" onclick='gunc_durum("<?php echo $value["id"]; ?>")' item_id="<?php echo $value["id"]; ?>" post_type="isveren_markasi">
                               <img src="<?php echo $file_read_path.$value["resim"]; ?>" style="display:none;" m_id="<?php echo $value["id"]; ?>">
                          <div class="slider-handle"></div>
                        </div>
                        </div>
                      <div class="tools">
                        <i class="fa fa-edit" onclick="galeri_grup_duzenle('galeri_grub_form','<?php echo $value["id"]; ?>','isveren_markasi')"></i>
                        <i class="fa fa-trash-o" onclick="galeri_grup_sil_ana('<?php echo $value["id"]; ?>','isveren_markasi','info_field_2','galeri_grub_ekle')"></i>
                      </div>
                    </li>
                    <?php } } 
  break;



  case "isveren_markasi_2":
//AND ust_kt=

          $sor_grup = $db->prepare("SELECT * FROM isveren_markasi WHERE tur=2 AND ust_kt='".$grup_id."' ORDER BY sira DESC");
                      $sor_grup->execute();

                      if($sor_grup->rowCount() == 0){
                    ?>

                        <div class="callout callout-info">
                          <h4>Listede hiç kategori bulunamadı</h4>
                          <p>Lütfen önce kategori ekleyin</p>
                        </div>
                    <?php }else{  ?>
                    <?php
                      foreach ($sor_grup->fetchAll() as $key => $value) {
                    ?>
        <li id="<?php echo "list_update_".$value["id"]; ?>" sira='<?php echo $value["sira"]; ?>' m_id='<?php echo $value["id"]; ?>'>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      <!-- checkbox -->
                     <!-- <input type="checkbox" value="" name=""> -->
                      <!-- todo text -->
                      <span class="text">
                      <a href="#"><img width="80" height="80" m_id='<?php echo $value["id"]; ?>' src="<?php echo $file_read_path.$value["resim"]; ?>"></a> 
                      <k m_id="<?php echo $value["id"]; ?>"><?php echo $value["baslik"]; ?></k>
                      </span>
                      <div style="display:none;" class="ic_bilg2" m_id='<?php echo $value["id"]; ?>'><?php echo $value["icerik"]; ?></div>

                      <!-- Emphasis label -->
                      <small class="label label-danger"><i class="fa fa-clock-o"></i><?php echo $value["tarih"]; ?></small>
                      <!-- General tools such as edit or delete-->
                      <div class="list_active_control">
                      <div class="slider-track g <?php echo ($value["durum"]==1)?"acik_on":NULL; ?>" onclick='gunc_durum("<?php echo $value["id"]; ?>","g")' item_id="<?php echo $value["id"]; ?>" post_type="isveren_markasi">
                          <div class="slider-handle"></div>
                        </div>
                        </div>
                      <div class="tools">
                        <i class="fa fa-edit" onclick="alt_kt_duz('alt_kt','<?php echo $value["id"]; ?>','isveren_markasi')"></i>
                        <i class="fa fa-trash-o" onclick="slider_sil('<?php echo $value["id"]; ?>','isveren_markasi','info_field','a_slider_ekle')"></i>
                      </div>
                    </li>
                    <?php } 
                  } 
  break;

  
  case "insan_kaynaklari":
          $sor_grup = $db->prepare("SELECT * FROM insan_kaynaklari WHERE tur=1 ORDER BY sira DESC");
                      $sor_grup->execute();

                      if($sor_grup->rowCount() == 0){
                    ?>

                        <div class="callout callout-info">
                          <h4>Listede hiç kategori bulunamadı</h4>
                          <p>Lütfen önce kategori ekleyin</p>
                        </div>
                    <?php }else{  ?>
                    <?php
                      foreach ($sor_grup->fetchAll() as $key => $value) {
                    ?>
            <li id="<?php echo "list_update_".$value["id"]; ?>" sira='<?php echo $value["sira"]; ?>' m_id='g_<?php echo $value["id"]; ?>'>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      <!-- checkbox -->
                      
                      <!-- todo text -->
                      <span class="text"><g id='grup_name' class="grub_name" onclick="list_goruntule_insan_kaynalari('<?php echo $value["id"]; ?>')"><?php echo $value["baslik"]; ?></g></span>
                      <div style="display:none;" class="ic_bilg" m_id='<?php echo $value["id"]; ?>'><?php echo $value["icerik"]; ?></div>

                      <!-- Emphasis label -->
                      <small class="label label-default"><i class="fa fa-clock-o"></i><?php echo $value["tarih"]; ?></small>
                      <!-- General tools such as edit or delete-->
                        <div class="list_active_control">
                        <div class="slider-track <?php echo ($value["durum"]==1)?"acik_on":NULL; ?>" onclick='gunc_durum("<?php echo $value["id"]; ?>")' item_id="<?php echo $value["id"]; ?>" post_type="insan_kaynaklari">
                               <img src="<?php echo $file_read_path.$value["resim"]; ?>" style="display:none;" m_id="<?php echo $value["id"]; ?>">
                          <div class="slider-handle"></div>
                        </div>
                        </div>
                      <div class="tools">
                        <i class="fa fa-edit" onclick="galeri_grup_duzenle('galeri_grub_form','<?php echo $value["id"]; ?>','insan_kaynaklari')"></i>
                        <i class="fa fa-trash-o" onclick="galeri_grup_sil_ana('<?php echo $value["id"]; ?>','insan_kaynaklari','info_field_2','galeri_grub_ekle')"></i>
                      </div>
                    </li>
                    <?php } } 
  break;



  case "insan_kaynaklari_2":
//AND ust_kt=

          $sor_grup = $db->prepare("SELECT * FROM insan_kaynaklari WHERE tur=2 AND ust_kt='".$grup_id."' ORDER BY sira DESC");
                      $sor_grup->execute();

                      if($sor_grup->rowCount() == 0){
                    ?>

                        <div class="callout callout-info">
                          <h4>Listede hiç kategori bulunamadı</h4>
                          <p>Lütfen önce kategori ekleyin</p>
                        </div>
                    <?php }else{  ?>
                    <?php
                      foreach ($sor_grup->fetchAll() as $key => $value) {
                    ?>
        <li id="<?php echo "list_update_".$value["id"]; ?>" sira='<?php echo $value["sira"]; ?>' m_id='<?php echo $value["id"]; ?>'>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      <!-- checkbox -->
                     <!-- <input type="checkbox" value="" name=""> -->
                      <!-- todo text -->
                      <span class="text">
                      <a href="#"><img width="80" height="80" m_id='<?php echo $value["id"]; ?>' src="<?php echo $file_read_path.$value["resim"]; ?>"></a> 
                      <k m_id="<?php echo $value["id"]; ?>"><?php echo $value["baslik"]; ?></k>
                      </span>

                      <div style="display:none;" class="ic_bilg2" m_id='<?php echo $value["id"]; ?>'><?php echo $value["icerik"]; ?></div>

                      <!-- Emphasis label -->
                      <small class="label label-danger"><i class="fa fa-clock-o"></i><?php echo $value["tarih"]; ?></small>
                      <!-- General tools such as edit or delete-->
                      <div class="list_active_control">
                      <div class="slider-track g <?php echo ($value["durum"]==1)?"acik_on":NULL; ?>" onclick='gunc_durum("<?php echo $value["id"]; ?>","g")' item_id="<?php echo $value["id"]; ?>" post_type="insan_kaynaklari">
                          <div class="slider-handle"></div>
                        </div>
                        </div>
                      <div class="tools">
                        <i class="fa fa-edit" onclick="alt_kt_duz('alt_kt','<?php echo $value["id"]; ?>','insan_kaynaklari')"></i>
                        <i class="fa fa-trash-o" onclick="slider_sil('<?php echo $value["id"]; ?>','insan_kaynaklari','info_field','a_slider_ekle')"></i>
                      </div>
                    </li>
                    <?php } 
                  } 
  break;

  case "ekip_list":
                      $sor_grup = $db->prepare("SELECT * FROM ekip WHERE tur=1 ORDER BY sira DESC");
                      $sor_grup->execute();

                      if($sor_grup->rowCount() == 0){
                    ?>

                        <div class="callout callout-info">
                          <h4>Listede hiç içerik bulunamadı</h4>
                          <p>Lütfen önce içerik ekleyin</p>
                        </div>
                    <?php }else{  ?>
                    <?php
                      foreach ($sor_grup->fetchAll() as $key => $value) {
                    ?>

                    <li id="<?php echo "list_update_".$value["id"]; ?>" sira='<?php echo $value["sira"]; ?>' m_id='g_<?php echo $value["id"]; ?>'>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      <!-- checkbox -->
                      
                      <!-- todo text -->
                      <span class="text"><g id='grup_name' class="grub_name"><?php echo $value["baslik"]; ?></g></span>
                      <div style="display:none;" class="ic_bilg" m_id='<?php echo $value["id"]; ?>'><?php echo $value["icerik"]; ?></div>
                      <div style="display:none;" class="unvan" m_id='<?php echo $value["id"]; ?>'><?php echo $value["unvan"]; ?></div>
                 <social style="display:none;" class="facebook" m_id='<?php echo $value["id"]; ?>'><?php echo $value["facebook"]; ?></social>
                      <social style="display:none;" class="twitter" m_id='<?php echo $value["id"]; ?>'><?php echo $value["twitter"]; ?></social>
                      <social style="display:none;" class="web" m_id='<?php echo $value["id"]; ?>'><?php echo $value["web"]; ?></social>
                      <social style="display:none;" class="linkedin" m_id='<?php echo $value["id"]; ?>'><?php echo $value["linkedin"]; ?></social>
                      <social style="display:none;" class="mail" m_id='<?php echo $value["id"]; ?>'><?php echo $value["mail"]; ?></social>
                      <!-- Emphasis label -->
                      <small class="label label-default"><i class="fa fa-clock-o"></i><?php echo $value["tarih"]; ?></small>
                      <!-- General tools such as edit or delete-->
                        <div class="list_active_control">
                        <div class="slider-track <?php echo ($value["durum"]==1)?"acik_on":NULL; ?>" onclick='gunc_durum("<?php echo $value["id"]; ?>")' item_id="<?php echo $value["id"]; ?>" post_type="ekip_list">
                        <img src="<?php echo $file_read_path.$value["resim"]; ?>" style="display:none;" m_id="<?php echo $value["id"]; ?>">
                          <div class="slider-handle"></div>
                        </div>
                        </div>
                      <div class="tools">
                        <i class="fa fa-edit" onclick="galeri_grup_duzenle('galeri_grub_form','<?php echo $value["id"]; ?>','galeri_grup')"></i>
                        <i class="fa fa-trash-o" onclick="galeri_grup_sil_ana('<?php echo $value["id"]; ?>','ekip_list','info_field_2','galeri_grub_form')"></i>
                      </div>
                    </li>
                    <?php } } 
  break;



case "brosurler":


              $sor_slider = $db->prepare("SELECT * FROM brosurler ORDER BY sira DESC");
               $sor_slider->execute();

                if($sor_slider->rowCount() == 0){
                    ?>

                 <div class="callout callout-info">
                    <h4>Listede hiç içerik bulunamadı</h4>
                    <p>Lütfen içerik ekleyin</p>
                  </div>
<?php
 }else{  
  foreach ($sor_slider->fetchAll() as $key => $value) {
?>

                   <li id="<?php echo "list_update_".$value["id"]; ?>" sira='<?php echo $value["sira"]; ?>' m_id='<?php echo $value["id"]; ?>'>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      <!-- checkbox -->
                     <!-- <input type="checkbox" value="" name=""> -->
                      <!-- todo text -->
                      <span class="text"> <k m_id='<?php echo $value["id"]; ?>' style="display:inline-block;"><?php echo $value["baslik"]; ?></k>

                                </span>
                      <!-- Emphasis label -->
                      <small class="label label-danger"><i class="fa fa-clock-o"></i><?php echo $value["tarih"]; ?></small>
                      <!-- General tools such as edit or delete-->
                          <div class="list_active_control">
                      <div class="slider-track <?php echo ($value["durum"]==1)?"acik_on":NULL; ?>" onclick='gunc_durum("<?php echo $value["id"]; ?>")' item_id="<?php echo $value["id"]; ?>" post_type="brosurler">
                          <div class="slider-handle"></div>
                        </div>
                        </div>
                      <div class="tools">
                        <i class="fa fa-edit" onclick="brosur_duzenle('slider_ekles','<?php echo $value["id"]; ?>','a_slider_ekle')"></i>
                        <i class="fa fa-trash-o" onclick="brosur_sil('<?php echo $value["id"]; ?>','brosurler','info_field','a_slider_ekle')"></i>
                      </div>
                  
                    </li>
        <?php 
      } 
    }
break;
}
 ?>