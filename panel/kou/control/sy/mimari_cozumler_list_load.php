 <?php
 require_once "../config/global_cont.php";
      $dt_table = "urunler";
  extract($_GET);
  extract($_POST);

                      $sor_slider = $db->prepare("SELECT * FROM urunler WHERE kid=0 ORDER BY sra DESC LIMIT 0,$load_max");
                      $sor_slider->execute();

                      if($sor_slider->rowCount() == 0){
                    ?>

                 <div class="callout callout-info">
                    <h4>Listede hiç ürün bulunamadı</h4>
                    <p>Lütfen ürün ekleyin</p>
                  </div>
<?php }else{  ?>
<?php
  foreach ($sor_slider->fetchAll() as $key => $value) {
?>

                   <li id="<?php echo "list_update_".$value["id"]; ?>" sira='<?php echo $value["sra"]; ?>' m_id='<?php echo $value["id"]; ?>'>
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
                          <img type="" width="80" height="80" m_id='<?php echo $value["id"]; ?>' src="<?php echo ($value["resim"]!="")?$file_read_path.$value["resim"]:""; ?>">
                            <?php
                              /*  foreach ($dil_text as $dil_key => $dil_val) {
                                    $style = ($dil_key=="tr")?"style='display:inline-block;'":"style='display:none;'";
                                  ?>
                                    <img type="<?php echo $dil_key; ?>" <?php echo $style; ?> width="80" height="80" m_id='<?php echo $value["id"]; ?>' src="<?php echo ($value["resim_".$dil_key]!="")?$file_read_path.$value["resim_".$dil_key]:""; ?>">
                                  <?php
                                }*/
                            ?>
                          </a> 



                            <?php
                                foreach ($dil_text as $dil_key => $dil_val) {
                                    $style = ($dil_key=="tr")?"style='display:inline-block;'":"style='display:none;'";
                                  ?>
                                  <g type="<?php echo $dil_key; ?>" m_id='<?php echo $value["id"]; ?>' <?php echo $style; ?>><?php echo $value["urunAdi_".$dil_key]; ?></g>
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
                      <div class="slider-track <?php echo ($value["drm"]==1)?"acik_on":NULL; ?>" onclick='gunc_durum("<?php echo $value["id"]; ?>")' item_id="<?php echo $value["id"]; ?>" post_type="ana_slider" dt_table="urunler">
                          <div class="slider-handle"></div>
                        </div>
                        </div>
                      <div class="tools">
                        <i class="fa fa-edit" onclick="slider_duzenle('<?php echo $value["id"]; ?>')"></i>
                        <i class="fa fa-trash-o" onclick="slider_sil('<?php echo $value["id"]; ?>','info_field')"></i>
                      </div>
                  
                    </li>
        <?php } } ?>