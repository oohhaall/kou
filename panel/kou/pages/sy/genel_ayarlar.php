        <?php 
          $sor_mail = $db->prepare("SELECT * FROM statiksayfalar WHERE id=1");
          $sor_mail->execute();
          $oku_genel_ayar = $sor_mail->fetch();
        ?>
        <section class="content-header">
          <h1>
            İletişim
            <small>Genel Ayarlar</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-files-o"></i>İletişim</a></li>
            <li class="active">Genel Ayarlar</li>
          </ol>
        </section>
 <section class="content">
  <!-- TO DO List -->
              <div class="box box-primary" id="list_içerik">
                <div class="box-header">
                  <i class="fa fa-files-o"></i>
                  <h3 class="box-title">Genel Ayarlar</h3>
                </div><!-- /.box-header -->
                <div class="box-body">

                 <div id="info_field">
   


                </div>
                    <form role="form" id="a_slider_ekle" method="post" enctype="multipart/form-data" onsubmit="return slider_ekle('ana_slider_ekle','a_slider_ekle','info_field','ana_slider_ekle');">
                    <div class="form-group">
                      <label for="exampleInputFile">Mail Adresi :</label>
                      <input id="exampleInputFile" class="form-control" type="text" name="mail_adresi" value="<?php echo $oku_genel_ayar["iletisimGenelMail"]; ?>" required="">
                      <p class="help-block">* İletişim formu seçilen departmana gönderilirken bir kopyası (ek olarak kullanıcının gönderdiği departman, ip ve tarayıcı bilgisi) aşağıda belirteceğiniz mail adresine gönderelicektir.</p>
                    </div>

                   <div class="box-footer">
                   <button class="btn btn-danger">Ekle</button>
                  </div>
                  </form>
                </div>
                </div>
                </section>
