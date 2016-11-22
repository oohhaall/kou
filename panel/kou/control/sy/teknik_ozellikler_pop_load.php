<?php
  require_once "../config/global_cont.php";
  extract($_POST);
  extract($_GET);

   $dt_table = "urunler";
    $sor_urun = $db->prepare("SELECT * FROM $dt_table WHERE id=:uid");
    $sor_urun->bindValue(":uid",$uid);
    $sor_urun->execute();

    $oku_urun = $sor_urun->fetch();

    $yuzey_sel = explode(",",$oku_urun["fizikselOzellikler"]);
 ?>

       <select multiple='multiple' id='keep-order2' class="form-control" name="filt_select">
      <?php

          $sor_page_list = $db->query("SELECT * FROM fizikselozellikler ORDER BY id DESC");
            foreach($sor_page_list->fetchAll() as $key => $value) {
              ?>
            <option value='<?php echo $value["id"]; ?>' <?php echo (in_array($value["id"], $yuzey_sel))?"selected":NULL; ?>><?php echo $value["baslik"]; ?></option>
              <?php
            }
       ?> 
      </select>

        <script type="text/javascript">
              $('#keep-order2').multiSelect();
        </script>