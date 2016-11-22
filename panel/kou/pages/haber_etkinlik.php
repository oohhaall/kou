<?php 

    $dt_table = "duyurular";
    $up_page = "haber_duyuru";
?>
        <section class="content-header">
          <h1>
            Haber ve Etkinlikler
            <small>İçerik Listesi</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-files-o"></i>Haber ve Etkinlikler</a></li>
            <li class="active">İçerik Listesi</li>
          </ol>
        </section>
 <section class="content">
  <!-- TO DO List -->
              <div class="box box-primary" id="list_slider">
                <div class="box-header">
                  <i class="fa fa-files-o"></i>
                  <h3 class="box-title">Duyuru Listesi</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
 <ul class="todo-list up_list_comp" post_uri="<?php echo $up_page; ?>" dt_table="<?php echo $dt_table; ?>" goster_num="20">

                    <?php 

                      $sor_slider = $db->prepare("SELECT * FROM $dt_table WHERE type='3' ORDER BY tarih DESC LIMIT 0,20");
                      $sor_slider->execute();

                      if($sor_slider->rowCount() == 0){
                    ?>

                 <div class="callout callout-info">
                    <h4>Listede hiç duyuru bulunamadı</h4>
                    <p>Lütfen duyuru ekleyin</p>
                  </div>
<?php }else{  ?>
<?php
  foreach ($sor_slider->fetchAll() as $key => $value) {
?>

                   <li id="<?php echo "list_update_".$value["id"]; ?>" sira='<?php echo $value["sira"]; ?>' m_id='<?php echo $value["id"]; ?>'>
                      <!-- drag handle -->
                      <!--<span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>-->
                      <!-- checkbox -->
                     <!-- <input type="checkbox" value="" name=""> -->
                      <!-- todo text -->
                      <span class="text">
                         

                            <bilgi>
                            <?php
                                foreach ($dil_text as $dil_key => $dil_val) {
                                    $style = ($dil_key=="tr")?"style='display:inline-block;'":"style='display:none;'";
                                  ?>
                                  <g type="<?php echo $dil_key; ?>" m_id='<?php echo $value["id"]; ?>' <?php echo $style; ?>><?php echo $value["baslik_".$dil_key]; ?></g>
                                  <aciklama type="<?php echo $dil_key; ?>" m_id='<?php echo $value["id"]; ?>' style='display: none;'><?php echo $value["aciklama_".$dil_key]; ?></aciklama>
                                  <ek type="<?php echo $dil_key; ?>" m_id='<?php echo $value["id"]; ?>' style='display: none;'><?php echo $value["ek_".$dil_key]; ?></ek>
                                  <?php
                                }
                            ?>
                                  <t m_id='<?php echo $value["id"]; ?>' style='display: none;'><?php echo date("d/m/Y",strtotime($value["tarih"])); ?></t>
                                  <yazar m_id='<?php echo $value["id"]; ?>' style='display: none;'><?php echo $value["yazar"]; ?></yazar>

                             </bilgi>
                           

                            


                      </span>
                      <!-- Emphasis label -->
                      <small class="label label-danger"><i class="fa fa-clock-o"></i><?php echo date("d.m.Y",strtotime($value["tarih"])); ?></small>
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
  </ul>

          <button class="btn btn-default btn-block daha_fazla" onclick="daha_fazla_goster('up_list_comp')">Daha Fazla Göster</button>       
              
                </div><!-- /.box-body -->
                <div class="box-footer clearfix no-border">
                  <button class="btn btn-default pull-right"  onclick="scroll_slow_slider('ana_slider_ekle','list_slider','a_slider_ekle')"><i class="fa fa-plus"></i> Duyuru Ekle</button>
                </div>
              </div><!-- /.box -->

 <div id="info_field">
   


 </div>

              <div class="ekle_slider" id="ana_slider_ekle">
                <div class="box box-primary" style="display: none;">
                <div class="box-header with-border">
                  <h3 class="box-title">Duyuru Ekle</h3>
                    <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" id="a_slider_ekle" method="post" enctype="multipart/form-data" onsubmit="return slider_ekle('ana_slider_ekle','a_slider_ekle','info_field','ana_slider_ekle');">
                      <input type="hidden" name="tip" value="1">
                      <input type="hidden" name="sid" value="0">
                  <div class="box-body">
                   <!-- <div class="form-group">
                      <label for="exampleInputEmail1">Başlık</label>
                      <input type="text" name="baslik" class="form-control" id="exampleInputEmail1" placeholder="Başlık" required="">
                    </div>-->

 <div class="form-group">
                      <label for="exampleInputEmail1">Ek</label>

            <div class="row">
            <div class="col-md-12">
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <?php 
                       foreach ($dil_text as $dil_key => $dil_val) {
                          $class = ($dil_key=="tr")?"active":NULL;  ?>
                            <li class="<?php echo $class; ?>"><a href="#slider_resim_<?php echo $dil_key; ?>" data-toggle="tab"><?php echo $dil_val; ?></a></li>
                          <?php } ?>
                </ul>
                <div class="tab-content">
                     <?php 
                       foreach ($dil_text as $dil_key => $dil_val) {
                          $class = ($dil_key=="tr")?"active":NULL;  ?>
                             <div class="tab-pane <?php echo $class; ?>" id="slider_resim_<?php echo $dil_key; ?>">
                              <img src="" name="on_<?php echo $dil_key; ?>" width="150">
                              <button type="button" onclick="" class="img-del <?php echo "img_del_".$dil_key; ?>"><i class="fa fa-remove"></i></button>
                                <input type="file" name="slider_resim_<?php echo $dil_key; ?>" id="exampleInputFile">
                                <!--<p class="help-block">Slider için lütfen boyutları 1400x648 olan bir resim seçin</p>-->
                             </div><!-- /.tab-pane -->
                     <?php } ?>
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
            </div><!-- /.col -->
          </div> <!-- /.row -->
</div>


 <div class="form-group">
                      <label for="exampleInputEmail1">Başlık</label>

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
                      <label for="trhss">Tarih</label>
                        <div class="input-group">
                      <div class="input-group-addon tarih_goster" onclick="open_picker()">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" value="<?php echo date("d/m/Y"); ?>" disabled="disabled" name="tarih" id="reservation">
                    </div><!-- /.input group-->
                  

                  
                    </div>
 <div class="form-group">
                      <label for="exampleInputEmail1">Açıklama</label>

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
                                 <textarea name="aciklama_<?php echo $dil_key; ?>" class="aciklama_ck"></textarea>
                                
                         
                             </div><!-- /.tab-pane -->
                     <?php } ?>
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
            </div><!-- /.col -->
          </div> <!-- /.row -->
</div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Yazar</label>
                       
                  
                      <input type="text" name="yazar" class="form-control" id="exampleInputEmail1" placeholder="Yazar">

                  
                    </div>
                

                  </div><!-- /.box-body -->




                  <div class="box-footer">
                   <button class="btn btn-danger">Ekle</button>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </section>



