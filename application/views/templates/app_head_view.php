<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <title>Fluent Inventory</title>
      <!-- BOOTSTRAP  -->
      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css" />
      <!-- FONT AWESOME -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" media="screen" title="no title" charset="utf-8">
      <!-- Ionicons -->
      <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/skin-blue.min.css">
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/morris/morris.css">
      <!-- JQUERY -->
      <!-- <script src="<?php echo base_url(); ?>assets/js/jquery.js"></script> -->
     <!-- SKRIPTE  -->
      <?php
          if(isset($header_scripts)){
              foreach ($header_scripts as $js) {
                  echo "\t".$js."\r\n";
              }
          }
       ?>
  </head>
