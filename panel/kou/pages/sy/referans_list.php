
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

        <?php 

                      $sor_slider = $db->prepare("SELECT * FROM referanslar ORDER BY sra DESC LIMIT 0,10");
                      $sor_slider->execute();

                      if($sor_slider->rowCount() == 0){
                    ?>

                 <div class="callout callout-info">
                    <h4>Listede hiç slayt bulunamadı</h4>
                    <p>Lütfen slayt ekleyin</p>
                  </div>
<?php }else{  ?>




<table class="table table-bordered text-center">
      <thead>
        <tr>
          <th>&nbsp;</th>
          <th>Referans Adı</th>
          <th>Kategori</th>
          <th>Ülke</th>
          <th>Şehir</th>
          <th style="width:10%;"">İşlem</th>
          <!--<th>X-Small <code>.btn-xs</code></th>
          <th>Flat <code>.btn-flat</code></th>
          <th>Disabled <code>.disabled</code></th>-->
        </tr>
      </thead>
      <tbody class="todo-list list_comp" post_uri="referans_list" dt_table="referanslar" goster_num="10">
      
 
<?php
  foreach ($sor_slider->fetchAll() as $key => $value) {
?>
    <tr  id="<?php echo "list_update_".$value["id"]; ?>" sira='<?php echo $value["sra"]; ?>' m_id='<?php echo $value["id"]; ?>'>
        <td>
           <span class="handle">
               <i class="fa fa-ellipsis-v"></i>
               <i class="fa fa-ellipsis-v"></i>
            </span>
        </td>
        <td>
                <span class="text">
                          <a href="#">
                              <img width="80" height="80" m_id='<?php echo $value["id"]; ?>' src="<?php echo ($value["resim"]!="")?$file_read_path.$value["resim"]:""; ?>">
                          </a> 



                            <?php
                                foreach ($dil_text as $dil_key => $dil_val) {
                                    $style = ($dil_key=="tr")?"style='display:inline-block;'":"style='display:none;'";
                                  ?>
                                  <g type="<?php echo $dil_key; ?>" m_id='<?php echo $value["id"]; ?>' <?php echo $style; ?>><?php echo $value["baslik_".$dil_key]; ?></g>
                                  <?php
                                }
                            ?>

                            <kt m_id='<?php echo $value["id"]; ?>' style="display: none;"><?php echo $value["kid"]; ?></kt>
                            <ulk m_id='<?php echo $value["id"]; ?>' style="display: none;"><?php echo $value["uid"]; ?></ulk>
                            <sid m_id='<?php echo $value["id"]; ?>' style="display: none;"><?php echo $value["sid"]; ?></sid>


                      </span>
                      <small class="label label-danger"><i class="fa fa-clock-o"></i><?php echo $value["tarih"]; ?></small>

        </td>
        <td><?php 
              $sor_kategori = $db->prepare("SELECT * FROM refkategori WHERE id=:kid");
              $sor_kategori->bindValue(":kid",$value["kid"]);
              $sor_kategori->execute();
              $oku_kategori = $sor_kategori->fetch();
              echo $oku_kategori["baslik_tr"];
        ?></td>
        <td><?php 
              $sor_ulke = $db->prepare("SELECT * FROM refulke WHERE id=:uid");
              $sor_ulke->bindValue(":uid",$value["uid"]);
              $sor_ulke->execute();
              $oku_ulke = $sor_ulke->fetch();
              echo $oku_ulke["baslik_tr"];
        ?></td>
        <td><?php 
              $sor_sehir = $db->prepare("SELECT * FROM refsehir WHERE id=:sid");
              $sor_sehir->bindValue(":sid",$value["sid"]);
              $sor_sehir->execute();
              $oku_sehir = $sor_sehir->fetch();
              echo $oku_sehir["baslik"];
        ?></td>
        <td>
          
  <div class="list_active_control">
                      <div class="slider-track <?php echo ($value["drm"]==1)?"acik_on":NULL; ?>" onclick='gunc_durum("<?php echo $value["id"]; ?>")' item_id="<?php echo $value["id"]; ?>" post_type="ana_slider" dt_table="referanslar">
                          <div class="slider-handle"></div>
                        </div>
                        </div>
                      <div class="tools">
                        <i class="fa fa-edit" onclick="slider_duzenle('ana_slider_ekle','<?php echo $value["id"]; ?>','list_slayt','a_slider_ekle')"></i>
                        <i class="fa fa-trash-o" onclick="slider_sil('ana_slider_ekle','<?php echo $value["id"]; ?>','list_slayt','a_slider_ekle','info_field')"></i>
                      </div>
        </td>
          </tr>
                 
        <?php } } ?>
       </tbody>
