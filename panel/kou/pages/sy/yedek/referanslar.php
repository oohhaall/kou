
        <section class="content-header">
          <h1>
            Referanslar
            <small>Referans Listesi</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-files-o"></i>Referans</a></li>
            <li class="active">Referans Listesi</li>
          </ol>
        </section>
 <section class="content">
  <!-- TO DO List -->
              <div class="box box-primary" id="list_slayt">
                <div class="box-header">
                  <i class="fa fa-files-o"></i>
                  <h3 class="box-title">Referans Listesi</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
 <ul class="todo-list list_comp" post_uri="referans">

                    <?php 

                      $sor_slider = $db->prepare("SELECT * FROM referanslar ORDER BY sira DESC");
                      $sor_slider->execute();

                      if($sor_slider->rowCount() == 0){
                    ?>

                 <div class="callout callout-info">
                    <h4>Listede hiç referans bulunamadı</h4>
                    <p>Lütfen referans ekleyin</p>
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

                      <k m_id='<?php echo $value["id"]; ?>' style="display:inline-block;"><?php echo $value["isim"]; ?></k>
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
        <?php } } ?>
  </ul>
                 
              
                </div><!-- /.box-body -->
                <div class="box-footer clearfix no-border">
                  <button class="btn btn-default pull-right"  onclick="scroll_slow('ana_slider_ekle','list_slayt','a_slider_ekle')"><i class="fa fa-plus"></i> Referans Ekle</button>
                </div>
              </div><!-- /.box -->

 <div id="info_field">
   


 </div>

              <div class="ekle_slayt" id="ana_slider_ekle">
                <div class="box box-primary" style="display: none;">
                <div class="box-header with-border">
                  <h3 class="box-title">Referans Ekle</h3>
                    <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" id="slider_ekles" method="post" enctype="multipart/form-data" onsubmit="return referans_ekle('referans','slider_ekles','info_field','ana_slider_ekle');">
                      <input type="hidden" name="tip" value="1">
                      <input type="hidden" name="sid" value="0">
                  <div class="box-body">
                   <!-- <div class="form-group">
                      <label for="exampleInputEmail1">Başlık</label>
                      <input type="text" name="baslik" class="form-control" id="exampleInputEmail1" placeholder="Başlık" required="">
                    </div>-->

                    <div class="form-group">
                      <label for="exampleInputEmail1">Başlık</label>
                    <textarea name="baslik" rows="3" class="form-control cksdsa" required=""></textarea>

                  
                    </div>
                   <!--  <div class="form-group">
                      <label for="exampleInputFile">File input</label>
                      <input type="file" name="dosya" id="exampleInputFile" required="">
                     <p class="help-block">Ana Slider için lütfen boyutları 400x400 olan bir resim seçin</p>
                      <img width="150" height="100" src="" style="display:none;" alt="" class="margin"> 
                    </div>-->
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                   <button class="btn btn-danger">Ekle</button>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </section>