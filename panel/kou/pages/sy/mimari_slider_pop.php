<?php 

require_once "../config/global_cont.php";
extract($_POST);
$dt_table = "urunslayt";
?>
<div class="main_full_pop">
  <section class="content-header">
          <h1>
            Slider Resimler
            <small>Resim Listesi</small>
          </h1>

        </section>
 <section class="content">
  <!-- TO DO List -->

              <div class="box box-primary" id="list_slayt">
                <div class="box-header">
                  <i class="fa fa-files-o"></i>
                  <h3 class="box-title">Resim Ekle</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <form role="form" id="slider_ekles" method="post" enctype="multipart/form-data" onsubmit="return dosya_ekle();">
                      <input type="hidden" name="tip" value="1">
                      <input type="hidden" name="sid" value="<?php echo $uid; ?>">
                      <input type="hidden" name="eid" value="0">
                  <div class="box-body">
        
                    <div class="form-group">
                      <label for="exampleInputEmail1">Broşür</label>
                      <div class="brs">
                      <div class="ajax-file-upload-container"  id="extraupload"></div>
                      </div>
                    </div>
          
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                   <button class="btn btn-danger">Ekle</button>
                  </div>
                </form>
                
     <div id="info_field_pop">
   


 </div>               
          
 <ul class="todo-list detay_popup" post_uri="mimari_cozum_ekle_pop" dt_table="<?php echo $dt_table; ?>">

                    <?php 

                      $sor_slider = $db->prepare("SELECT * FROM $dt_table WHERE uid=:uid ORDER BY sra DESC");
                      $sor_slider->bindValue(":uid",$uid);
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
             <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      <span class="text">

                         <img src="<?php echo $file_read_path.$value["resim"]; ?>" width="150">

                      
                      </span>
                     
                      <div class="tools">
                        <i class="fa fa-trash-o" onclick="dosya_sil('<?php echo $value["id"]; ?>','info_field_pop')"></i>
                      </div>
                  
                    </li>
        <?php } } ?>
  </ul>

         <!-- <button class="btn btn-default btn-block daha_fazla" onclick="daha_fazla_goster('list_comp')">Daha Fazla Göster</button>       -->
              
                </div><!-- /.box-body -->
               <!-- <div class="box-footer clearfix no-border">
                  <button class="btn btn-default pull-right"  onclick="scroll_slow_slider('ana_slider_ekle','list_slayt','a_slider_ekle')"><i class="fa fa-plus"></i> Referans Ekle</button>
                </div>-->
              </div><!-- /.box -->



              </section>
            
              <script type="text/javascript" src="piston/js/global_kont.js"></script>
              <script type="text/javascript">
                var glob_page_uri = "<?php echo $page_uri; ?>";
              </script>
              <script type="text/javascript" src="piston/page_js/<?php echo $page_uri.".js"; ?>"></script>

              </div>