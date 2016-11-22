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
                      Kocaeli Üniversitesi
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
              <p>Kou Yönetici</p>
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
                 <i class="fa  fa-bullhorn"></i>
                <span>Duyurular</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu" menu_id="duyurular" ust_menu="duyurular">
                  <li menu_id="genel_duyurular" ust_menu="duyurular"><a href="panel.php?page=genel_duyurular"><i class="fa fa-circle-o"></i> Genel Duyurular</a></li>
                  <li menu_id="bolum_duyuru" ust_menu="duyurular"><a href="panel.php?page=bolum_duyuru"><i class="fa fa-circle-o"></i> Bölüm Duyuruları</a></li>
                  <li menu_id="haber_etkinlik" ust_menu="duyurular"><a href="panel.php?page=haber_etkinlik"><i class="fa fa-circle-o"></i> Haber ve Etkinlikler</a></li>
              
              </ul>



        
            </li>
              <li class="treeview" menu_id="personel" ust_menu="">
              <a href="#">
                 <i class="fa  fa-users"></i>
                <span>Personel</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu" menu_id="personel" ust_menu="personel">
                  <li menu_id="ogretim_uyeleri" ust_menu="personel"><a href="panel.php?page=ogretim_uyeleri"><i class="fa fa-circle-o"></i> Öğretim Üyeleri</a></li>
                  <li menu_id="ogretim_elemanlari" ust_menu="personel"><a href="panel.php?page=ogretim_elemanlari"><i class="fa fa-circle-o"></i> Öğretim Elemanları</a></li>
                  <li menu_id="idari_personel" ust_menu="personel"><a href="panel.php?page=idari_personel"><i class="fa fa-circle-o"></i> İdari Personel</a></li>
              </ul>
              </li>
            
           


            <li class="header">Kullanıcı İşlemleri</li>
            <li menu_id="sifre_degistir" ust_menu=""><a href="panel.php?page=sifre_degistir"><i class="fa fa-key"></i> <span>Şifre Değiştir</span></a></li>
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>
           <!-- Content Wrapper. Contains page content -->
       <div class="content-wrapper" id="main_full_page">

