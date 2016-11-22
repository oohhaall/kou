        <?php 
          $sor_mail = $db->prepare("SELECT * FROM statiksayfalar WHERE id=1");
          $sor_mail->execute();
          $oku_genel_ayar = $sor_mail->fetch();
        ?>
        <section class="content-header">
          <h1>
            Bilgi Toplum Hizmetleri
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-files-o"></i>Bilgi Toplum Hizmetleri</a></li>
          </ol>
        </section>
 <section class="content">
  <!-- TO DO List -->
              <div class="box box-primary" id="list_içerik">
                <div class="box-header">
                  <!--<i class="fa fa-files-o"></i>
                  <h3 class="box-title">Genel Ayarlar</h3>-->
                </div><!-- /.box-header -->
                <div class="box-body">

                 <div id="info_field">
   


                </div>
                    <form role="form" id="a_slider_ekle" method="post" enctype="multipart/form-data" onsubmit="return slider_ekle('ana_slider_ekle','a_slider_ekle','info_field','ana_slider_ekle');">
                    

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
                                 <textarea name="bilgitoplumu_<?php echo $dil_key; ?>" class="ck_area"><?php echo $oku_genel_ayar["bilgitoplumu_".$dil_key]; ?></textarea>
                                
                         
                             </div><!-- /.tab-pane -->
                     <?php } ?>
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
            </div><!-- /.col -->

                   <div class="box-footer">
                   <button class="btn btn-danger">Ekle</button>
                  </div>
                  </form>
                </div>
                </div>
                </section>
