
        <section class="content-header">
          <h1>
            Mimari Çözümler
            <small>Mimari Çözümler Listesi</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-files-o"></i>Mimari Çözümler</a></li>
            <li class="active">Mimari Çözümler Listesi</li>
          </ol>
        </section>
 <section class="content">
  <!-- TO DO List -->
              <div class="box box-primary" id="list_slayt">
                <div class="box-header">
                  <i class="fa fa-files-o"></i>
                  <h3 class="box-title">Mimari Çözümler Listesi</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
 <ul class="todo-list list_comp" post_uri="mimari_cozumler_list" dt_table="urunler" goster_num="10">

                    <?php 

                      $sor_slider = $db->prepare("SELECT * FROM urunler WHERE kid=0 ORDER BY sra DESC LIMIT 0,10");
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
                      <span class="text">
                          <a href="#">
                          <img type="" width="80" height="80" m_id='<?php echo $value["id"]; ?>' src="<?php echo ($value["resim"]!="")?$file_read_path.$value["resim"]:""; ?>">
                          </a> 
                            <?php
                                foreach ($dil_text as $dil_key => $dil_val) {
                                    $style = ($dil_key=="tr")?"style='display:inline-block;'":"style='display:none;'";
                                  ?>
                                  <g type="<?php echo $dil_key; ?>" m_id='<?php echo $value["id"]; ?>' <?php echo $style; ?>><?php echo $value["urunAdi_".$dil_key]; ?></g>
                                  <?php
                                }
                      
                                foreach ($dil_text as $dil_key => $dil_val) {
                                    $style = "style='display:none;'";
                                  ?>
                                  <i type="<?php echo $dil_key; ?>" m_id='<?php echo $value["id"]; ?>' <?php echo $style; ?>><?php echo $value["aciklama_".$dil_key]; ?></i>
                                  <?php
                                }
                            ?>
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
  </ul>

          <button class="btn btn-default btn-block daha_fazla" onclick="daha_fazla_goster('list_comp')">Daha Fazla Göster</button>       
              
                </div><!-- /.box-body -->
                <div class="box-footer clearfix no-border">
                  <button class="btn btn-default pull-right"  onclick="scroll_slow_slider('ana_slider_ekle','list_slayt','a_slider_ekle')"><i class="fa fa-plus"></i> Mimari Çözümler Ekle</button>
                </div>
              </div><!-- /.box -->
 <div id="info_field">

 </div>
              <div class="ekle_slayt" id="ana_slider_ekle">
                <div class="box box-primary" style="display: none;">
                <div class="box-header with-border">
                  <h3 class="box-title">Mimari Çözümler Ekle</h3>
                    <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" id="a_slider_ekle" method="post" enctype="multipart/form-data" onsubmit="return slider_ekle('ana_slider_ekle','a_slider_ekle','info_field','ana_slider_ekle');">
                      <input type="hidden" name="tip" value="1">
                      <input type="hidden" name="sid" value="0">
                  <div class="box-body">
                  
 <div class="form-group">
                      <label for="menu_arkaplan">Menü arkaplan resmi</label>

              <!-- Custom Tabs -->
                      <input type="file" name="arka_plan" id="menu_arkaplan">
                      <p class="help-block">Menü arkaplan resmi için 1660x146 ölçülerinde bir resim seçiniz</p>
                      <img width="150" height="100" src="" style="display:none;" alt="" class="margin">
</div>


 <div class="form-group">
                      <label for="m_site_urun_resmi">Mobil Site Ürün Resmi</label>

              <!-- Custom Tabs -->
                      <input type="file" name="mobil_resim" id="m_site_urun_resmi">
                      <p class="help-block">Mobil Site Ürün resmi için 150x110 ölçülerinde bir resim seçiniz</p>
                      <img width="150" height="100" src="" style="display:none;" alt="" class="margin">
</div>

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
                            <li class="<?php echo $class; ?>"><a href="#baslik_<?php echo $dil_key; ?>" data-toggle="tab"><?php echo $dil_val; ?></a></li>
                          <?php } ?>
                </ul>
                <div class="tab-content">
                     <?php 
                       foreach ($dil_text as $dil_key => $dil_val) {
                          $class = ($dil_key=="tr")?"active":NULL;  ?>
                             <div class="tab-pane <?php echo $class; ?>" id="baslik_<?php echo $dil_key; ?>">
                                 <input type="text" name="baslik_<?php echo $dil_key; ?>" class="form-control" id="exampleInputEmail1" placeholder="<?php echo $dil_val; ?>">
                             </div><!-- /.tab-pane -->
                     <?php } ?>
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
            </div><!-- /.col -->
          </div> <!-- /.row -->
</div>


 <div class="form-group">
                      <label for="m_site_urun_resmi">Kutu Palet</label>

              <!-- Custom Tabs -->
                      <input type="file" name="kutu_palet" id="m_site_urun_resmi">
                      <p class="help-block">Kutu palet için pdf,xlsx,xls,doc,docx,ppt,pptx formatın da bir dosya seçiniz</p>
                      <img width="150" height="100" src="" style="display:none;" alt="" class="margin">
</div>


 <div class="form-group">
                      <label for="m_site_urun_resmi">Aksesuarlar</label>

              <!-- Custom Tabs -->
                      <input type="file" name="aksesuar_doc" id="m_site_urun_resmi">
                      <p class="help-block">Aksesuar için pdf,xlsx,xls,doc,docx,ppt,pptx formatın da bir dosya seçiniz</p>
                      <img width="150" height="100" src="" style="display:none;" alt="" class="margin">
</div>


 <div class="form-group">
                      <label for="exampleInputEmail1">Detaylar</label>

            <div class="row">
            <div class="col-md-12">
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <?php 
                       foreach ($dil_text as $dil_key => $dil_val) {
                          $class = ($dil_key=="tr")?"active":NULL;  ?>
                            <li class="<?php echo $class; ?>"><a href="#aciklama_<?php echo $dil_key; ?>" data-toggle="tab"><?php echo $dil_val; ?></a></li>
                          <?php } ?>
                </ul>
                <div class="tab-content">
                     <?php 
                       foreach ($dil_text as $dil_key => $dil_val) {
                          $class = ($dil_key=="tr")?"active":NULL;  ?>
                             <div class="tab-pane <?php echo $class; ?>" id="aciklama_<?php echo $dil_key; ?>">
                                 <textarea class="detay_ck" name="aciklama_<?php echo $dil_key; ?>"></textarea>
                                
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
              </section>



