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
        <!-- <img class="img-responsive pull-left" width="30" height="30" src=<?php echo base_url().'assets/images/FL-icon-o.png'; ?> alt="" /> -->
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
                    <a href="<?php echo base_url(); ?>index.php/users/view/<?php echo $id; ?>" class="btn btn-default btn-flat">Profil</a>
                  </div>
                  <div class="pull-right">
                    <a href="<?php echo base_url(); ?>index.php/home/logout" class="btn btn-default btn-flat">Odlogiraj</a>
                  </div>
                </li>
              </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->
            <!-- <li>
              <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
            </li> -->
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
          <li>
            <a href="<?php echo base_url(); ?>index.php/items">
              <i class="fa fa-tags"></i>
              <span>Artikli</span>
            </a>
          </li>
          <!-- <li class="treeview">
            <!-- <a href="#"><i class="fa fa-tags"></i> <span>Artikli</span> <i class="fa fa-angle-left pull-right"></i></a> -->
            <!-- <ul class="treeview-menu"> -->
              <!-- <li><a href="<?php echo base_url(); ?>index.php/items"><i class="fa fa-check"></i>Artikli na skladištu</a></li>
              <li><a href="<?php echo base_url(); ?>index.php/items"><i class="fa fa-ban"></i>Izdani artikli</a></li> -->
            <!-- </ul>
          </li> -->
          <li class="treeview">
            <a href="#"><i class="fa fa-archive"></i> <span>Dokumenti</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <li><a href="<?php echo base_url(); ?>index.php/Deposits"><i class="fa fa-book"></i>Polozi</a></li>
              <li><a href="<?php echo base_url(); ?>index.php/Issues"><i class="fa fa-external-link"></i>Izdatnice</a></li>
              <li><a href="<?php echo base_url(); ?>index.php/Receipts"><i class="fa fa-reply"></i>Povratnice</a></li>
              <li><a href="<?php echo base_url(); ?>index.php/Transfers"><i class="fa fa-exchange"></i>Međuskladišnica</a></li>
              <li><a href="<?php echo base_url(); ?>index.php/stocks/viewStocks/1"><i class="fa fa-bar-chart"></i>Stanje Zaliha</a></li>
            </ul>
          </li>
          <li>
            <a href="<?php echo base_url(); ?>index.php/stockTakings">
              <i class="fa fa-list"></i>
              <span>Inventura</span>
            </a>
          </li>
          <!--SIFRARNICI-->
          <li class="treeview">
              <a href="#"><i class="fa fa-database"></i> <span>Šifrarnici</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                  <li><a href=<?php echo base_url()."index.php/itemTypes"; ?> ><i class="fa fa-tags"></i> Tipovi Artikala</a></li>
                  <li><a href=<?php echo base_url()."index.php/clients"; ?> ><i class="fa fa-user"></i> Klijenti</a></li>
                  <li><a href=<?php echo base_url()."index.php/warehouses"; ?> ><i class="fa fa-map-pin"></i> Skladišta</a></li>
              </ul>
          </li>
          <!--LJUDSKI RESURSI-->
          <li class="treeview">
            <a href="#"><i class="fa fa-users"></i> <span>Ljudski resursi</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                <!-- <li><a href="<?php echo base_url(); ?>index.php/administrators"><i class="fa fa-user-plus"></i><span>Administratori</span></a></li> -->
                <li><a href="<?php echo base_url(); ?>index.php/users"><i class="fa fa-user"></i><span>Korisnici</span></a></li>
            </ul>
          </li>
          <li>
            <a href="<?php echo base_url(); ?>index.php/company">
              <i class="fa fa-bank"></i>
              <span>Poduzeće</span>
            </a>
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
