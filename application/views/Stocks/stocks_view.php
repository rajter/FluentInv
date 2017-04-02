<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
          <i class="fa fa-bar-chart"></i> Stanje Zaliha - <strong><?php echo $locations[$this->uri->segment('3')-1]->name; ?></strong>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-ticket"></i> FluentInventory</a></li>
          <li class="active">Stanje Zaliha</li>
        </ol>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header">
                        <!-- <h1 class="box-title"><?php echo $locations[$this->uri->segment('3')+1]->name; ?></h1>
                        <button class="btn btn-primary pull-right" type="button" name="button" id="change-warehouse-btn">Promjeni Skladište</button> -->
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-5">
                                <div class="input-group margin-bottom-sm">
                                    <span class="input-group-addon"><i class="fa fa-map-pin fa-fw"></i></span>
                                    <select class="form-control" name="warehouse-select" id="stocks-warehouse-select">
                                        <?php foreach ($locations as $location) {?>
                                            <option value=<?php echo $location->id; ?>><?php echo $location->name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <p class="hidden" id="current-location"><?php echo $this->uri->segment('3'); ?></p>
                            </div>
                            <div class="col-xs-6">
                                <button class="btn btn-primary" type="button" name="button" id="stocks-refresh-btn"><i class="fa fa-refresh"></i> Osvježi</button>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tab-items" data-toggle="tab" aria-expanded="true"><i class="fa fa-tags"></i> Artikli</a></li>
                                        <li class=""><a href="#tab-stockTakings" data-toggle="tab" aria-expanded="true"><i class="fa fa-list"></i> Zadnja Inventura</a></li>
                                        <li class=""><a href="#tab-in" data-toggle="tab" aria-expanded="false"><i class="fa fa-sign-in"></i> Ulaz</a></li>
                                        <li class=""><a href="#tab-out" data-toggle="tab" aria-expanded="false"><i class="fa fa-sign-out"></i> Izlaz</a></li>
                                        <li class=""><a href="#tab-toLocationtransfer" data-toggle="tab" aria-expanded="false"><i class="fa fa-exchange"></i> Premještaj Ulaz</a></li>
                                        <li class=""><a href="#tab-fromLocationtransfer" data-toggle="tab" aria-expanded="false"><i class="fa fa-exchange"></i> Premještaj Izlaz</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab-items">
                                            <table class="table table-hover table-striped" id="stocks_table">
                                                <thead>
                                                    <th>#</th>
                                                    <th>Slika</th>
                                                    <th>Kod</th>
                                                    <th>Artikl</th>
                                                    <th>Opis</th>
                                                    <th>Cijena</th>
                                                    <th class="text-center">Kolicina</th>
                                                    <th>Ukupno</th>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($itemStocks as $item): ?>
                                                    <tr>
                                                        <td><?php echo $item->item_id; ?></td>
                                                        <td class="text-center">
                                                            <?php if(!empty($item->image)){ ?>
                                                                  <img class="img img-responsive center-block" style="width: 30px; " id="image"
                                                                  <?php
                                                                  echo "src=".base_url()."assets/dropzone/uploads/".$item->image;
                                                                  ?>>
                                                            <?php }else {?>
                                                                  <i class="fa fa-ban"></i>
                                                            <?php }; ?>
                                                        </td>
                                                        <td><?php echo $item->code; ?></td>
                                                        <td><?php echo $item->name; ?></td>
                                                        <td><?php echo substr($item->description, 0, 100)."..."; ?></td>
                                                        <td><?php echo number_format($item->price, 2, ',', '.'); ?> kn</td>
                                                        <td class="text-center">
                                                            <?php
                                                                $label = "class='label label-primary'";
                                                                if($item->quantity < 0){
                                                                    $label = "class='label label-danger'";
                                                                }
                                                             ?>
                                                            <span <?php echo $label; ?>><?php echo $item->quantity; ?></span> </td>
                                                        <td>
                                                            <?php echo number_format($item->quantity * $item->price, 2, ',', '.'); ?> kn
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="tab-pane" id="tab-stockTakings">
                                            <!-- <?php var_dump($itemStockCount); ?> -->
                                            <table class="table table-hover table-striped" id="">
                                                <thead>
                                                    <th style="width: 40px;">#</th>
                                                    <th style="width: 40px;">Slika</th>
                                                    <th style="width: 40px;">Kod</th>
                                                    <th style="width: 250px;">Artikl</th>
                                                    <th>Label</th>
                                                    <th class="text-center" style="width: 40px;">Kolicina</th>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($itemStockCount as $item): ?>
                                                    <tr>
                                                        <td><?php echo $item->item_id; ?></td>
                                                        <td class="text-center">
                                                            <?php if(!empty($item->image)){ ?>
                                                                  <img class="img img-responsive center-block" style="width: 30px; " id="image"
                                                                  <?php
                                                                  echo "src=".base_url()."assets/dropzone/uploads/".$item->image;
                                                                  ?>>
                                                            <?php }else {?>
                                                                  <i class="fa fa-ban"></i>
                                                            <?php }; ?>
                                                        </td>
                                                        <td><?php echo $item->code; ?></td>
                                                        <td><?php echo $item->name; ?></td>
                                                        <td>
                                                            <div class="progress progress-xs">
                                                                <div class="progress-bar progress-bar-blue" style=<?php echo "width:".round($item->total/$itemStockCount[0]->total, 2)*100 . "%"; ?>></div>
                                                            </div>
                                                        </td>
                                                        <td><span class="badge bg-blue"><?php echo $item->total; ?></span></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="tab-pane" id="tab-in">
                                            <!-- <?php var_dump($itemEntrance); ?> -->
                                            <table class="table table-hover table-striped" id="">
                                                <thead>
                                                    <th style="width: 40px;">#</th>
                                                    <th style="width: 40px;">Slika</th>
                                                    <th style="width: 40px;">Kod</th>
                                                    <th style="width: 250px;">Artikl</th>
                                                    <th>Label</th>
                                                    <th class="text-center" style="width: 40px;">Kolicina</th>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($itemEntrance as $item): ?>
                                                    <tr>
                                                        <td><?php echo $item->item_id; ?></td>
                                                        <td class="text-center">
                                                            <?php if(!empty($item->image)){ ?>
                                                                  <img class="img img-responsive center-block" style="width: 30px; " id="image"
                                                                  <?php
                                                                  echo "src=".base_url()."assets/dropzone/uploads/".$item->image;
                                                                  ?>>
                                                            <?php }else {?>
                                                                  <i class="fa fa-ban"></i>
                                                            <?php }; ?>
                                                        </td>
                                                        <td><?php echo $item->code; ?></td>
                                                        <td><?php echo $item->name; ?></td>
                                                        <td>
                                                            <div class="progress progress-xs">
                                                                <div class="progress-bar progress-bar-green" style=<?php echo "width:".round($item->total/$itemEntrance[0]->total, 2)*100 . "%"; ?>></div>
                                                            </div>
                                                        </td>
                                                        <td><span class="badge bg-green"><?php echo $item->total; ?></span></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="tab-pane" id="tab-out">
                                            <!-- <?php var_dump($itemExits); ?> -->
                                            <table class="table table-hover table-striped" id="">
                                                <thead>
                                                    <th style="width: 40px;">#</th>
                                                    <th style="width: 40px;">Slika</th>
                                                    <th style="width: 40px;">Kod</th>
                                                    <th style="width: 250px;">Artikl</th>
                                                    <th>Label</th>
                                                    <th class="text-center" style="width: 40px;">Kolicina</th>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($itemExits as $item): ?>
                                                    <tr>
                                                        <td><?php echo $item->item_id; ?></td>
                                                        <td class="text-center">
                                                            <?php if(!empty($item->image)){ ?>
                                                                  <img class="img img-responsive center-block" style="width: 30px; " id="image"
                                                                  <?php
                                                                  echo "src=".base_url()."assets/dropzone/uploads/".$item->image;
                                                                  ?>>
                                                            <?php }else {?>
                                                                  <i class="fa fa-ban"></i>
                                                            <?php }; ?>
                                                        </td>
                                                        <td><?php echo $item->code; ?></td>
                                                        <td><?php echo $item->name; ?></td>
                                                        <td>
                                                            <div class="progress progress-xs">
                                                                <div class="progress-bar progress-bar-red" style=<?php echo "width:".round($item->total/$itemExits[0]->total, 2)*100 . "%"; ?>></div>
                                                            </div>
                                                        </td>
                                                        <td><span class="badge bg-red">-<?php echo $item->total; ?></span></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="tab-pane" id="tab-toLocationtransfer">
                                            <!-- <?php var_dump($itemToLocationsTransfers); ?> -->
                                            <table class="table table-hover table-striped" id="">
                                                <thead>
                                                    <th style="width: 40px;">#</th>
                                                    <th style="width: 40px;">Slika</th>
                                                    <th style="width: 40px;">Kod</th>
                                                    <th style="width: 250px;">Artikl</th>
                                                    <th>Label</th>
                                                    <th class="text-center" style="width: 40px;">Kolicina</th>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($itemToLocationsTransfers as $item): ?>
                                                    <tr>
                                                        <td><?php echo $item->item_id; ?></td>
                                                        <td class="text-center">
                                                            <?php if(!empty($item->image)){ ?>
                                                                  <img class="img img-responsive center-block" style="width: 30px; " id="image"
                                                                  <?php
                                                                  echo "src=".base_url()."assets/dropzone/uploads/".$item->image;
                                                                  ?>>
                                                            <?php }else {?>
                                                                  <i class="fa fa-ban"></i>
                                                            <?php }; ?>
                                                        </td>
                                                        <td><?php echo $item->code; ?></td>
                                                        <td><?php echo $item->name; ?></td>
                                                        <td>
                                                            <div class="progress progress-xs">
                                                                <div class="progress-bar progress-bar-blue" style=<?php echo "width:".round($item->total/$itemToLocationsTransfers[0]->total, 2)*100 . "%"; ?>></div>
                                                            </div>
                                                        </td>
                                                        <td><span class="badge bg-blue"><?php echo $item->total; ?></span></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="tab-pane" id="tab-fromLocationtransfer">
                                            <!-- <?php var_dump($itemFromLocationsTransfers); ?> -->
                                            <table class="table table-hover table-striped" id="">
                                                <thead>
                                                    <th style="width: 40px;">#</th>
                                                    <th style="width: 40px;">Slika</th>
                                                    <th style="width: 40px;">Kod</th>
                                                    <th style="width: 250px;">Artikl</th>
                                                    <th>Label</th>
                                                    <th class="text-center" style="width: 40px;">Kolicina</th>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($itemFromLocationsTransfers as $item): ?>
                                                    <tr>
                                                        <td><?php echo $item->item_id; ?></td>
                                                        <td class="text-center">
                                                            <?php if(!empty($item->image)){ ?>
                                                                  <img class="img img-responsive center-block" style="width: 30px; " id="image"
                                                                  <?php
                                                                  echo "src=".base_url()."assets/dropzone/uploads/".$item->image;
                                                                  ?>>
                                                            <?php }else {?>
                                                                  <i class="fa fa-ban"></i>
                                                            <?php }; ?>
                                                        </td>
                                                        <td><?php echo $item->code; ?></td>
                                                        <td><?php echo $item->name; ?></td>
                                                        <td>
                                                            <div class="progress progress-xs">
                                                                <div class="progress-bar progress-bar-yellow" style=<?php echo "width:".round($item->total/$itemFromLocationsTransfers[0]->total, 2)*100 . "%"; ?>></div>
                                                            </div>
                                                        </td>
                                                        <td><span class="badge bg-yellow"><?php echo $item->total; ?></span></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div><!--row-->

                    </div><!--box body-->
                </div><!--box-->
            </div><!--col-md-12-->
        </div><!--row-->

        <!--Dialog koji se ne koristi al sam ostavio kao primjer-->
        <div class="row hidden" id="hidden-locations-select">
            <select class="form-control" name="warehouse-select" id="stocks-warehouse-select">
                <?php foreach ($locations as $location) {?>
                    <option value=<?php echo $location->id; ?>><?php echo $location->name; ?></option>
                <?php } ?>
            </select>
            <br>
            <button class="btn btn-primary" type="button" name="button" id="stocks-refresh-btn">Osvježi</button>
        </div>

    </section>

</div>
