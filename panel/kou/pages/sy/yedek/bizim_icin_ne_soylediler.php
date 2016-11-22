
        <section class="content-header">
          <h1>
            Bizim için ne söylediler
            <small>İçerik Listesi</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-files-o"></i>Bizim için ne söylediler</a></li>
            <li class="active">İçerik Listesi</li>
          </ol>
        </section>
 <section class="content">
  <!-- TO DO List -->
              <div class="box box-primary" id="list_slayt">
                <div class="box-header">
                  <i class="fa fa-files-o"></i>
                  <h3 class="box-title">İçerik Listesi</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
 <ul class="todo-list list_comp" post_uri='bizim_icin_ne_soylediler'>

                    <?php 

                      $sor_slider = $db->prepare("SELECT * FROM bizim_icin_ne_soylediler ORDER BY sira DESC");
                      $sor_slider->execute();

                      if($sor_slider->rowCount() == 0){
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
        <?php } } ?>
  </ul>
                 
              
                </div><!-- /.box-body -->
                <div class="box-footer clearfix no-border">
                  <button class="btn btn-default pull-right"  onclick="scroll_slow('ana_slider_ekle','list_slayt','a_slider_ekle')"><i class="fa fa-plus"></i> İçerik Ekle</button>
                </div>
              </div><!-- /.box -->

 <div id="info_field">
   


 </div>

              <div class="ekle_slayt" id="ana_slider_ekle">
                <div class="box box-primary" style="display: none;">
                <div class="box-header with-border">
                  <h3 class="box-title">İçerik Ekle</h3>
                    <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" id="a_slider_ekle" method="post" enctype="multipart/form-data" onsubmit="return bizim_icin_ne_soylediler('bizim_icin_ne_soylediler','a_slider_ekle','info_field','ana_slider_ekle');">
                      <input type="hidden" name="tip" value="2">
                      <input type="hidden" name="sid" value="0">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">İsim</label>
                      <textarea placeholder="İsim" id="ck_baslik" name="baslik" rows="3" class="form-control" required=""></textarea>
                    </div>


                    <div class="form-group">
                      <label>İçerik</label>
                      <textarea placeholder="İçerik" id="ck_icerik" name="icerik" rows="3" class="form-control" required=""></textarea>
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                   <button class="btn btn-danger">Ekle</button>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </section>



