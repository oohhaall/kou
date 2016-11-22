<?php 
    require_once "../config/global_cont.php";
    extract($_POST);
    extract($_GET);

    $dt_table = "tabozelparcalar";
    ?>
 <select class="image-picker picker_hide" multiple="multiple" style="display: none;">
                                 <?php
                           $sor_urun = $db->prepare("SELECT * FROM urunler WHERE id=:uid");
                           $sor_urun->bindValue(":uid",$uid);
                           $sor_urun->execute();
                           $oku_urun = $sor_urun->fetch();
    $sor_koleksiyon = $db->prepare("SELECT * FROM $dt_table ORDER BY sra DESC");
    //$sor_koleksiyon->bindValue(":uid",$uid);
    $sor_koleksiyon->execute();
    $kesim_tab = explode(",",$oku_urun["ozelkesimler"]);
    foreach ($sor_koleksiyon->fetchAll() as $key => $value) {
      ?>
    <option data-img-src="<?php echo $file_read_path.$value["resim"]; ?>" data-img-alt="" value="<?php echo $value["id"]; ?>" <?php echo (in_array($value["id"], $kesim_tab))?"selected":NULL; ?>><?php echo $value["id"]; ?></option>
                                      
    <?php
      }
      ?>

    </select>
<script type="text/javascript">
	 $(".picker_hide").imagepicker({
      /*limit_reached:  function(){alert('We are full!')},*/
      hide_select:    false
  });
</script>