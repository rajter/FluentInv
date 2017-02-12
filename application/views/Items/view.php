<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content">

        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-aqua-active">
                                <h2><i class="fa fa-tag"></i> <?php echo $item->name; ?></h2>
                                <h5 class="widget-user-desc"><?php echo $item->description; ?></h5>
                            </div>
                            <div class="widget-user-image">
                                <img class="img-circle"
                                <?php
                                if($item->image == NULL){
                                    echo "src=''";
                                }else{
                                    echo "src=".base_url()."assets/dropzone/uploads/".$item->image;
                                }
                                ?> alt="slika artikla">
                            </div>
                            <div class="box-footer">
                              <div class="row">
                                <div class="col-sm-4 border-right">
                                  <div class="description-block">
                                    <h3 class="description-header"><?php echo $totalQuantity; ?></h3>
                                    <span class="description-text">KOMADA</span>
                                  </div>
                                  <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 border-right">
                                  <div class="description-block">
                                    <h5 class="description-header"><?php echo $totalTransactions; ?></h5>
                                    <span class="description-text">TRANSAKCIJA</span>
                                  </div>
                                  <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4">
                                  <div class="description-block">
                                    <!-- <h5 class="description-header">Transakcija</h5> -->
                                    <h5 class="description-header"><?php echo $item->id; ?></h5>
                                    <span class="description-text">ID</span>
                                  </div>
                                  <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                              </div>
                              <!-- /.row -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3><i class="fa fa-edit"></i> Detalji</h3>
                                <div class="box-tools pull-right" style="margin-top: 15px;">
                                    <a class="btn btn-primary" href=<?php echo base_url(). "index.php/items/edit/". $item->id; ?>><i class="fa fa-edit"></i> Uredi</a>
                                </div>
                            </div>
                            <div class="box-body">
                                <style>
                                    .label{
                                        font-size: 100%;
                                    }
                                </style>
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="#"><i class="fa fa-gear"></i> Tip
                                      <span class="label label-primary pull-right"><?php echo $item->type; ?></span></a></li>
                                    <li><a href="#"><i class="fa fa-info"></i> Status
                                        <span <?php
                                                          if($item->status == 'dostupno'){
                                                              echo "class='label label-success pull-right'";
                                                          }
                                                          elseif($item->status == 'nedostupno'){
                                                              echo "class='label label-warning pull-right'";
                                                          }
                                                          else {
                                                              echo "class='label label-danger pull-right'";
                                                          }
                                                  ?>><?php echo $item->status; ?></span></td>
                                    </a></li>
                                    <!-- <li><a href="#"><i class="fa fa-map-pin"></i> Lokacija <span class="label label-primary pull-right"><?php echo $item->location; ?></span></a></li> -->
                                    <li><a href="#"><i class="fa fa-money"></i> Cijena <span class="label label-warning pull-right"><?php echo $item->price; ?> kn</span></a></li>
                                    <li><a href="#"><i class="fa fa-barcode"></i> Kod <span class="label label-default pull-right"><?php echo $item->code; ?></span></a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Kolicine po lokacijama</h3>
                            </div>
                            <div class="box-body table-responsive no-padding">
                                <table class="table table-hover">
                                    <thead>
                                        <th>ID</th>
                                        <th>Lokacija</th>
                                        <th>Kolicina</th>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($quantities as $location): ?>
                                            <tr>
                                                <td><?php echo $location->location_id; ?></td>
                                                <td><?php echo $location->name; ?></td>
                                                <td><?php if($location->SUM > 0)
                                                            {
                                                                echo "<span class='label label-success'>".$location->SUM."<span>";
                                                            }
                                                            else {
                                                                echo "<span class='label label-danger'>".$location->SUM."<span>";
                                                            }?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <!-- <?php echo var_dump($transactions); ?> -->
                    </div>
                </div>
                
            </div><!--col-md-6-->

            <!--TIMELINE-->
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Transakcije</h3>
                    </div>
                    <div class="box-body">
                        <ul class="timeline">
                            <?php foreach ($transactions as $transaction): ?>
                                <?php $label_color = 'blue';
                                      $label_icon = 'fa fa-arrow-left';
                                    switch($transaction->transaction_type_id)
                                    {
                                        case 1:
                                            $label_color = 'green';
                                            $label_icon = 'fa fa-arrow-left';
                                            break;
                                        case 2:
                                            $label_color = 'red';
                                            $label_icon = 'fa fa-arrow-right';
                                            break;
                                        case 3:
                                            $label_color = 'purple';
                                            $label_icon = 'fa fa-exchange';
                                            break;
                                        default:
                                            $label_color = 'green';
                                            $label_icon = 'fa fa-arrow-left';
                                    }
                                ?>
                                <li class="time-label">
                                  <span class=<?php echo "bg-".$label_color ?>>
                                    <!-- <?php echo date_format(new DateTime($transaction->date), 'd.m.Y'); ?> -->
                                    <?php echo $transaction->transaction_number;; ?>
                                  </span>
                                  <div class="btn-group">
                                      <a class="btn btn-default btn-xs"><i class="fa fa-eye"></i></a>
                                      <!-- <a class="btn btn-default btn-xs"><i class="fa fa-folder-open-o"></i></a> -->
                                  </div>
                                </li>
                                <li>
                                    <i class=<?php echo '"'. $label_icon.' bg-'.$label_color.'"' ?>></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i><?php echo date_format(new DateTime($transaction->date), 'd.m.Y. H:m'); ?></span>
                                        <!-- <h3 class="timeline-header"><?php echo "Transakcija br.".$transaction->transaction_number; ?></h3> -->
                                        <div class="timeline-body">
                                            <p>Kolicina: <?php echo $transaction->quantity; ?></p>
                                            <p>Lokacija: <?php echo $transaction->Location_IN; ?></p>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div><!--row-->



    </section>

</div>
