
        <section class="content-header">
          <h1>
            Etkinlik
            <small>Etkinlik Listesi</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-files-o"></i>Etkinlik</a></li>
            <li class="active">Etkinlik Listesi</li>
          </ol>
        </section>
 <section class="content">
  <!-- TO DO List -->
              <div class="box box-primary" id="list_slayt">
                <div class="box-header">
                  <i class="fa fa-files-o"></i>
                  <h3 class="box-title">Etkinlik Listesi</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
 <ul class="todo-list basin_list" post_uri="basinda_seranit_list" dt_table="basindaseranit" goster_num="10">

                    <?php 

                      $sor_slider = $db->prepare("SELECT id, resim, DATE_FORMAT(tarih,'%d.%m.%Y') as tarh FROM basindaseranit ORDER BY tarih DESC LIMIT 0,10");
                      $sor_slider->execute();

                      if($sor_slider->rowCount() == 0){
                    ?>

                 <div class="callout callout-info">
                    <h4>Listede hiç katalog bulunamadı</h4>
                    <p>Lütfen katalog ekleyin</p>
                  </div>
<?php }else{  ?>
<?php
  foreach ($sor_slider->fetchAll() as $key => $value) {
?>

                   <li id="<?php echo "list_update_".$value["id"]; ?>" m_id='<?php echo $value["id"]; ?>'>
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
                        
                                    <img type="" width="150" height="80" m_id='<?php echo $value["id"]; ?>' src="<?php echo ($value["resim"]!="")?$file_read_path.$value["resim"]:""; ?>">
                                  
                          </a> 



           
                        

                            <t m_id='<?php echo $value["id"]; ?>' style="display: none;"><?php echo $value["tarh"]; ?></t>

                      </span>
                      <!-- Emphasis label -->
                      <small class="label label-danger"><i class="fa fa-clock-o"></i><?php echo $value["tarh"]; ?></small>
                      <!-- General tools such as edit or delete
                          <div class="list_active_control">
                      <div class="slider-track <?php echo ($value["drm"]==1)?"acik_on":NULL; ?>" onclick='gunc_durum("<?php echo $value["id"]; ?>")' item_id="<?php echo $value["id"]; ?>" post_type="ana_slider" dt_table="katalog">
                          <div class="slider-handle"></div>
                        </div>
                        </div>-->
                      <div class="tools">
                        <i class="fa fa-edit" onclick="slider_duzenle('ana_slider_ekle','<?php echo $value["id"]; ?>','list_slayt','a_slider_ekle')"></i>
                        <i class="fa fa-trash-o" onclick="slider_sil('ana_slider_ekle','<?php echo $value["id"]; ?>','list_slayt','a_slider_ekle','info_field')"></i>
                      </div>
                  
                    </li>
        <?php } } ?>
  </ul>

          <button class="btn btn-default btn-block daha_fazla" onclick="daha_fazla_goster('basin_list')">Daha Fazla Göster</button>       
              
                </div><!-- /.box-body -->
                <div class="box-footer clearfix no-border">
                  <button class="btn btn-default pull-right"  onclick="scroll_slow_slider('ana_slider_ekle','list_slayt','a_slider_ekle')"><i class="fa fa-plus"></i> Etkinlik Ekle</button>
                </div>
              </div><!-- /.box -->

 <div id="info_field">
   


 </div>

              <div class="ekle_slayt" id="ana_slider_ekle">
                <div class="box box-primary" style="display: none;">
                <div class="box-header with-border">
                  <h3 class="box-title">Etkinlik Ekle</h3>
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
                      <label for="exampleInputEmail1">Basın Görseli</label>

                       <img src="" name="on_" width="150">
                                <input type="file" name="slider_resim" id="exampleInputFile" required="">
                    </div>


                    <div class="form-group">
                      <label for="trhss">Tarih</label>
                        <div class="input-group">
                      <div class="input-group-addon tarih_goster" onclick="open_picker()">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" value="<?php echo date("d/m/Y"); ?>" disabled="disabled" name="tarih" id="reservation">
                    </div><!-- /.input group -->
                  
                    <!-- onclick="open_picker()"  <input type="text" name="tarih" class="form-control" id="trhss" placeholder="Tarih"> -->

                  
                    </div>
                  

                  </div><!-- /.box-body -->




                  <div class="box-footer">
                   <button class="btn btn-danger">Ekle</button>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </section>