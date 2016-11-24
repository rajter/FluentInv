<body class="hold-transition skin-blue sidebar-mini">

  <div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

      <!-- Logo -->
      <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>F</b> I</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Fluent</b> Inventory</span>
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
                    <a href="<?php echo base_url(); ?>index.php/home/logout" class="btn btn-default btn-flat">Odlogiraj</a>
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

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
          <li class="header">MENI</li>
          <!-- Optionally, you can add icons to the links -->
          <li class="active">
            <a href="<?php echo base_url(); ?>index.php/home"><i class="fa fa-dashboard">
            </i> <span>Kontrolna ploča</span>
            </a>
          </li>
          <li class="treeview">
            <a href="#"><i class="fa fa-tags"></i> <span>Artikli</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <li><a href="<?php echo base_url(); ?>index.php/items"><i class="fa fa-tags"></i>Svi Artikli</a></li>
              <li><a href="<?php echo base_url(); ?>index.php/items"><i class="fa fa-check"></i>Artikli na skladištu</a></li>
              <li><a href="<?php echo base_url(); ?>index.php/items"><i class="fa fa-ban"></i>Izdani artikli</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#"><i class="fa fa-archive"></i> <span>Dokumenti</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <li><a href="<?php echo base_url(); ?>index.php/Receipts"><i class="fa fa-book"></i>Primke</a></li>
              <li><a href="<?php echo base_url(); ?>index.php/items"><i class="fa fa-external-link"></i>Izdatnice</a></li>
              <li><a href="<?php echo base_url(); ?>index.php/items"><i class="fa fa-exchange"></i>Međuskladišnica</a></li>
              <li><a href="<?php echo base_url(); ?>index.php/items"><i class="fa fa-ban"></i>Otpis</a></li>
              <li><a href="<?php echo base_url(); ?>index.php/items"><i class="fa fa-eraser"></i>Ispravci</a></li>
              <li><a href="<?php echo base_url(); ?>index.php/warehouse/stocks"><i class="fa fa-bar-chart"></i>Stanje Zaliha</a></li>
            </ul>
          </li>
          <li>
            <a href="#">
              <i class="fa fa-list"></i>
              <span>Inventura</span>
            </a>
          </li>
          <li class="treeview">
            <a href="#"><i class="fa fa-users"></i> <span>Ljudski resursi</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                <li>
                  <a href="#">
                    <i class="fa fa-user-plus"></i>
                    <span>Administratori</span>
                  </a>
                </li>
                <li>
                  <a href="<?php echo base_url(); ?>index.php/employees">
                    <i class="fa fa-user"></i>
                    <span>Zaposlenici</span>
                  </a>
                </li>
            </ul>
          </li>
          <li>
            <a href="<?php echo base_url(); ?>index.php/home/logout">
              <i class="fa fa-sign-out"></i>
              <span>Odjava</span>
            </a>
          </li>
        </ul><!-- /.sidebar-menu -->
      </section>
      <!-- /.sidebar -->
    </aside>