</table>






          <button class="btn btn-default btn-block daha_fazla" onclick="daha_fazla_goster('list_comp')">Daha Fazla Göster</button>       
              
                </div><!-- /.box-body -->
                

                <div class="box-footer clearfix no-border">
                  <button class="btn btn-default pull-right"  onclick="scroll_slow_slider('ana_slider_ekle','list_slayt','a_slider_ekle')"><i class="fa fa-plus"></i> Referans Ekle</button>
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
                <form role="form" id="a_slider_ekle" method="post" enctype="multipart/form-data" onsubmit="return slider_ekle('ana_slider_ekle','a_slider_ekle','info_field','ana_slider_ekle');">
                      <input type="hidden" name="tip" value="1">
                      <input type="hidden" name="sid" value="0">
                  <div class="box-body">
                  

                   <div class="form-group">
                      <label for="exampleInputFile">Resim</label>
                        <img name="on_" src="" style="display: none;" width="100">
                        <input type="file" name="slider_resim" id="exampleInputFile">
                    </div>


 <div class="form-group">
            <label for="baslik__">Başlık</label>

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
                                 <input type="text" name="baslik_<?php echo $dil_key; ?>" class="form-control" id="baslik__" placeholder="<?php echo $dil_val; ?>">
                             </div><!-- /.tab-pane -->
                     <?php } ?>
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
            </div><!-- /.col -->
          </div> <!-- /.row -->
</div>




                    <div class="form-group">


                      <label for="kategori_s">Kategori</label>
                       
                      <select class="form-control" name="kategori" id="kategori_s">
                          <?php 

                              $sor_kategori = $db->prepare("SELECT * FROM refkategori ORDER BY baslik_tr ASC");

                              $sor_kategori->execute();
                              foreach ($sor_kategori->fetchAll() as $key => $value) {
                                ?>
                                    <option value="<?php echo $value["id"]; ?>"><?php echo $value["baslik_tr"]; ?></option>
                                <?php
                              }
                          ?>
                      </select>
                      <!--<input type="text" name="link" class="form-control" id="exampleInputEmail1" placeholder="Link">-->

                  
                    </div>

         


                            <div class="form-group">


                      <label for="ulke_s">Ülke</label>
                       
                      <select class="form-control" name="ulke" id="ulke_s">
                          <?php 

                              $sor_kategori = $db->prepare("SELECT * FROM refulke ORDER BY baslik_tr ASC");

                              $sor_kategori->execute();
                                $seh_id = NULL;
                              foreach ($sor_kategori->fetchAll() as $key => $value) {
                                  $seh_id = ($key==0)?$value["id"]:NULL;

                                ?>
                                    <option value="<?php echo $value["id"]; ?>"><?php echo $value["baslik_tr"]; ?></option>
                                <?php
                              }
                          ?>
                      </select>
                  
                    </div>



                                     <div class="form-group">


                      <label for="sehir_s">Şehir</label>
                       
                      <select class="form-control" name="sehir" id="sehir_s">
                          <?php 

                              $sor_kategori = $db->prepare("SELECT * FROM refsehir WHERE uid=:uid ORDER BY baslik ASC");
                              $sor_kategori->bindValue(":uid",$seh_id);
                              $sor_kategori->execute();
                              foreach ($sor_kategori->fetchAll() as $key => $value) {
                                ?>
                                    <option value="<?php echo $value["id"]; ?>"><?php echo $value["baslik"]; ?></option>
                                <?php
                              }
                          ?>
                      </select>
                  
                    </div>


                  </div><!-- /.box-body -->




                  <div class="box-footer">
                   <button class="btn btn-danger">Ekle</button>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </section>



