<?php require_once "panel/kou/config/global_cont.php"; ?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script> 
	<link href="https://fonts.googleapis.com/css?family=Montserrat+Alternates:400,700|Montserrat:400,700" rel="stylesheet"> 


	<!-- Add mousewheel plugin (this is optional) -->
	<script type="text/javascript" src="fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>

	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />

	<!-- Add Button helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
	<script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>

	<!-- Add Thumbnail helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
	<script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

	<!-- Add Media helper (this is optional) -->
	<script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

	    <link rel="stylesheet" href="dist/css/swiper.min.css">

	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>

<nav>
	<div class="mob_menu">
			<header>
  <div class="header__top">
    <div class="inner">
					<span class="toggle js-toggle">
						<span class="toggle__line--wrapper">								
							<em class="toggle__line--first"></em>
							<em class="toggle__line--two"></em>
							<em class="toggle__line--three"></em>
						</span>
					</span>
			</div>
  </div>
</header>
<nav class="menu__ multilevelMenu">
 	<ul>
				<li><a href="index.php">Ana Sayfa</a></li>
				<li >
					<a href="#">Hakkımızda</a>
					<ul>
						<li><a href="tarihce.php">Tarihçe</a></li>
						<li><a href="hakkimizda.php">Hakkımızda</a></li>
						<li><a href="misyon.php">Misyon</a></li>
						<li><a href="vizyon.php">Vizyon</a></li>
						<li><a href="anabilimdallari.php">Ana Bilim Dalları</a></li>
						<li><a href="programciktilari.php">Program Çıktıları</a></li>
					</ul>
				</li>
				<li><a href="yonetim.php">Yönetim</a></li>
				<li >
					<a href="#">Personel</a>
					<ul>
						<li><a href="personel.php?uid=1">Öğretim Üyeleri</a></li>
						<li><a href="personel.php?uid=2">Öğretim Elemanları</a></li>
						<li><a href="personel.php?uid=3">İdari Personel</a></li>
						<li><a href="panel">Sisteme Giriş</a></li>
					</ul>
				</li>
					<li>
					<a href="iletisim.php">İletişim/Ulaşım</a>
					</li>
					<li>
					<a href="http://bilgisayar.kocaeli.edu.tr/koubil3d.html">3DNavi</a>
					</li>
			</ul>
			<ul>
				<li ><a href="#">Araştırma</a>
					<ul >
						<li><a href="http://bilgisayar.kocaeli.edu.tr/akilli_sistemler_lab/" target="_blank">Akıllı Sistemler Araştırma Laboratuvarı</a></li>
						<li><a href="http://bilgisayar.kocaeli.edu.tr/comnet" target="_blank">Bilgisayar Ağları ve Haberleşme Araştırma Laboratuvarı</a></li>
						<li><a href="http://embedded.kocaeli.edu.tr/" target="_blank">Gömülü ve Algılayıcı Sistemler Araştırma Laboratuvarı</a></li>
						<li><a href="http://ipcv.kocaeli.edu.tr/" target="_blank">Görüntü İşleme Araştırma Laboratuvarı</a></li>
						<li><a href="http://ibel.kocaeli.edu.tr/" target="_blank">İnsan Bilgisayar Etkileşimi Araştırma Laboratuvarı</a></li>
						<li><a href="http://yapbenzet.kocaeli.edu.tr/" target="_blank">Yapay Zeka ve Benzetim Sistemleri Araştırma Laboratuvarı</a></li>
						<li><a href="projeler.php">Projeler</a></li>
					</ul>
					</li>
				<li >
					<a href="#">Lisans</a>
					<ul>
						<li><a href="http://mf.kocaeli.edu.tr/ogrenci/formlar.php" target="_blank">Öğrenci Dilekçe ve Formları</a></li>
						<li><a href="lisansdersplani.php">Ders Planı</a></li>
						<li><a href="lisansdersicerikleri.php">Ders İçerikleri</a></li>
  					    <li><a href="#">Ders Programı</a></li>
  					    <li><a href="#">Danışmanlıklar</a></li>
						<li><a href="#">İntibak Öğrencileri</a></li>
						<li><a href="#">Aday Öğrenciler</a></li>
						<li><a href="projebitirmeler.php">Araştırma Problemleri ve Bitirme</a></li>
						<li><a href="http://odb.kocaeli.edu.tr/akademik_takvim.php">Akademik Takvim</a></li>
						<li><a href="mudek.php">MÜDEK</a></li>
						<li><a href="https://ogr.kocaeli.edu.tr/KOUBS/Genel/Diplomasorgu/diplomanosorgu.cfm" target="_blank">Diploma Sorgulama</a></li>						
						<li><a href="staj.php">Staj</a></li>	
					</ul>
				</li>
				<li ><a href="#">Y.Lisans Doktora</a>
				<ul>

							<li><a href="calismaalanlari.php">Çalışma Alanları</a></li>
						<li><a href="fbederslistesi.php">Ders Listesi</a></li>
						<li><a href="#">Ders Programı</a></li>
						<li><a href="#">Tezler</a></li>
						<li><a href="#">Doktora Yeterlik Sınavı</a></li>
					</ul>
				</li>
				<li >
					<a href="https://www.facebook.com/groups/25429857332/" target="_blank">Mezunlar</a>
				</li>
					<li>
					<a href="#">English</a>
					</li>
					
			</ul>
