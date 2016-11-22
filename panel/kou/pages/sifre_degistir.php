
<section class="content">
  <div class="info" id="info_box">
  <div class="alert alert-info alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-info"></i> Bilgi!</h4>
                    Şifre belirlerken özel karakter ve büyük küçük harf kullanmak şifrenizin tahmin edilme olasılığını en aza indirir.<br>
                    <b>Not :</b> Yeni şifreniz bir sonraki oturumdan itibaren geçerli olacaktır.
                  </div>
  </div>
          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Şifre Yenile</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" id="sifre_degis" onsubmit="return sifre_degis('sifre_degis','info_box');">
                  <div class="box-body">
                            <div class="form-group">
                      <label>Kullanıcı Adı</label>
                      <input type="text" class="form-control" name="kullanici_adi" placeholder="<?php echo $k_adi; ?>" disabled>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Yeni Şifre</label>
                      <input type="password" name="sifre" class="form-control" id="exampleInputPassword1" placeholder="Yeni Şifre" required="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Yeni Şifre Tekrar</label>
                      <input type="password" name="sifre_tekrar" class="form-control" id="exampleInputPassword1" placeholder="Yeni Şifre Tekrar" required="">
                    </div>
    
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Kaydet</button>
                  </div>
                </form>
              </div><!-- /.box -->
              </section>