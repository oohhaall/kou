
        <section class="content-header">
          <h1>
            Yapı Gereçleri
            <small>Yapı Gereçleri Listesi</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-files-o"></i>Yapı Gereçleri</a></li>
            <li class="active">Yapı Gereçleri Listesi</li>
          </ol>
        </section>
 <section class="content">
  <!-- TO DO List -->
              <div class="box box-primary" id="list_slayt">
                <div class="box-header">
                  <i class="fa fa-files-o"></i>
                  <h3 class="box-title">Yapı Gereçleri Listesi</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
 <ul class="todo-list list_comp" post_uri="yapi_gerecleri_list" dt_table="yapigerecleri" goster_num="10">

                    <?php 

                      $sor_slider = $db->prepare("SELECT * FROM yapigerecleri ORDER BY sra DESC LIMIT 0,10");
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
                         <?php echo ($value["resim"]!="")?'<img width="80" height="80" m_id="'.$value["id"].'" src="'.$file_read_path.$value["resim"].'">':NULL; ?>
                          </a> 
                            <?php
                                foreach ($dil_text as $dil_key => $dil_val) {
                                    $style = ($dil_key=="tr")?"style='display:inline-block;'":"style='display:none;'";
                                  ?>
                                  

                                  <g id='grup_name' class="grub_name" onclick="alt_list_goruntule('<?php echo $value["id"]; ?>')" type="<?php echo $dil_key; ?>" m_id='<?php echo $value["id"]; ?>' <?php echo $style; ?>><?php echo $value["urunAdi_".$dil_key]; ?></g>


                                
                                  <?php
                                }
                            ?>

                             <?php
                                foreach ($dil_text as $dil_key => $dil_val) {
                                    $style = "style='display:none;'";
                                  ?>
                                  <k type="<?php echo $dil_key; ?>" m_id='<?php echo $value["id"]; ?>' <?php echo $style; ?>><?php echo (!empty($value["katalog_".$dil_key]))?$katalog_path_read.$value["katalog_".$dil_key]:NULL; ?></k>
                                  <?php
                                }
                            ?>

                           
                              <?php
                                foreach ($dil_text as $dil_key => $dil_val) {
                                    $style = "style='display:none;'";
                                  ?>
                                  <kt type="<?php echo $dil_key; ?>" m_id='<?php echo $value["id"]; ?>' <?php echo $style; ?>><?php echo (!empty($value["katalogResim_".$dil_key]))?$file_read_path.$value["katalogResim_".$dil_key]:NULL; ?></kt>
                                  <?php
                                }
                            ?>
                             
                            <?php
                                foreach ($dil_text as $dil_key => $dil_val) {
                                    $style = "style='display:none;'";
                                  ?>
                                  <ac type="<?php echo $dil_key; ?>" m_id='<?php echo $value["id"]; ?>' <?php echo $style; ?>><?php echo $value["aciklama_".$dil_key]; ?></ac>
                                  <?php
                                }
                            ?>
                            <l m_id='<?php echo $value["id"]; ?>' style="display: none"><?php echo $file_read_path.$value["logo"]; ?></l>
                            <u m_id='<?php echo $value["id"]; ?>' style="display: none"><?php echo $file_read_path.$value["resim"]; ?></u>



                      </span>
                      <!-- Emphasis label -->
                      <small class="label label-danger"><i class="fa fa-clock-o"></i><?php echo $value["tarih"]; ?></small>
                      <!-- General tools such as edit or delete-->
                          <div class="list_active_control">
                      <div class="slider-track <?php echo ($value["drm"]==1)?"acik_on":NULL; ?>" onclick='gunc_durum("<?php echo $value["id"]; ?>")' item_id="<?php echo $value["id"]; ?>" post_type="ana_slider" dt_table="yapigerecleri">
                          <div class="slider-handle"></div>
                        </div>
                        </div>
                      <div class="tools">
                        <i class="fa fa-edit" onclick="slider_duzenle('ana_slider_ekle','<?php echo $value["id"]; ?>','list_slayt','a_slider_ekle')"></i>
                        <i class="fa fa-trash-o" onclick="slider_sil('ana_slider_ekle','<?php echo $value["id"]; ?>','list_slayt','a_slider_ekle','info_field')"></i>
                      </div>
                  
                    </li>
        <?php } } ?>
  </ul>

          <button class="btn btn-default btn-block daha_fazla" onclick="daha_fazla_goster('list_comp')">Daha Fazla Göster</button>       
              
                </div><!-- /.box-body -->
                <div class="box-footer clearfix no-border">
                  <button class="btn btn-default pull-right"  onclick="scroll_slow_slider('ana_slider_ekle','list_slayt','a_slider_ekle')"><i class="fa fa-plus"></i> Yapı Gereçleri Ekle</button>
                </div>
              </div><!-- /.box -->

 <div id="info_field">
   


 </div>

              <div class="ekle_slayt" id="ana_slider_ekle">
                <div class="box box-primary" style="display: none;">
                <div class="box-header with-border">
                  <h3 class="box-title">Yapı Gereçleri Ekle</h3>
                    <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" id="a_slider_ekle" method="post" enctype="multipart/form-data" onsubmit="return form_submit('ana_slider_ekle','a_slider_ekle','info_field','ana_slider_ekle');">
                      <input type="hidden" name="tip" value="1">
                      <input type="hidden" name="sid" value="0">
                  <div class="box-body">
                   <!-- <div class="form-group">
                      <label for="exampleInputEmail1">Başlık</label>
                      <input type="text" name="baslik" class="form-control" id="exampleInputEmail1" placeholder="Başlık" required="">
                    </div>-->


                              <div class="form-group">
                      <label for="exampleInputEmail1">Ürün Adı</label>

            <div class="row">
            <div class="col-md-12">
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <?php 
                       foreach ($dil_text as $dil_key => $dil_val) {
                          $class = ($dil_key=="tr")?"active":NULL;  ?>
                            <li class="<?php echo $class; ?>"><a href="#urunAdi_<?php echo $dil_key; ?>" data-toggle="tab"><?php echo $dil_val; ?></a></li>
                          <?php } ?>
                </ul>
                <div class="tab-content">
                     <?php 
                       foreach ($dil_text as $dil_key => $dil_val) {
                          $class = ($dil_key=="tr")?"active":NULL;  ?>
                             <div class="tab-pane <?php echo $class; ?>" id="urunAdi_<?php echo $dil_key; ?>">
                                 <input type="text" name="urunadi_<?php echo $dil_key; ?>" class="form-control" id="exampleInputEmail1" placeholder="<?php echo $dil_val; ?>">
                                
                         
                             </div><!-- /.tab-pane -->
                     <?php } ?>
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
            </div><!-- /.col -->
          </div> <!-- /.row -->
        </div>


                    <div class="form-group">
                          <label for="exampleInputFile" style="display: block;">Ürün Resim</label>
                          <img style="display: none" src="" width="150" class="ur_bi">
                          <button type="button" class="img-del urn_res_del"><i class="fa fa-remove"></i></button>
                          <input type="file" name="resim" id="exampleInputFile" placeholder="">
                          <p class="help-block">Ürün resmi için lütfen boyutları 243x55 olan bir resim seçin</p>
                    </div>


                    <div class="form-group">
                          <label for="exampleInputFile2" style="display: block;">Ürün Logo</label>
                          <img style="display: none" src="" width="150" class="ur_lo">
                          <button type="button" class="img-del urun_logo_del"><i class="fa fa-remove"></i></button>
                          <input type="file" name="logo" id="exampleInputFile2" placeholder="">
                          <p class="help-block">Ürün logosu için lütfen boyutları 320x77 olan bir resim seçin</p>
                    </div>




      <div class="form-group">
            <label for="exampleInputEmail3">Katalog</label>
            <div class="row">
            <div class="col-md-12">
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <?php 
                       foreach ($dil_text as $dil_key => $dil_val) {
                          $class = ($dil_key=="tr")?"active":NULL;  ?>
                            <li class="<?php echo $class; ?>"><a href="#katalog_<?php echo $dil_key; ?>" data-toggle="tab"><?php echo $dil_val; ?></a></li>
                          <?php } ?>
                </ul>
                <div class="tab-content">
                     <?php 
                       foreach ($dil_text as $dil_key => $dil_val) {
                          $class = ($dil_key=="tr")?"active":NULL;  ?>
                             <div class="tab-pane <?php echo $class; ?>" id="katalog_<?php echo $dil_key; ?>">
                              <a href="#" class="kta_<?php echo $dil_key; ?>" style="display: none;" target="_blank"><img src="../images/pdf.png"> Katalog İndir</a>
                                <button type="button" class="img-del <?php echo "pdf_del_".$dil_key; ?>"><i class="fa fa-remove"></i></button>
                                <input type="file" name="katalog_<?php echo $dil_key; ?>" id="exampleInputEmail3">
                                <p class="help-block">Lütfen Katalog İçin PDF Dosyası Yükleyiniz</p>
                             </div><!-- /.tab-pane -->
                     <?php } ?>
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
            </div><!-- /.col -->
          </div> <!-- /.row -->
        </div>






          <div class="form-group">
            <label for="exampleInputEmail14">Katalog Görsel</label>

            <div class="row">
            <div class="col-md-12">
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <?php 
                       foreach ($dil_text as $dil_key => $dil_val) {
                          $class = ($dil_key=="tr")?"active":NULL;  ?>
                            <li class="<?php echo $class; ?>"><a href="#katalog_gorsel_<?php echo $dil_key; ?>" data-toggle="tab"><?php echo $dil_val; ?></a></li>
                          <?php } ?>
                </ul>
                <div class="tab-content">
                     <?php 
                       foreach ($dil_text as $dil_key => $dil_val) {
                          $class = ($dil_key=="tr")?"active":NULL;  ?>
                             <div class="tab-pane <?php echo $class; ?>" id="katalog_gorsel_<?php echo $dil_key; ?>">
                              <img src="" name="on_<?php echo $dil_key; ?>" width="150">
                              <button type="button" class="img-del <?php echo "img_del_".$dil_key; ?>"><i class="fa fa-remove"></i></button>
                                <input type="file" name="katalog_gorsel_<?php echo $dil_key; ?>" id="exampleInputEmail14">
                                <p class="help-block">Katalog Görseli İçin Genişliği 363px Olan Bir Resim Seçiniz</p>
                             </div><!-- /.tab-pane -->
                     <?php } ?>
                </div><!-- /.tab-content -->

              </div><!-- nav-tabs-custom -->
            </div><!-- /.col -->
          </div> <!-- /.row -->
        </div>


 <div class="form-group">
            <label for="exampleInputEmail1">Ürün Açıklama</label>

            <div class="row">
            <div class="col-md-12">
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <?php 
                       foreach ($dil_text as $dil_key => $dil_val) {
                        //id="ck_editor_<?php echo $dil_key; 
                          $class = ($dil_key=="tr")?"active":NULL;  
                          ?>
                            <li class="<?php echo $class; ?>"><a href="#aciklama_<?php echo $dil_key; ?>" data-toggle="tab"><?php echo $dil_val; ?></a></li>
                          <?php } ?>
                </ul>
                <div class="tab-content">
                     <?php 
                       foreach ($dil_text as $dil_key => $dil_val) {
                          $class = ($dil_key=="tr")?"active":NULL;  ?>
                             <div class="tab-pane <?php echo $class; ?>" id="aciklama_<?php echo $dil_key; ?>">
                               <textarea placeholder="İçerik"  name="aciklama_<?php echo $dil_key; ?>" rows="3" class="form-control ck_edit"></textarea>
                             </div><!-- /.tab-pane -->
                     <?php } ?>
                </div><!-- /.tab-content -->

              </div><!-- nav-tabs-custom -->
            </div><!-- /.col -->
          </div> <!-- /.row -->
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
              <div class="box box-primary" id="list_slayt" style="display: none;">
                <div class="box-header">
                  <i class="fa fa-files-o"></i>
                  <h3 class="box-title"></h3>
                  <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Küçült"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Kapat"><i class="fa fa-times"></i></button>
              </div>
                </div><!-- /.box-header -->
                <div class="box-body">


                           <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <?php 
                       foreach ($dil_text as $dil_key => $dil_val) {
                          $class = ($dil_key=="tr")?"active":NULL;  ?>
                            <li class="<?php echo $class; ?>"><a href="#list_page_<?php echo $dil_key; ?>" onclick="lang_change('<?php echo $dil_key; ?>')" data-toggle="tab"><?php echo $dil_val; ?></a></li>
                          <?php } ?>
                </ul>
                <div class="tab-content">
                     <?php 
                       foreach ($dil_text as $dil_key => $dil_val) {
                          $class = ($dil_key=="tr")?"active":NULL;  ?>
                             <div class="tab-pane <?php echo $class; ?>" id="list_page_<?php echo $dil_key; ?>">

             <ul class="todo-list alt_grup_list_<?php echo $dil_key; ?>" post_uri='alt_kategori_list' dil="<?php echo $dil_key; ?>" grup_id="">

                                
<?php

                       $st = 0;
                      if($st == 0){
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
                 ?>

<?php
              } 
                                


?>
            </ul>

                         
                             </div><!-- /.tab-pane -->
                     <?php } ?>
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->




           
                 
               
                </div><!-- /.box-body -->
                <div class="box-footer clearfix no-border">
                  <button class="btn btn-default pull-right"  onclick="alt_slider('alt_kt')"><i class="fa fa-plus"></i> Resim Ekle</button>
                </div>
              </div><!-- /.box -->

           <div id="info_field2">
             


           </div>

              <div class="ekle_slayt">
                <div class="box box-primary" style="display: none;">
                <div class="box-header with-border">
                  <h3 class="box-title">Resim Ekle</h3>
                    <div class="box-tools pull-right">
                <button class="btn btn-box-tool"  data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
                </div><!-- /.box-header -->

               <form role="form" id="alt_kt" method="post" enctype="multipart/form-data" onsubmit="return alt_icerik_ekle('alt_kt','info_field2');">
                      <input type="hidden" name="grup_id" value="0">
                      <input type="hidden" name="sid" value="0">
                      <input type="hidden" name="alt_sld_dil" value="tr">
                  <div class="box-body">
              

                       <!-- Custom Tabs -->

                    <div class="form-group">
                      <label for="exampleInputEmail1">Resim</label>
                      <input type="file" name="resim" id="exampleInputFile" required="">
                      <img src="" style="display:none;" class="on_img" width="150" height="150">
                   <!--   <button type="button" onclick="" class="img-del"><i class="fa fa-remove"></i></button> -->

                      <p class="help-block">İçerik için lütfen boyutları  940 x 450 olan bir resim seçin</p>

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