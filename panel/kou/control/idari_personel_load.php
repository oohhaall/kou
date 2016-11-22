     <?php 

  require_once "../config/global_cont.php";

extract($_GET);
extract($_POST);
  
    $dt_table = "personel";

                                  $sor_slider = $db->prepare("SELECT * FROM $dt_table WHERE type='3' ORDER BY sira DESC LIMIT 0,10");
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
                          
                              <img width="80" height="80" m_id='<?php echo $value["id"]; ?>' src="<?php echo ($value["resim"]!="")?$file_read_path.$value["resim"]:""; ?>">
                               



                            <bilgiler>
                                <g m_id='<?php echo $value["id"]; ?>'><?php echo $value["isim"]; ?></g>
                                <url m_id='<?php echo $value["id"]; ?>' style="display: none"><?php echo $value["url"]; ?></url>
                                <email m_id='<?php echo $value["id"]; ?>' style="display: none"><?php echo $value["email"]; ?></email>
                                <oda m_id='<?php echo $value["id"]; ?>' style="display: none"><?php echo $value["oda"]; ?></oda>
                                <anabil m_id='<?php echo $value["id"]; ?>' style="display: none"><?php echo $value["anabilim_dali"]; ?></anabil>
                                <tel m_id='<?php echo $value["id"]; ?>' style="display: none"><?php echo $value["telefon"]; ?></tel>
                                <?php 
                                  foreach ($dil_text as $key => $values) {
                                    ?>
                                <arastirma type="<?php echo $key; ?>" m_id='<?php echo $value["id"]; ?>' style="display: none"><?php echo $value["arastirma_alani_$key"]; ?></arastirma>
                                  <?php
                                  }
                                ?>
                            </bilgiler>

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
                        <i class="fa fa-edit" onclick="slider_duzenle('ana_slider_ekle','<?php echo $value["id"]; ?>','list_slider','a_slider_ekle')"></i>
                        <i class="fa fa-trash-o" onclick="slider_sil('ana_slider_ekle','<?php echo $value["id"]; ?>','list_slider','a_slider_ekle','info_field')"></i>
                      </div>
                  
                    </li>
        <?php } } ?>