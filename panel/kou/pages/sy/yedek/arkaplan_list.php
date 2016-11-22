  <section class="content-header">
          <h1>
            Sayfa
            <small>Sayfa Listesi</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-files-o"></i>Sayfa</a></li>
            <li class="active">Arkaplan Listesi</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content" id="ppassd">

          <!-- Default box -->
          <div class="box" id="grup_list_slider">
            <div class="box-header with-border">
              <h3 class="box-title">Sayfa</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body" id="galeri_grub_id">
                  <ul class="todo-list list_comp_2" post_uri='arkaplan_grup'>



                    <?php 

                      $sor_grup = $db->prepare("SELECT * FROM sayfa ORDER BY sira DESC");
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
                      <span class="text"><g id='grup_name' class="grub_name" onclick="list_goruntule('<?php echo $value["id"]; ?>')"><?php echo $value["sayfa_adi"]; ?></g></span>
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
                        <i class="fa fa-trash-o" onclick="galeri_grup_sil('<?php echo $value["id"]; ?>','arkaplan_list','info_field_2','galeri_grub_ekle')"></i>
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
                <form role="form" id="galeri_grub_form" method="post" enctype="multipart/form-data" onsubmit="return galeri_grup_ekle('arkaplan_list','galeri_grub_form','info_field_2','galeri_grub_ekle');">
                      <input type="hidden" name="tip" value="1">
                      <input type="hidden" name="sid" value="0">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Sayfa</label>
                      <input type="text" name="baslik" class="form-control" id="exampleInputEmail1" placeholder="Sayfa" required="">
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

  <!-- TO DO List -->
  <div class="full_galeri_list">
              <div class="box box-primary" id="list_slayt">
                <div class="box-header">
                  <i class="fa fa-files-o"></i>
                  <h3 class="box-title">Arkaplan Listesi</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
             <ul class="todo-list list_comp" post_uri='arkaplan'>

                    <?php 

                      $sor_slider = $db->prepare("SELECT * FROM arkaplan ORDER BY sira DESC");
                      $sor_slider->execute();

                      if($sor_slider->rowCount() == 0){
                    ?>

                 <div class="callout callout-info">
                    <h4>Listede hiç resim bulunamadı</h4>
                    <p>Lütfen resim ekleyin</p>
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
                      <span class="text"><a href="#">
                      <img width="80" height="80" class="ark_plan" m_id='<?php echo $value["id"]; ?>' src="<?php echo $file_read_path.$value["resim"]; ?>"></a> 
                      <img class="pro_hid" style="display:none;" m_id='<?php echo $value["id"]; ?>' src="<?php echo $file_read_path.$value["profil"]; ?>">
                      <k type="tr" m_id='<?php echo $value["id"]; ?>'><?php echo $value["title_tr"]; ?></k>
                      <k type="en" style="display:none;" m_id='<?php echo $value["id"]; ?>'><?php echo $value["name"]; ?></k>
                      <k type="gr" style="display:none;" m_id='<?php echo $value["id"]; ?>'><?php echo $value["title_gr"]; ?></k>
                      <k type="hu" style="display:none;" m_id='<?php echo $value["id"]; ?>'><?php echo $value["title_hu"]; ?></k>
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
                        <i class="fa fa-trash-o" onclick="slider_sil('<?php echo $value["id"]; ?>','galeri','info_field','a_slider_ekle')"></i>
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
                <!-- form start -->
                <form role="form" id="a_slider_ekle" method="post" enctype="multipart/form-data" onsubmit="return arkaplan_ekle('ark_planekle','a_slider_ekle','info_field','ana_slider_ekle');">
                      <input type="hidden" name="tip" value="1">
                      <input type="hidden" name="sid" value="0">
                  <div class="box-body">
                   <div class="form-group">
                      <label for="exampleInputEmail1">Açıklama</label>
                      <input type="text" name="title_tr" class="form-control" id="exampleInputEmail1" placeholder="Açıklama" required="">
                    </div> 
                    <div class="form-group">
                      <label for="exampleInputEmail1">İsim</label>
                      <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="İsim">
                    </div> 
                    <!--
                     

                     <div class="form-group">
                      <label for="exampleInputEmail1">Title Gr</label>
                      <input type="text" name="title_gr" class="form-control" id="exampleInputEmail1" placeholder="Title">
                    </div> 
                     <div class="form-group">
                      <label for="exampleInputEmail1">Title Hu</label>
                      <input type="text" name="title_hu" class="form-control" id="exampleInputEmail1" placeholder="Title">
                    </div>-->
                    <div class="form-group">
                      <label for="exampleInputFile">Profil Resim</label>
                      <input type="file" name="profil_resim" id="exampleInputFile" required="">
                      <p class="help-block">Profil resimleri için lütfen 400x260 olan bir resim seçin</p>
                      <img width="150" height="100" src="" style="display:none;" alt="" class="margin profil">
                    </div> 
                    <div class="form-group">
                      <label for="exampleInputFile">Arkaplan</label>
                      <input type="file" name="slider_resim" id="exampleInputFile" required="">
                      <p class="help-block">Arkaplan için lütfen boyutları 1920x500 olan bir resim seçin</p>
                      <img width="150" height="100" src="" style="display:none;" alt="" class="margin arkaplan">
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                   <button class="btn btn-danger">Ekle</button>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
</div>
              </section>