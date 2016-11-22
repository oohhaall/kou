  
        </div><!-- /.content-wrapper -->   
 <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
         <!-- Anything you want-->
        </div>
        <strong>Copyright &copy; 2016 <a href="http://bilgisayar.kocaeli.edu.tr/" target="_blank">Kou</a></strong> All rights reserved.
      </footer>

      <!-- Control Sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
   <!-- </div> ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

   <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>    


    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    

    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>

    <!--<script src="plugins/morris/morris.min.js"></script>
     Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="plugins/daterangepicker/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="kou/ckeditor/ckeditor.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->

    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) 
    <script src="dist/js/pages/dashboard.js"></script>-->
    <!-- AdminLTE for demo purposes -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="dist/js/demo.js"></script>
    <script src="kou/load/waitMe.js"></script>
    <script type="text/javascript" src="kou/js/jquery.uploadfile.min.js"></script>
    <script type="text/javascript" src="kou/js/jquery.multi-select.js"></script>



          <!-- Add mousewheel plugin (this is optional) -->
  <script type="text/javascript" src="kou/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>

  <!-- Add fancyBox main JS and CSS files -->
  <script type="text/javascript" src="kou/fancybox/source/jquery.fancybox.js?v=2.1.5"></script>

  <!-- Add Button helper (this is optional) -->
  <script type="text/javascript" src="kou/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>

  <!-- Add Thumbnail helper (this is optional) -->
  <script type="text/javascript" src="kou/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

  <!-- Add Media helper (this is optional) -->
  <script type="text/javascript" src="kou/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

   <script src="kou/image-picker/image-picker.js" type="text/javascript"></script>
    <script type="text/javascript" src="kou/js/global_kont.js"></script>


    <script type="text/javascript" src="kou/page_js/<?php echo $page.".js"; ?>"></script>


     <script>
      $(function () {
        $("#table_list").DataTable();
      });
    </script>
    
    <script type="text/javascript">
        <?php
                if(!isset($page))
                    echo "page_go('ana_panel');";
                else
                    echo "page_go('".$page."');";
                 
         ?>
    </script>
    

  </body>
</html>
