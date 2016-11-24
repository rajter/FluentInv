<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
          Pregled Artikla
          <small><?php // TODO: fali opis ?></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> LogTrack</a></li>
          <li class="active">Artikli</li>
        </ol>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-aqua-active">
                      <h2><?php echo $name; ?></h2>
                      <h5 class="widget-user-desc"><?php echo $description; ?></h5>
                    </div>
                    <!-- <div class="widget-user-image">
                    </div> -->
                    <div class="box-footer">
                      <div class="row">
                        <div class="col-sm-4 border-right">
                          <div class="description-block">
                            <h5 class="description-header"></h5>
                            <span class="description-text">Kolicina</span>
                          </div>
                          <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 border-right">
                          <div class="description-block">
                            <h5 class="description-header">13,000</h5>
                            <span class="description-text">Transakcija</span>
                          </div>
                          <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4">
                          <div class="description-block">
                            <h5 class="description-header"><?php echo 'Negdje'; ?></h5>
                            <span class="description-text">Trenutna lokacija</span>
                          </div>
                          <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                    </div>
              </div>
            </div><!--col-md-12-->
        </div><!--row-->

        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3><i class="fa fa-edit"></i> Detalji</h3>
                    </div>
                    <div class="box-body">
                        <style>
                            .label{
                                font-size: 100%;
                            }
                        </style>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#"><i class="fa fa-gear"></i> Tip
                              <span class="label label-primary pull-right"><?php echo $type; ?></span></a></li>
                            <li><a href="#"><i class="fa fa-info"></i> Status
                                <span <?php
                                                  if($status == 'dostupno'){
                                                      echo "class='label label-success pull-right'";
                                                  }
                                                  elseif($status == 'nedostupno'){
                                                      echo "class='label label-warning pull-right'";
                                                  }
                                                  else {
                                                      echo "class='label label-danger pull-right'";
                                                  }
                                          ?>><?php echo $status; ?></span></td>
                            </a></li>
                            <!-- <li><a href="#"><i class="fa fa-map-pin"></i> Lokacija <span class="label label-primary pull-right"><?php echo $location; ?></span></a></li> -->
                            <li><a href="#"><i class="fa fa-money"></i> Cijena <span class="label label-warning pull-right"><?php echo $price; ?> kn</span></a></li>
                            <li><a href="#"><i class="fa fa-bar-chart"></i> Količina na skladištu <span class="label label-info pull-right"></span></a></li>
                            <li><a href="#"><i class="fa fa-barcode"></i> Kod <span class="label label-default pull-right"><?php echo $code; ?></span></a></li>
                        </ul>
                    </div>

                </div>
                <a class="btn btn-primary" href=<?php echo base_url(). "index.php/items/edit/". $id; ?>><i class="fa fa-edit"></i> Uredi</a>
            </div>

            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3><i class="fa fa-image"></i> Slika</h3>
                    </div>
                    <div class="box-body">
                        <div class="text-center">
                            <img class="img img-responsive center-block" style="width: 250px; height: 250px;"
                            <?php
                            if($image == NULL){
                                echo "src=''";
                            }else{
                                echo "src=".base_url()."assets/dropzone/uploads/".$image;
                            }
                            ?> alt="slika artikla">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

</div>
