  <section class="content-header">
          <h1>
            Sayfa
            <small>İşveren Markasi gelişimi İçerik Listesi</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-files-o"></i>Sayfa</a></li>
            <li class="active">İşveren Markasi gelişimi</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content" id="ppassd">

          <!-- Default box -->
          <div class="box" id="grup_list_slider">
            <div class="box-header with-border">
              <h3 class="box-title">Başlık</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body" id="galeri_grub_id">
                  <ul class="todo-list list_comp_2" post_uri='isveren_markasi'>



                    <?php 

                      $sor_grup = $db->prepare("SELECT * FROM isveren_markasi WHERE tur=1 ORDER BY sira DESC");
                      $sor_grup->execute();

                      if($sor_grup->rowCount() == 0){
                    ?>

                        <div class="callout callout-info">
                          <h4>Listede hiç sayfa bulunamadı</h4>
                          <p>Lütfen önce sayfa ekleyin</p>
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
                      <!-- Emphasis label -->
                      <small class="label label-default"><i class="fa fa-clock-o"></i><?php echo $value["tarih"]; ?></small>
                      <div style="display:none;" class="ic_bilg" m_id='<?php echo $value["id"]; ?>'><?php echo $value["icerik"]; ?></div>

                      <!-- General tools such as edit or delete-->
                        <div class="list_active_control">
                        <div class="slider-track <?php echo ($value["durum"]==1)?"acik_on":NULL; ?>" onclick='gunc_durum("<?php echo $value["id"]; ?>")' item_id="<?php echo $value["id"]; ?>" post_type="isveren_markasi">
                        <img src="<?php echo $file_read_path.$value["resim"]; ?>" style="display:none;" m_id="<?php echo $value["id"]; ?>">
                          <div class="slider-handle"></div>
                        </div>
                        </div>
                      <div class="tools">
                        <i class="fa fa-edit" onclick="galeri_grup_duzenle('galeri_grub_form','<?php echo $value["id"]; ?>','galeri_grup')"></i>
                        <i class="fa fa-trash-o" onclick="galeri_grup_sil_ana('<?php echo $value["id"]; ?>','isveren_markasi','info_field_2','galeri_grub_form')"></i>
                      </div>
                    </li>
                    <?php } } ?>
                  </ul>
                </div><!-- /.box-body -->

                <div class="box-footer clearfix no-border">
                  <button class="btn btn-default pull-right" onclick="scroll_slow('galeri_grub_ekle','galeri_grub_id','galeri_grub_form')"><i class="fa fa-plus"></i> Sayfa Ekle</button>
                </div>

          </div><!-- /.box -->

           <div id="info_field_2">
             


           </div>

              <div class="ekle_slayt" id="galeri_grub_ekle">
                <div class="box box-primary" style="display: none;">
                <div class="box-header with-border">
                  <h3 class="box-title">Sayfa Ekle</h3>
                    <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" id="galeri_grub_form" method="post" enctype="multipart/form-data" onsubmit="return galeri_grup_ekle('isveren_markasi','galeri_grub_form','info_field_2','galeri_grub_ekle');">
                      <input type="hidden" name="tip" value="0">
                      <input type="hidden" name="sid" value="0">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Başlık</label>
                      <input type="text" name="baslik" class="form-control" id="exampleInputEmail1" placeholder="Başlık" required="">
                    </div>
                     <div class="form-group">
                      <label for="exampleInputEmail1">Resim</label>
                      <input type="file" name="resim" id="exampleInputFile" required="">
                      <p class="help-block">İçerik için lütfen boyutları  700 x 280 olan bir resim seçin</p>
                      <img src="" width="150" height="150" style="display:none;">
                      <button type="button" onclick="" class="img-del"><i class="fa fa-remove"></i></button>
                    </div>
                     <div class="form-group">
                      <label for="exampleInputEmail1">İçerik</label>
                      <textarea placeholder="İçerik" id="ck_editor_test" name="icerik" rows="3" class="form-control" required=""></textarea>
                      <p class="help-block">Başlıkları seçmeyi unutmayın</p>

                    </div>
      
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                   <button class="btn btn-danger">Ekle</button>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>

  <!-- TO DO List -->
  <div class="full_galeri_list">
              <div class="box box-primary" id="list_slayt">
                <div class="box-header">
                  <i class="fa fa-files-o"></i>
                  <h3 class="box-title">Alt Kategori Listesi</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
             <ul class="todo-list list_comp fiinns_c" post_uri='alt_kategori_list' g__id="">

                    <?php 

                      $sor_slider = $db->prepare("SELECT * FROM finans WHERE tur=2 ORDER BY sira DESC");
                      $sor_slider->execute();

                      if($sor_slider->rowCount() == 0){
                    ?>

                 <div class="callout callout-info">
                    <h4>Listede alt kategori bulunamadı</h4>
                    <p>Lütfen alt kategori ekleyin</p>
                  </div>
              <?php }else{  ?>
              <?php
                foreach ($sor_slider->fetchAll() as $key => $value) {
              ?>

                   <li id="<?php echo "list_update_".$value["id"]; ?>" ust_kt='<?php echo $value["ust_kt"]; ?>' sira='<?php echo $value["sira"]; ?>' m_id='<?php echo $value["id"]; ?>'>
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
                      <img width="80" height="80" m_id='<?php echo $value["id"]; ?>' src="<?php echo $file_read_path.$value["resim"]; ?>"></a> 
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
                        <i class="fa fa-edit" onclick="alt_kt_duz('a_slider_ekle','<?php echo $value["id"]; ?>','isveren_markasi')"></i>
                        <i class="fa fa-trash-o" onclick="slider_sil('<?php echo $value["id"]; ?>','isveren_markasi','info_field','a_slider_ekle')"></i>
                      </div>
                    </li>
                <?php } } ?>
            </ul>
                 
               
                </div><!-- /.box-body -->
                <div class="box-footer clearfix no-border">
                  <button class="btn btn-default pull-right"  onclick="scroll_slow('ana_slider_ekle','ppassd','a_slider_ekle')"><i class="fa fa-plus"></i> Resim Ekle</button>
                </div>
              </div><!-- /.box -->

           <div id="info_field">
             


           </div>

              <div class="ekle_slayt" id="ana_slider_ekle">
                <div class="box box-primary" style="display: none;">
                <div class="box-header with-border">
                  <h3 class="box-title">Resim Ekle</h3>
                    <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
                </div><!-- /.box-header -->
                <!-- form start 
                <form role="form" id="a_slider_ekle" method="post" enctype="multipart/form-data" onsubmit="return arkaplan_ekle('ark_planekle','a_slider_ekle','info_field','ana_slider_ekle');">
