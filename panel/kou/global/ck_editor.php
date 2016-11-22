    <script>
      $(function () {
         
      	<?php if($page == "ekonomi_tablo" || $page=="haber_list_tr" || $page=="bunlari_biliyormusun"|| $page=="haber_list_en"|| $page=="haber_list_gr"|| $page=="haber_list_hu" || $page=="finans" || $page=="isveren_markasi_gelisimi" || $page=="insan_kaynaklari_gelisimi" || $page=="programlar" || $page=="ekip"){  ?>	
         CKEDITOR.replace('ck_editor_test');
         <?php } ?> 

/*
      if(glob_page_uri == "finans" || glob_page_uri=="isveren_markasi_gelisimi" || glob_page_uri == "insan_kaynaklari_gelisimi" || glob_page_uri == "programlar"){

*/
           <?php if($page=="finans" || $page=="isveren_markasi_gelisimi" || $page=="insan_kaynaklari_gelisimi" || $page=="programlar" ){  ?>	
         CKEDITOR.replace('ck_2');
         <?php } ?> 

           <?php if($page=="bizim_icin_ne_soylediler" || $page=="bizim_icin_ne_soylediler" ){  ?>  

          CKEDITOR.replace('ck_baslik');
         CKEDITOR.replace('ck_icerik');


 


<?php } ?>
               <?php if($page == "programlar"){  ?> 
               $('.keep-order').multiSelect();

         <?php } ?> 
      });
    </script>