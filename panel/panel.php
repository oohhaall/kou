<?php
require_once "kou/config/global_cont.php";

echo (isset($_SESSION["login"]) != "true")?"<script>window.location = 'index.php';</script>":NULL;

$sor_kullanici_adi = $db->prepare("SELECT * FROM panel_user WHERE id=:uid");
$sor_kullanici_adi->bindValue(":uid",$_SESSION["user_id"]);
$sor_kullanici_adi->execute();
$kullanici_bilgi = $sor_kullanici_adi->fetch();
$k_adi = $kullanici_bilgi["user"];
	extract($_GET);
  
/*
  $sor_ana_count = $db->query("SELECT COUNT(*) FROM slider WHERE tip='1'")->fetch();
  $sor_alt_count = $db->query("SELECT COUNT(*) FROM slider WHERE tip='2'")->fetch();
  $sor_galeri_count = $db->query("SELECT COUNT(*) FROM galeri")->fetch();
  
  $ana_slider_toplam = $sor_ana_count["COUNT(*)"];
  $alt_slider_toplam = $sor_alt_count["COUNT(*)"];
  $galeri_toplam = $sor_galeri_count["COUNT(*)"];*/
  $ana_slider_toplam = 0;
  $alt_slider_toplam = 0;
  $galeri_toplam = 0;
  require_once "kou/global/ust.php";

  $path_p = "kou/pages/";
  if(isset($page)){
  if(file_exists($path_p.$page.".php")){
      require_once $path_p.$page.".php";
  }else{
    
?>
    <script type="text/javascript">
      window.location = "panel.php?page=404"; 
    </script>
<?php
  }
}else{
   require_once $path_p."ana_panel.php";
}

?>
    



<?php  
	require_once "kou/global/alt.php";
?>