<?php 
  require_once "../config/global_cont.php";

	extract($_GET);
	extract($_POST);



                      $sor_slider = $db->prepare("SELECT * FROM yapigereclerislayt WHERE uid=:uid AND dil=:dil ORDER BY sra DESC");
                      $sor_slider->bindValue(":uid",$uid);
                      $sor_slider->bindValue(":dil",$dil_key);
                      $sor_slider->execute();

                      if($sor_slider->rowCount() == 0){
                    ?>

                 <div class="callout callout-info">
                    <h4>Listede hiç içerik bulunamadı</h4>
                    <p>Lütfen içerik ekleyin</p>
                  </div>
              <?php }else{  ?>

              <?php
                foreach ($sor_slider->fetchAll() as $key => $value) {
              ?>


                   <li id="<?php echo "list_update_".$value["id"]; ?>" kategori='<?php echo $value["uid"]; ?>' dil='<?php echo $value["dil"]; ?>' sra='<?php echo $value["sra"]; ?>' m_id='<?php echo $value["id"]; ?>'>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      <!-- checkbox -->
                     <!-- <input type="checkbox" value="" name=""> -->
                      <!-- todo text -->
                      <span class="text">
                      <a href="#">
                      <img width="80" height="80" class="slid_alt" m_id='<?php echo $value["id"]; ?>' src="<?php echo $file_read_path.$value["resim"]; ?>"></a> 
                      </span>


                      <!-- Emphasis label -->
                      <small class="label label-danger"><i class="fa fa-clock-o"></i><?php echo $value["tarih"]; ?></small>
                      <!-- General tools such as edit or delete-->
                      <div class="list_active_control">
                      <div class="slider-track g <?php echo ($value["drm"]==1)?"acik_on":NULL; ?>" onclick='gunc_durum("<?php echo $value["id"]; ?>","g")' item_id="<?php echo $value["id"]; ?>" post_type="finans">
                          <div class="slider-handle"></div>
                        </div>
                        </div>
                      <div class="tools">
                        <i class="fa fa-edit" onclick="alt_kat_duz('alt_kt','<?php echo $value["id"]; ?>')"></i>
                        <i class="fa fa-trash-o" onclick="slider_sil('<?php echo $value["id"]; ?>','finans_list','info_field','a_slider_ekle')"></i>
                      </div>
                    </li>
                <?php } 

              } 
                        

?>

                         

