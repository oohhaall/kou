<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Kou Yönetim Paneli</title>
    <link rel="shortcut icon" href="kou/images/favicon.ico" type="image/x-icon" >
    <!-- Tell the browser to be responsive to screen width  window.location = "panel.php?page="+page_uri;-->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    
<link rel="stylesheet" type="text/css" href="kou/image-picker/image-picker.css">

  <link rel="stylesheet" type="text/css" href="kou/fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />

  <link rel="stylesheet" type="text/css" href="kou/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />

  <link rel="stylesheet" type="text/css" href="kou/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />


    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/kou_panel.min.css">
       <!-- Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/skin-kou.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/flat/flat.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
     <link rel="stylesheet" href="kou/load/waitMe.css">
     <link rel="stylesheet" href="kou/css/multi-select.css">
     <link rel="stylesheet" type="text/css" href="kou/css/uploadfile.css">

    <link rel="stylesheet" href="dist/css/kou_glob.css">
 
  </head>
  <body class="hold-transition skin-kou sidebar-mini" id="body">
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="panel.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><img src="kou/images/kou_logo.png" width="50"></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><img src="kou/images/kou_logo.png" width="50"></span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Menüyü Küçült</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->


              <!-- Notifications Menu -->
             
              <!-- Tasks Menu -->
  
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs">Yönetici Adı</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                    <p>
                      Kullanıcı Bilgileri
                      <small>Kayıt Tarihi</small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="panel.php?page=sifre_degistir" class="btn btn-default btn-flat">Şifre Değiştir</a>
                    </div>
                    <div class="pull-right">
                      <a href="logout.php" onclick="return logout();" class="btn btn-default btn-flat">Çıkış Yap</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
            
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
             <!-- <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> -->
              <img src="kou/images/kou_logo.png" width="50px" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>Firma Adı</p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>



          <!-- Sidebar Menu -->
            <ul class="sidebar-menu">
            <li class="header">ANA KONTROL</li>
            <li class="active treeview" menu_id="ana_panel" ust_menu="">
              <a href="panel.php?page=ana_panel"><i class="fa fa-th" aria-hidden="true"></i><span>Ana Panel</span></a>
            </li>
              <li class="treeview" menu_id="slayt" ust_menu="">
              <a href="#">
                 <i class="fa fa-files-o"></i>
                <span>Slayt</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu" menu_id="slayt" ust_menu="slayt">
                  <li menu_id="slayt_list" ust_menu="slayt"><a href="panel.php?page=slayt_list"><i class="fa fa-circle-o"></i> Slayt Listesi</a></li>
              </ul>

     
      
            </li>
            
            <li class="treeview" menu_id="duyurular" ust_menu="">
              <a href="#">
                 <i class="fa fa-files-o"></i>
                <span>Duyurular</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu" menu_id="duyurular" ust_menu="duyurular">
                  <li menu_id="genel_duyurular" ust_menu="duyurular"><a href="panel.php?page=genel_duyurular"><i class="fa fa-circle-o"></i> Genel Duyurular</a></li>
                  <li menu_id="bolum_duyuru" ust_menu="duyurular"><a href="panel.php?page=bolum_duyuru"><i class="fa fa-circle-o"></i> Bölüm Duyuruları</a></li>
                  <li menu_id="haber_etkinlik" ust_menu="duyurular"><a href="panel.php?page=haber_etkinlik"><i class="fa fa-circle-o"></i> Haber ve Etkinlikler</a></li>
              
              </ul>



        
            </li>
              <li class="treeview" menu_id="yapi_gerecleri" ust_menu="">
              <a href="#">
                 <i class="fa fa-files-o"></i>
                <span>Yapı Gereçleri</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu" menu_id="yapi_gerecleri" ust_menu="yapi_gerecleri">
                  <li menu_id="yapi_gerecleri_list" ust_menu="yapi_gerecleri"><a href="panel.php?page=yapi_gerecleri_list"><i class="fa fa-circle-o"></i> Yapı Gereçleri Listesi</a></li>
              </ul>
              </li>
            
            <li class="treeview" menu_id="mimari_cozumler" ust_menu="">
              <a href="#">
                 <i class="fa fa-files-o"></i>
                <span>Mimari Çözümler</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu" menu_id="mimari_cozumler" ust_menu="mimari_cozumler">
                  <li menu_id="mimari_cozumler_list" ust_menu="mimari_cozumler"><a href="panel.php?page=mimari_cozumler_list"><i class="fa fa-circle-o"></i> Mimari Çözümler Listesi</a></li>
                  <!--<li menu_id="mimari_cozum_ekle" ust_menu="mimari_cozumler"><a href="panel.php?page=mimari_cozum_ekle"><i class="fa fa-circle-o"></i> Mimari Çözüm Ekle</a></li>-->
              </ul>
              </li>
              


                 <li class="treeview" menu_id="katalog" ust_menu="">
              <a href="#">
                 <i class="fa fa-files-o"></i>
                <span>Katalog</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu" menu_id="katalog" ust_menu="katalog">
                <li menu_id="katalog_list" ust_menu="katalog">
                <a href="panel.php?page=katalog_list"><i class="fa fa-circle-o"></i> Katalog Listesi</a>
                </li>

              </ul>
              </li>
           

            <li class="treeview" menu_id="referans" ust_menu="">
              <a href="#">
                 <i class="fa fa-files-o"></i>
                <span>Referanslar</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu" menu_id="referans" ust_menu="referans">
                  <li menu_id="referans_list" ust_menu="referans">
                  <a href="panel.php?page=referans_list"><i class="fa fa-circle-o"></i> Referans Listesi</a>
                  </li>
                  <li menu_id="ref_kategori" ust_menu="referans">
                  <a href="panel.php?page=ref_kategori"><i class="fa fa-circle-o"></i> Kategori</a>
                  </li>
                  <li menu_id="ref_ulke" ust_menu="referans">
                  <a href="panel.php?page=ref_ulke"><i class="fa fa-circle-o"></i> Ülke</a>
                  </li>
                    <li menu_id="ref_sehir_up" ust_menu="referans">
                  <a href="panel.php?page=ref_sehir_up"><i class="fa fa-circle-o"></i> Şehir Listesi</a>
                  </li>
              </ul>
              </li>



            <li class="treeview" menu_id="haberler" ust_menu="">
              <a href="#">
                 <i class="fa fa-files-o"></i>
                <span>Haberler</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu" menu_id="haberler" ust_menu="haberler">
                  <li menu_id="haber_list" ust_menu="haberler">
                  <a href="panel.php?page=haber_list"><i class="fa fa-circle-o"></i> Haber Listesi</a>
                  </li>
              </ul>
              </li>

                     <li class="treeview" menu_id="sss" ust_menu="">
              <a href="#">
                 <i class="fa fa-files-o"></i>
                <span>SSS</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu" menu_id="sss" ust_menu="sss">
                  <li menu_id="sss_list" ust_menu="sss">
                  <a href="panel.php?page=sss_list"><i class="fa fa-circle-o"></i> SSS Listesi</a>
                  </li>
              </ul>
              </li>


                           <li class="treeview" menu_id="kurumsal" ust_menu="">
              <a href="#">
                 <i class="fa fa-files-o"></i>
                <span>Kurumsal</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu" menu_id="kurumsal" ust_menu="kurumsal">
                  <li menu_id="oduller" ust_menu="kurumsal">
                  <a href="panel.php?page=oduller"><i class="fa fa-circle-o"></i> Ödüller</a>
                  </li>
                 <li menu_id="etkinlik_list" ust_menu="kurumsal">
                  <a href="panel.php?page=etkinlik_list"><i class="fa fa-circle-o"></i> Etkinlikler</a>
                  </li>

