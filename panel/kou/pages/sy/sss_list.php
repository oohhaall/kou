        <section class="content-header">
          <h1>
            Sss
            <small>Soru ve Cevap Listesi</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-files-o"></i>Sss</a></li>
            <li class="active">Soru ve Cevap Listesi</li>
          </ol>
        </section>
 <section class="content">
  <!-- TO DO List -->
              <div class="box box-primary" id="list_slayt">
                <div class="box-header">
                  <i class="fa fa-files-o"></i>
                  <h3 class="box-title">Soru ve Cevap Listesi</h3>
                </div><!-- /.box-header list_comp-->
                <div class="box-body">
 <ul class="todo-list gunc_list" post_uri="sss_list" dt_table="sss" goster_num="10">

                    <?php 

                      $sor_slider = $db->prepare("SELECT * FROM sss ORDER BY id DESC LIMIT 0,10");
                      $sor_slider->execute();

                      if($sor_slider->rowCount() == 0){
                    ?>

                 <div class="callout callout-info">
                    <h4>Listede hiç haber bulunamadı</h4>
                    <p>Lütfen haber ekleyin</p>
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
                                    $style = ($dil_key=="tr")?"style='display:inline-block; font-weight:bold;'":"style='display:none;'";
                                  ?>
                                  <g type="<?php echo $dil_key; ?>" m_id='<?php echo $value["id"]; ?>' <?php echo $style; ?>><?php echo $value["soru_".$dil_key]; ?></g>
                                  <?php
                                }
                            ?>
                                <t style="display: block; margin-top:10px;"><?php echo mb_substr(strip_tags($value["cevap_tr"]),0,150,'UTF-8')."..."; ?></t>
                         <?php
                                foreach ($dil_text as $dil_key => $dil_val) {
                                    $style = "style='display:none;'";
                                  ?>
                                  <i type="<?php echo $dil_key; ?>" m_id='<?php echo $value["id"]; ?>' <?php echo $style; ?>><?php echo $value["cevap_".$dil_key]; ?></i>
                                  <?php
                                }
                            ?>

                            <t m_id='<?php echo $value["id"]; ?>' style="display: none"><?php echo $value["tarih"]; ?></t> 


                      </span>
                      <!-- Emphasis label -->
                      <small class="label label-danger"><i class="fa fa-clock-o"></i><?php echo $value["tarih"]; ?></small>
                      <!-- General tools such as edit or delete-->
                          <div class="list_active_control">
                      <div class="slider-track <?php echo ($value["drm"]==1)?"acik_on":NULL; ?>" onclick='gunc_durum("<?php echo $value["id"]; ?>")' item_id="<?php echo $value["id"]; ?>" post_type="ana_slider" dt_table="sss">
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

          <button class="btn btn-default btn-block daha_fazla" onclick="daha_fazla_goster('gunc_list')">Daha Fazla Göster</button>       
              
                </div><!-- /.box-body -->
                <div class="box-footer clearfix no-border">
                  <button class="btn btn-default pull-right"  onclick="scroll_slow_slider('ana_slider_ekle','list_slayt','a_slider_ekle')"><i class="fa fa-plus"></i> Soru ve Cevap Ekle</button>
                </div>
              </div><!-- /.box -->

 <div id="info_field">
   


 </div>

              <div class="ekle_slayt" id="ana_slider_ekle">
                <div class="box box-primary" style="display: none;">
                <div class="box-header with-border">
                  <h3 class="box-title">Soru ve Cevap Ekle</h3>
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
                      <label for="trhss">Tarih</label>
                        <div class="input-group">
                      <div class="input-group-addon tarih_goster" onclick="open_picker()">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" value="<?php echo date("d/m/Y"); ?>" disabled="disabled" name="tarih" id="reservation">
                    </div><!-- /.input group-->
                  

                  
                    </div>

 <div class="form-group" id="come_on">
                      <label for="exampleInputEmail1">Soru</label>

            <div class="row">
            <div class="col-md-12">
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <?php 
                       foreach ($dil_text as $dil_key => $dil_val) {
                          $class = ($dil_key=="tr")?"active":NULL;  ?>
                            <li class="<?php echo $class; ?>"><a href="#soru_<?php echo $dil_key; ?>" data-toggle="tab"><?php echo $dil_val; ?></a></li>
                          <?php } ?>
                </ul>
                <div class="tab-content">
                     <?php 
                       foreach ($dil_text as $dil_key => $dil_val) {
                          $class = ($dil_key=="tr")?"active":NULL;  ?>
                             <div class="tab-pane <?php echo $class; ?>" id="soru_<?php echo $dil_key; ?>">
                                 <input type="text" name="soru_<?php echo $dil_key; ?>" class="form-control" id="exampleInputEmail1" placeholder="<?php echo $dil_val; ?>">
                                
                         
                             </div><!-- /.tab-pane -->
                     <?php } ?>
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
            </div><!-- /.col -->
          </div> <!-- /.row -->
</div>

 
 <div class="form-group">
                      <label for="exampleInputEmail1">Cevap</label>

            <div class="row">
            <div class="col-md-12">
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <?php 
                       foreach ($dil_text as $dil_key => $dil_val) {
                          $class = ($dil_key=="tr")?"active":NULL;  ?>
                            <li class="<?php echo $class; ?>"><a href="#cevap_<?php echo $dil_key; ?>" data-toggle="tab"><?php echo $dil_val; ?></a></li>
                          <?php } ?>
                </ul>
                <div class="tab-content">
                      <?php 
                       foreach ($dil_text as $dil_key => $dil_val) {
                          $class = ($dil_key=="tr")?"active":NULL;  ?>
                             <div class="tab-pane <?php echo $class; ?>" id="cevap_<?php echo $dil_key; ?>">
                               <textarea placeholder="İçerik"  name="cevap_<?php echo $dil_key; ?>" rows="3" class="form-control ck_edit"></textarea>
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