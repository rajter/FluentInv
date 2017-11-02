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
                                    <h3 class="description-header"><?php echo substr($item->description, 0, 50); ?></h3>
                                    <span class="description-text">OPIS</span>
                                  </div>
                                  <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 border-right">
                                  <div class="description-block">
                                    <h5 class="description-header">1</h5>
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
                                        <?php if($item->item_status_id == 3): ?>
                                            <button class="btn btn-xs btn-success pull-right" id="btn-change-item-status" type="button" name="button" data-item-id="<?php echo $item->id; ?>"
                                                    data-toggle="tooltip" data-placement="bottom" data-original-title="Promjeni status"><i class="fa fa-refresh"></i> </button>
                                        <?php endif;  ?>
                                        <span <?php
                                                          if($item->status == 'Slobodan'){
                                                              echo "class='label label-success pull-right'";
                                                          }
                                                          elseif($item->status == 'Zauzet'){
                                                              echo "class='label label-warning pull-right'";
                                                          }
                                                          else {
                                                              echo "class='label label-danger pull-right' style='margin-right: 5px;'";
                                                          }
                                                  ?>><?php echo $item->status; ?></span>
                                    </a></li>
                                    <!-- <li><a href="#"><i class="fa fa-map-pin"></i> Lokacija <span class="label label-primary pull-right"><?php echo $item->location; ?></span></a></li> -->
                                    <li><a href="#"><i class="fa fa-money"></i> Cijena <span class="label label-info pull-right"><?php echo $item->price; ?> kn</span></a></li>
                                    <li><a href="#"><i class="fa fa-barcode"></i> Kod <span class="label label-default pull-right"><?php echo $item->code; ?></span></a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-warning">
                            <div class="box-header with-border">
                                <h3 class="box-title">Duznici</h3>
                            </div>
                            <?php if(count($debtor) != NULL){ ?>
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <thead>
                                            <th><i class="fa fa-info"></i> ID</th>
                                            <th style="width: 75px"><i class="fa fa-image"></i> Slika</th>
                                            <th><i class="fa fa-user"></i> Ime</th>
                                            <th><i class="fa fa-user-o"></i> Prezime</th>
                                            <th>Datum Zaduženja</th>
                                            <th>Rok vraćanja</th>
                                            <th>ID Trans</th>
                                        </thead>
                                        <tbody>
                                            <td>
                                                <?php echo $debtor->id; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if(!empty($debtor->image)){ ?>
                                                    <img class="img img-responsive center-block" style="width: 75px; " id="image"
                                                    <?php
                                                    echo "src=".base_url()."assets/dropzone/uploads/".$debtor->image;
                                                    ?>>
                                                    <?php }else {?>
                                                        <i class="fa fa-ban"></i>
                                                        <?php }; ?>
                                                    </td>
                                                    <td><?php echo $debtor->name; ?></td>
                                                    <td><?php echo $debtor->surname; ?></td>
                                                    <td><?php echo $debtor->DateTaken; ?></td>
                                                    <td><?php echo $debtor->Deadline; ?></td>
                                                    <td><?php echo $debtor->TransNumber; ?></td>
                                                </tbody>
                                            </table>
                                        </div>
                            <?php  } else { ?>
                                <div class="box-body">
                                    <p class="label label-success">Nema dužnika. Artikl je slobodan.</p>
                                </div>
                            <?php  } ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <!-- <?php echo var_dump($transactions); ?> -->
                        <!-- <?php var_dump($item); ?> -->
                </div>

            </div><!--col-md-6-->

        </div><!--row-->

    </section>

</div>