</nav>
</div>
	<div class="header"></div>

	<div class="header_top">
			<div class="mob_logo">
				<a href="index.php" class="logo"><img src="images/logo.jpg" class="img-responsive"></a>
			</div>
		<div class="ust_tek_menu">
		<div class="wrapper">
		<nav class="menu">
			<ul>
				<li><a href="index.php">Ana Sayfa</a></li>
				<li class="parent-item">
					<a href="#">Hakkımızda</a>
					<ul class="sub-menu">
						<li><a href="tarihce.php">Tarihçe</a></li>
						<li><a href="hakkimizda.php">Hakkımızda</a></li>
						<li><a href="misyon.php">Misyon</a></li>
						<li><a href="vizyon.php">Vizyon</a></li>
						<li><a href="anabilimdallari.php">Ana Bilim Dalları</a></li>
						<li><a href="programciktilari.php">Program Çıktıları</a></li>
					</ul>
				</li>
				<li><a href="yonetim.php">Yönetim</a></li>
				<li class="parent-item">
					<a href="#">Personel</a>
					<ul class="sub-menu">
						<li><a href="personel.php?uid=1">Öğretim Üyeleri</a></li>
						<li><a href="personel.php?uid=2">Öğretim Elemanları</a></li>
						<li><a href="personel.php?uid=3">İdari Personel</a></li>
						<li><a href="panel">Sisteme Giriş</a></li>
					</ul>
				</li>
					<li>
					<a href="iletisim.php">İletişim/Ulaşım</a>
					</li>
					<li>
					<a href="http://bilgisayar.kocaeli.edu.tr/koubil3d.html">3DNavi</a>
					</li>
			</ul>
		</nav>
	</div>
		</div>
		<div class="clear"></div>
		<div class="logo_menu">
				<a href="index.php" class="logo"><img src="images/logo.jpg" class="img-responsive"></a>
		
			<div class="alt_tek_menu">
				<div class="wrapper">
		<nav class="menu">
			<ul>
				<li class="parent-item"><a href="#">Araştırma</a>
					<ul class="sub-menu" style="width: 250px;">
						<li><a href="http://bilgisayar.kocaeli.edu.tr/akilli_sistemler_lab/" target="_blank">Akıllı Sistemler Araştırma Laboratuvarı</a></li>
						<li><a href="http://bilgisayar.kocaeli.edu.tr/comnet" target="_blank">Bilgisayar Ağları ve Haberleşme Araştırma Laboratuvarı</a></li>
						<li><a href="http://embedded.kocaeli.edu.tr/" target="_blank">Gömülü ve Algılayıcı Sistemler Araştırma Laboratuvarı</a></li>
						<li><a href="http://ipcv.kocaeli.edu.tr/" target="_blank">Görüntü İşleme Araştırma Laboratuvarı</a></li>
						<li><a href="http://ibel.kocaeli.edu.tr/" target="_blank">İnsan Bilgisayar Etkileşimi Araştırma Laboratuvarı</a></li>
						<li><a href="http://yapbenzet.kocaeli.edu.tr/" target="_blank">Yapay Zeka ve Benzetim Sistemleri Araştırma Laboratuvarı</a></li>
						<li style="width: 250px;"><a href="projeler.php">Projeler</a></li>
					</ul>
					</li>
				<li class="parent-item">
					<a href="#">Lisans</a>
					<ul class="sub-menu">
						<li><a href="http://mf.kocaeli.edu.tr/ogrenci/formlar.php" target="_blank">Öğrenci Dilekçe ve Formları</a></li>
						<li><a href="lisansdersplani.php">Ders Planı</a></li>
						<li><a href="lisansdersicerikleri.php">Ders İçerikleri</a></li>
  					    <li><a href="#">Ders Programı</a></li>
  					    <li><a href="#">Danışmanlıklar</a></li>
						<li><a href="#">İntibak Öğrencileri</a></li>
						<li><a href="#">Aday Öğrenciler</a></li>
						<li><a href="projebitirmeler.php">Araştırma Problemleri ve Bitirme</a></li>
						<li><a href="http://odb.kocaeli.edu.tr/akademik_takvim.php">Akademik Takvim</a></li>
						<li><a href="mudek.php">MÜDEK</a></li>
						<li><a href="https://ogr.kocaeli.edu.tr/KOUBS/Genel/Diplomasorgu/diplomanosorgu.cfm" target="_blank">Diploma Sorgulama</a></li>						
						<li><a href="staj.php">Staj</a></li>	
					</ul>
				</li>
				<li class="parent-item"><a href="#">Y.Lisans Doktora</a>
				<ul class="sub-menu">

							<li><a href="calismaalanlari.php">Çalışma Alanları</a></li>
						<li><a href="fbederslistesi.php">Ders Listesi</a></li>
						<li><a href="#">Ders Programı</a></li>
						<li><a href="#">Tezler</a></li>
						<li><a href="#">Doktora Yeterlik Sınavı</a></li>
					</ul>
				</li>
				<li >
					<a href="https://www.facebook.com/groups/25429857332/" target="_blank">Mezunlar</a>
				</li>
					<li>
					<a href="#">English</a>
					</li>
					
			</ul>
		</nav>
	</div>
			</div>
		</div>





	</div>
  
  
</nav>
