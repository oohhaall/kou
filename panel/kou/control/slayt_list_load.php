     <?php 

  require_once "../config/global_cont.php";

extract($_GET);
extract($_POST);
  
    $dt_table = "slider";

                      $sor_slider = $db->prepare("SELECT * FROM $dt_table WHERE type='1' ORDER BY sira DESC LIMIT 0,$load_max");
                     /// $sor_slider->bindValue(":num",$load_max);
                      $sor_slider->execute();

                      if($sor_slider->rowCount() == 0){
                     // echo $load_max;

                    ?>

                 <div class="callout callout-info">
                    <h4>Listede hiç slayt bulunamadı</h4>
                    <p>Lütfen slayt ekleyin</p>
                  </div>
<?php }else{  ?>
<?php
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
                      <span class="text">
                          <a href="#">
                            <?php
                                foreach ($dil_text as $dil_key => $dil_val) {
                                    $style = ($dil_key=="tr")?"style='display:inline-block;'":"style='display:none;'";
                                  ?>
                                    <img type="<?php echo $dil_key; ?>" <?php echo $style; ?> width="80" height="80" m_id='<?php echo $value["id"]; ?>' src="<?php echo ($value["resim_".$dil_key]!="")?$file_read_path.$value["resim_".$dil_key]:""; ?>">
                                  <?php
                                }
                            ?>
                          </a> 



                            <?php
                                foreach ($dil_text as $dil_key => $dil_val) {
                                    $style = ($dil_key=="tr")?"style='display:inline-block;'":"style='display:none;'";
                                  ?>
                                  <g type="<?php echo $dil_key; ?>" m_id='<?php echo $value["id"]; ?>' <?php echo $style; ?>><?php echo $value["baslik_".$dil_key]; ?></g>
                                  <?php
                                }
                            ?>

                         <?php
                                foreach ($dil_text as $dil_key => $dil_val) {
                                    $style = "style='display:none;'";
                                  ?>
                                  <i type="<?php echo $dil_key; ?>" m_id='<?php echo $value["id"]; ?>' <?php echo $style; ?>><?php echo $value["aciklama_".$dil_key]; ?></i>
                                  <?php
                                }
                            ?>

                            <u  m_id='<?php echo $value["id"]; ?>' style="display: none"><?php echo $value["link"]; ?></u>


                      </span>
                      <!-- Emphasis label -->
                      <small class="label label-danger"><i class="fa fa-clock-o"></i><?php echo $value["tarih"]; ?></small>
                      <!-- General tools such as edit or delete-->
                          <div class="list_active_control">
                      <div class="slider-track <?php echo ($value["durum"]==1)?"acik_on":NULL; ?>" onclick='gunc_durum("<?php echo $value["id"]; ?>")' item_id="<?php echo $value["id"]; ?>" post_type="ana_slider" dt_table="<?php echo $dt_table; ?>">
                          <div class="slider-handle"></div>
                        </div>
                        </div>
                      <div class="tools">
                        <i class="fa fa-edit" onclick="slider_duzenle('ana_slider_ekle','<?php echo $value["id"]; ?>','list_slayt','a_slider_ekle')"></i>
                        <i class="fa fa-trash-o" onclick="slider_sil('ana_slider_ekle','<?php echo $value["id"]; ?>','list_slayt','a_slider_ekle','info_field')"></i>
                      </div>
                  
                    </li>
        <?php } } ?>