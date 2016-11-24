<!-- REQUIRED JS SCRIPTS -->

<!-- JQUERY -->
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/dist/js/app.min.js"></script>
<!-- MORRIS charts -->
<script src="<?php echo base_url(); ?>assets/plugins/morris/morris.min.js"></script>


<!-- SKRIPTE -->
<?php
    if(isset($footer_scripts)){
        foreach ($footer_scripts as $js) {
            echo "\t".$js."\r\n";
        }
    }
 ?>


<!-- Optionally, you can add Slimscroll and FastClick plugins.
   Both of these plugins are recommended to enhance the
   user experience. Slimscroll is required when using the
   fixed layout. -->
</body>

</html>
