 <body class="hold-transition skin-blue sidebar-mini">

   <div class="wrapper">

     <!-- Main Header -->
     <header class="main-header">

       <!-- Logo -->
       <a href="#" class="logo">
         <!-- mini logo for sidebar mini 50x50 pixels -->
         <span class="logo-mini"><b>T</b> T</span>
         <!-- logo for regular state and mobile devices -->
         <span class="logo-lg"><b>Log</b>Track</span>
       </a>

       <!-- Header Navbar -->
       <nav class="navbar navbar-static-top" role="navigation">
         <!-- Sidebar toggle button-->
         <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
           <span class="sr-only">Toggle navigation</span>
         </a>
         <!-- Navbar Right Menu -->
         <div class="navbar-custom-menu">
           <ul class="nav navbar-nav">
             <!-- Messages: style can be found in dropdown.less-->
             <li class="dropdown messages-menu">
               <!-- Menu toggle button -->
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                 <i class="fa fa-envelope-o"></i>
                 <span class="label label-success">4</span>
               </a>
               <ul class="dropdown-menu">
                 <li class="header">Imate 4 poruke</li>
                 <li>
                   <!-- inner menu: contains the messages -->
                   <ul class="menu">
                     <li><!-- start message -->
                       <a href="#">
                         <div class="pull-left">
                           <!-- User Image -->
                           <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                         </div>
                         <!-- Message title and timestamp -->
                         <h4>
                           Support Team
                           <small><i class="fa fa-clock-o"></i> 5 mins</small>
                         </h4>
                         <!-- The message -->
                         <p>Why not buy a new awesome theme?</p>
                       </a>
                     </li><!-- end message -->
                   </ul><!-- /.menu -->
                 </li>
                 <li class="footer"><a href="#">Pogledajte sve poruke</a></li>
               </ul>
             </li><!-- /.messages-menu -->
             <!-- Notifications Menu -->
             <li class="dropdown notifications-menu">
               <!-- Menu toggle button -->
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                 <i class="fa fa-bell-o"></i>
                 <span class="label label-warning">10</span>
               </a>
               <ul class="dropdown-menu">
                 <li class="header">Imate 0 obavijesti</li>
                 <li>
                   <!-- Inner Menu: contains the notifications -->
                   <ul class="menu">
                     <li><!-- start notification -->
                       <a href="#">
                         <i class="fa fa-users text-aqua"></i> Obavijest
                       </a>
                     </li><!-- end notification -->
                   </ul>
                 </li>
                 <li class="footer"><a href="#">Pogledaj sve obavijesti</a></li>
               </ul>
             </li>

             <!-- User Account Menu -->
             <li class="dropdown user user-menu">
               <!-- Menu Toggle Button -->
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                 <!-- The user image in the navbar-->
                 <img src="<?php echo base_url(); ?>assets/dist/img/avatar.png" class="user-image" alt="User Image">
                 <!-- hidden-xs hides the username on small devices so only the image appears. -->
                 <span class="hidden-xs"><?php echo $username; ?></span>
               </a>
               <ul class="dropdown-menu">
                 <!-- The user image in the menu -->
                 <li class="user-header">
                   <img src="<?php echo base_url(); ?>assets/dist/img/avatar.png" class="img-circle" alt="User Image">
                   <p>
                     <?php echo $username; ?>
                     <small>Zaposlen od 2016</small>
                   </p>
                 </li>
                 <!-- Menu Footer-->
                 <li class="user-footer">
                   <div class="pull-left">
                     <a href="#" class="btn btn-default btn-flat">Profil</a>
                   </div>
                   <div class="pull-right">
                     <a href="home/logout" class="btn btn-default btn-flat">Odlogiraj</a>
                   </div>
                 </li>
               </ul>
             </li>
             <!-- Control Sidebar Toggle Button -->
             <li>
               <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
             </li>
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
             <img src="<?php echo base_url(); ?>assets/dist/img/avatar.png" class="img-circle" alt="Admin Image">
           </div>
           <div class="pull-left info">
             <p>Username</p>
             <!-- Status -->
             <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
           </div>
         </div>

         <!-- search form (Optional) -->
         <!-- <form action="#" method="get" class="sidebar-form">
           <div class="input-group">
             <input type="text" name="q" class="form-control" placeholder="Search...">
             <span class="input-group-btn">
               <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
             </span>
           </div>
         </form> -->
         <!-- /.search form -->

         <!-- Sidebar Menu -->
         <ul class="sidebar-menu">
           <li class="header">MENI</li>
           <!-- Optionally, you can add icons to the links -->
           <li class="active">
             <a href="#"><i class="fa fa-dashboard">
             </i> <span>Kontrolna ploča</span>
             </a>
           </li>
           <li class="treeview">
             <a href="#"><i class="fa fa-wrench"></i> <span>Uređaji</span> <i class="fa fa-angle-left pull-right"></i></a>
             <ul class="treeview-menu">
               <li><a href="#">Svi uređaji</a></li>
               <li><a href="#">Slobodni uređaji</a></li>
               <li><a href="#">Zaduženi uređaji</a></li>
             </ul>
           </li>
           <li>
             <a href="#">
               <i class="fa fa-ticket"></i>
               <span>Zaduženja</span>
             </a>
           </li>
           <li>
             <a href="#">
               <i class="fa fa-backward"></i>
               <span>Vraćeno</span>
             </a>
           </li>
           <li>
             <a href="#">
               <i class="fa fa-list"></i>
               <span>Inventura</span>
             </a>
           </li>
           <li>
             <a href="#">
               <i class="fa fa-users"></i>
               <span>Zaposlenici</span>
             </a>
           </li>
         </ul><!-- /.sidebar-menu -->
       </section>
       <!-- /.sidebar -->
     </aside>

     <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper">

       <section class="content-header">
       </section>

       <section class="content">
       </section>
     </div>

     <!-- Main Footer -->
     <footer class="main-footer">
       <!-- To the right -->
       <div class="pull-right hidden-xs">
         <b>Tool</b> Tracker
       </div>
       <!-- Default to the left -->
       <strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.
     </footer>

     <!-- Control Sidebar -->
     <aside class="control-sidebar control-sidebar-dark">
       <!-- Create the tabs -->
       <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
         <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
         <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
       </ul>
       <!-- Tab panes -->
       <div class="tab-content">
         <!-- Home tab content -->
         <div class="tab-pane active" id="control-sidebar-home-tab">
           <h3 class="control-sidebar-heading">Recent Activity</h3>
           <ul class="control-sidebar-menu">
             <li>
               <a href="javascript::;">
                 <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                 <div class="menu-info">
                   <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                   <p>Will be 23 on April 24th</p>
                 </div>
               </a>
             </li>
           </ul><!-- /.control-sidebar-menu -->

           <h3 class="control-sidebar-heading">Tasks Progress</h3>
           <ul class="control-sidebar-menu">
             <li>
               <a href="javascript::;">
                 <h4 class="control-sidebar-subheading">
                   Custom Template Design
                   <span class="label label-danger pull-right">70%</span>
                 </h4>
                 <div class="progress progress-xxs">
                   <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                 </div>
               </a>
             </li>
           </ul><!-- /.control-sidebar-menu -->

         </div><!-- /.tab-pane -->
         <!-- Stats tab content -->
         <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
         <!-- Settings tab content -->
         <div class="tab-pane" id="control-sidebar-settings-tab">
           <form method="post">
             <h3 class="control-sidebar-heading">General Settings</h3>
             <div class="form-group">
               <label class="control-sidebar-subheading">
                 Report panel usage
                 <input type="checkbox" class="pull-right" checked>
               </label>
               <p>
                 Some information about this general settings option
               </p>
             </div><!-- /.form-group -->
           </form>
         </div><!-- /.tab-pane -->
       </div>
     </aside><!-- /.control-sidebar -->
     <!-- Add the sidebar's background. This div must be placed
          immediately after the control sidebar -->
     <div class="control-sidebar-bg"></div>
   </div><!-- ./wrapper -->

   <!-- REQUIRED JS SCRIPTS -->


   <!-- Bootstrap 3.3.5 -->
   <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
   <!-- AdminLTE App -->
   <script src="<?php echo base_url(); ?>assets/dist/js/app.min.js"></script>


   <!-- Optionally, you can add Slimscroll and FastClick plugins.
        Both of these plugins are recommended to enhance the
        user experience. Slimscroll is required when using the
        fixed layout. -->
 </body>

</html>