<li menu_id="basinda_seranit_list" ust_menu="kurumsal">
                  <a href="panel.php?page=basinda_seranit_list"><i class="fa fa-circle-o"></i> Basında Seranit</a>
                  </li>

<li menu_id="seranit_filmler" ust_menu="kurumsal">
                  <a href="panel.php?page=seranit_filmler"><i class="fa fa-circle-o"></i> Seranit Filmler</a>
                  </li>

<li menu_id="basin_bulteni_list" ust_menu="kurumsal">
                  <a href="panel.php?page=basin_bulteni_list"><i class="fa fa-circle-o"></i> Basın Bültenleri</a>
                  </li>

<li menu_id="sertifikalar" ust_menu="kurumsal">
                  <a href="panel.php?page=sertifikalar"><i class="fa fa-circle-o"></i> Sertifikalar</a>
                  </li>
<li menu_id="bilgi_toplum_hizmetleri" ust_menu="kurumsal">
                  <a href="panel.php?page=bilgi_toplum_hizmetleri"><i class="fa fa-circle-o"></i> Bilgi Toplum Hizmetleri</a>
                  </li>
              </ul>
              </li> 

                     <li class="treeview" menu_id="iletisim" ust_menu="">
              <a href="#">
                 <i class="fa fa-files-o"></i>
                <span>İletişim Ayarları</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu" menu_id="iletisim" ust_menu="iletisim">
                  <li menu_id="iletisim_list" ust_menu="iletisim">
                  <a href="panel.php?page=iletisim_list"><i class="fa fa-circle-o"></i> Departman Listesi</a>
                  </li>
                   <li menu_id="genel_ayarlar" ust_menu="iletisim">
                  <a href="panel.php?page=genel_ayarlar"><i class="fa fa-circle-o"></i> Genel Ayarlar</a>
                  </li>
              </ul>
              </li>
              <li class="treeview" menu_id="satis_noktalari" ust_menu="">
              <a href="#">
                 <i class="fa fa-files-o"></i>
                <span>Satış Noktaları</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu" menu_id="satis_noktalari" ust_menu="satis_noktalari">
                  <li menu_id="satisnoktalari_list" ust_menu="satis_noktalari">
                  <a href="panel.php?page=satisnoktalari_list"><i class="fa fa-circle-o"></i> Satış Noktaları List</a>
                  </li>
                  <li menu_id="satis_ulke_list" ust_menu="satis_noktalari">
                  <a href="panel.php?page=satis_ulke_list"><i class="fa fa-circle-o"></i> Ülke</a>
                  </li>
                  <li menu_id="satis_sehir_list" ust_menu="satis_noktalari">
                  <a href="panel.php?page=satis_sehir_list"><i class="fa fa-circle-o"></i> Şehir</a>
                  </li>

                  <li menu_id="ilce_list" ust_menu="satis_noktalari">
                  <a href="panel.php?page=ilce_list"><i class="fa fa-circle-o"></i> İlçe</a>
                  </li>
              </ul>
              </li>


         

                           <li class="treeview" menu_id="eposta_listesi" ust_menu="">
              <a href="panel.php?page=eposta_listesi">
                 <i class="fa fa-files-o"></i>
                <span>E-Posta Listesi</span>
              </a>

              </li>
<!--
            <li class="treeview" menu_id="biliyormusun" ust_menu="">
              <a href="#">
                 <i class="fa fa-files-o"></i>
                <span>Bunları Biliyormusun</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu" menu_id="biliyormusun" ust_menu="biliyormusun">
                  <li menu_id="bunlari_biliyormusun" ust_menu="biliyormusun"><a href="panel.php?page=bunlari_biliyormusun"><i class="fa fa-circle-o"></i> İçerik Listesi</a></li>
              </ul>

            </li>
-->
            <!-- <li class="treeview" menu_id="galeri" ust_menu="">
              <a href="panel.php?page=galeri">
                <i class="fa fa-file-image-o"></i>
                <span>Galeri</span>
                <span class="label pull-right bg-red count_inf"><?php echo $galeri_toplam; ?></span>
              </a>
            </li> -->


            <li class="header">Kullanıcı İşlemleri</li>
            <li menu_id="sifre_degistir" ust_menu=""><a href="panel.php?page=sifre_degistir"><i class="fa fa-key"></i> <span>Şifre Değiştir</span></a></li>
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>
           <!-- Content Wrapper. Contains page content -->
       <div class="content-wrapper" id="main_full_page">

