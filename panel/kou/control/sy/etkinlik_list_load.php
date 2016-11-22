<?php 
		require_once "../config/global_cont.php";
		extract($_POST);
		extract($_GET);


$table = "seranitguncel";
$page_list = "etkinlik_list";
  				$sor_slider = $db->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT 0,$load_max");
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

                   <li id="<?php echo "list_update_".$value["id"]; ?>" m_id='<?php echo $value["id"]; ?>'>
                      <!-- drag handle 
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>-->
                      <!-- checkbox -->
                     <!-- <input type="checkbox" value="" name=""> -->
                      <!-- todo text -->
                      <span class="text">
                    

                            <?php
                                foreach ($dil_text as $dil_key => $dil_val) {
                                    $style = ($dil_key=="tr")?"style='display:inline-block;'":"style='display:none;'";
                                  ?>
                                  <g type="<?php echo $dil_key; ?>" m_id='<?php echo $value["id"]; ?>' <?php echo $style; ?>><?php echo $value["baslik_".$dil_key]; ?></g>
                                  <ac type="<?php echo $dil_key; ?>" m_id='<?php echo $value["id"]; ?>' style="display: none;"><?php echo $value["aciklama_".$dil_key]; ?></ac>
                                  <?php
                                }
                            ?>


                            <m  m_id='<?php echo $value["id"]; ?>' style="display: none"><?php echo $value["tarih"]; ?></m>


                      </span>
                      <!-- Emphasis label -->
                      <small class="label label-danger"><i class="fa fa-clock-o"></i><?php echo $value["tarih"]; ?></small>
                      <!-- General tools such as edit or delete-->
                          <div class="list_active_control">
                          <a class="popup_page" data-fancybox-type="ajax" sid="<?php echo $value["id"]; ?>" d_h="etkinlik_galeri" href="javascript:;" style="color:inherit;"><span class="glyphicon glyphicon-picture"></span></a>
                      <div class="slider-track <?php echo ($value["drm"]==1)?"acik_on":NULL; ?>" onclick='gunc_durum("<?php echo $value["id"]; ?>")' item_id="<?php echo $value["id"]; ?>" post_type="ana_slider" dt_table="<?php echo $table; ?>">
                          <div class="slider-handle"></div>
                        </div>
                        </div>
                      <div class="tools">
                        <i class="fa fa-edit" onclick="slider_duzenle('ana_slider_ekle','<?php echo $value["id"]; ?>','list_içerik','a_slider_ekle')"></i>
                        <i class="fa fa-trash-o" onclick="slider_sil('ana_slider_ekle','<?php echo $value["id"]; ?>','list_içerik','a_slider_ekle','info_field')"></i>
                      </div>
                  
                    </li>
        <?php } } ?>

        <script type="text/javascript">
        $(document).ready(function(){
            $('.popup_page').on("click", function (e) {
    var uri = $(this).attr("d_h");
    var uuid = $(this).attr("sid");
    e.preventDefault(); // avoids calling preview.php
    $.ajax({
      type: "POST",
      cache: false,
      url: "piston/popup/"+uri+".php",
      data:{page_uri:uri,uid:uuid},
      success: function (data) {
        $.fancybox(data,{
          fitToView: true,
          autoSize: true,
          openEffect: 'none',
          closeEffect: 'none',
          minWidth:500
        }); // fancybox
      } // success
    }); // ajax
  }); // on

            });
        </script>