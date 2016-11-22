<?php 
	$dt_table ="personel";
?>
        <section class="content-header">
          <h1>
            Personel
            <small>Personel Listesi</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-files-o"></i>Personel</a></li>
            <li class="active">Personel Listesi</li>
          </ol>
        </section>
 <section class="content">
  <!-- TO DO List -->
              <div class="box box-primary" id="list_slider">
                <div class="box-header">
                  <i class="fa fa-files-o"></i>
                  <h3 class="box-title">Personel Listesi</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
 <ul class="todo-list list_comp" post_uri="ogretim_uyeleri" dt_table="<?php echo $dt_table; ?>" goster_num="10">

                    <?php 

                      $sor_slider = $db->prepare("SELECT * FROM $dt_table WHERE type='1' ORDER BY sira DESC LIMIT 0,10");
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
                          
                              <img width="80" height="80" m_id='<?php echo $value["id"]; ?>' src="<?php echo ($value["resim"]!="")?$file_read_path.$value["resim"]:""; ?>">
                               



                            <bilgiler>
                           			<g m_id='<?php echo $value["id"]; ?>'><?php echo $value["isim"]; ?></g>
                           			<url m_id='<?php echo $value["id"]; ?>' style="display: none"><?php echo $value["url"]; ?></url>
                           			<email m_id='<?php echo $value["id"]; ?>' style="display: none"><?php echo $value["email"]; ?></email>
                           			<oda m_id='<?php echo $value["id"]; ?>' style="display: none"><?php echo $value["oda"]; ?></oda>
                           			<tel m_id='<?php echo $value["id"]; ?>' style="display: none"><?php echo $value["telefon"]; ?></tel>
                                <anabil m_id='<?php echo $value["id"]; ?>' style="display: none"><?php echo $value["anabilim_dali"]; ?></anabil>
                                
                           			<?php 
                           				foreach ($dil_text as $key => $values) {
                           					?>
                           			<arastirma type="<?php echo $key; ?>" m_id='<?php echo $value["id"]; ?>' style="display: none"><?php echo $value["arastirma_alani_$key"]; ?></arastirma>
                           				<?php
                           				}
                           			?>
                           	</bilgiler>

                      </span>
                      <!-- Emphasis label -->
                      <small class="label label-danger"><i class="fa fa-clock-o"></i><?php echo $value["tarih"]; ?></small>
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

          <button class="btn btn-default btn-block daha_fazla" onclick="daha_fazla_goster('list_comp')">Daha Fazla Göster</button>       
              
                </div><!-- /.box-body -->
                <div class="box-footer clearfix no-border">
                  <button class="btn btn-default pull-right"  onclick="scroll_slow_slider('ana_slider_ekle','list_slider','a_slider_ekle')"><i class="fa fa-plus"></i> Personel Ekle</button>
                </div>
              </div><!-- /.box -->

 <div id="info_field">
   


 </div>

              <div class="ekle_slider" id="ana_slider_ekle">
                <div class="box box-primary" style="display: none;">
                <div class="box-header with-border">
                  <h3 class="box-title">Personel Ekle</h3>
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
                      <label for="exampleInputFile">Resim</label>
                           <input type="file" name="slider_resim" id="exampleInputFile" required="">
                           <img class="on_" src="" style="display: none" width="100">
                    </div>



 <div class="form-group">
	 <label for="isim">İsim</label>
     <input type="text" name="isim" id="isim" class="form-control" placeholder="İsim" required="">
</div>



 <div class="form-group">
	 <label for="mail">E-Mail</label>
     <input type="email" name="email" id="mail" class="form-control" placeholder="E-Mail" required="">
</div>
   

 <div class="form-group">
	 <label for="oda">Oda</label>
     <input type="text" name="oda" id="oda" class="form-control" placeholder="Oda" required="">
</div>

 <div class="form-group">
	 <label for="telefon">Telefon</label>
     <input type="tel" name="telefon" id="telefon" class="form-control" placeholder="Telefon" required="">
</div>


 <div class="form-group">
   <label for="anabilimdali">Ana Bilim Dalı</label>
     <input type="text" name="anabilimdali" id="anabilimdali" class="form-control" placeholder="Ana Bilim Dalı" required="">
</div>

               
<div class="form-group">
               <label for="">Araştırma Alanı</label>
            <div class="row">
            <div class="col-md-12">
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <?php 
                       foreach ($dil_text as $dil_key => $dil_val) {
                          $class = ($dil_key=="tr")?"active":NULL;  ?>
                            <li class="<?php echo $class; ?>"><a href="#arastirma_alani_<?php echo $dil_key; ?>" data-toggle="tab"><?php echo $dil_val; ?></a></li>
                          <?php } ?>
                </ul>
                <div class="tab-content">
                      <?php 
                       foreach ($dil_text as $dil_key => $dil_val) {
                          $class = ($dil_key=="tr")?"active":NULL;  ?>
                             <div class="tab-pane <?php echo $class; ?>" id="arastirma_alani_<?php echo $dil_key; ?>">
                               <textarea placeholder="İçerik"  name="arastirma_alani_<?php echo $dil_key; ?>" rows="3" class="form-control ck_edit"></textarea>
                             </div><!-- /.tab-pane -->
                     <?php } ?>
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
            </div><!-- /.col -->
          </div> <!-- /.row -->
</div>
 <div class="form-group">
	 <label for="url">Kişisel Web Sitesi</label>
     <input type="url" name="url" id="url" class="form-control" placeholder="Kişisel Web Sitesi" required="">
</div>


                  </div><!-- /.box-body -->




                  <div class="box-footer">
                   <button class="btn btn-danger">Ekle</button>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </section>