-->

               <form role="form" id="alt_kt" method="post" enctype="multipart/form-data" onsubmit="return galeri_grup_ekle_alt('isveren_markasi','alt_kt','info_field_2','ana_slider_ekle');">
                      <input type="hidden" name="tip" value="1">
                      <input type="hidden" name="sid" value="1">
                      <input type="hidden" name="alt_kt" value="1">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Sayfa</label>
                      <input type="text" name="baslik" class="form-control" id="exampleInputEmail1" placeholder="Sayfa" required="">
                    </div>
                     <div class="form-group">
                      <label for="exampleInputEmail1">Resim</label>
                      <input type="file" name="resim" id="exampleInputFile">
                      <img src="" style="display:none;" width="150" height="150">
                      <button type="button" onclick="" class="img-del"><i class="fa fa-remove"></i></button>
                      <p class="help-block">İçerik için lütfen boyutları  700 x 280 olan bir resim seçin</p>

                    </div>
                     <div class="form-group">
                      <label for="exampleInputEmail1">İçerik</label>
                      <textarea placeholder="İçerik" id="ck_2" name="icerik" rows="3" class="form-control" required=""></textarea>
                      <p class="help-block">Seçmek istediğiniz Kelimleri seçip Başlık 3(Header 3) Özelliğini seçiniz</p>

                    </div>
                    <!--<div class="form-group">
                      <label for="exampleInputFile">File input</label>
                      <input type="file" name="slider_resim" id="exampleInputFile" required="">
                      <!--<p class="help-block">Ana Slider için lütfen boyutları 400x400 olan bir resim seçin</p>-->
                      <!-- <img width="150" height="100" src="" style="display:none;" alt="" class="margin">
                    </div> -->
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                   <button class="btn btn-danger">Ekle</button>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
</div>
              </section>