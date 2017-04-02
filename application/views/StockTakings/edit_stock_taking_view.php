<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
          <i class="fa fa-map-list"></i>  Inventura
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-map-list"></i> LogTrack</a></li>
          <li class="active">Inventura</li>
        </ol>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-body">
                        <!-- <?php echo var_dump($stock_taking); ?> -->
                        <?php echo form_open('stockTakings/Update'); ?>
                        <input class="hidden" type="text" name="transaction_id" value=<?php echo $stock_taking->id; ?>>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><i class="fa fa-map-pin"></i> Lokacija:</label>
                                    <input class="form-control" type="text" name="location" value="<?php echo $stock_taking->location; ?>" readonly>
                                </div>

                                <div class="form-group">
                                    <label><i class="fa fa-calendar"></i> Datum:</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input class="form-control pull-right datepicker" id="" type="text" name="date"
                                        value=<?php echo $stock_taking->date; ?> readonly>
                                    </div>
                                    <!-- /.input group -->
                                </div>

                                <div class="form-group">
                                    <label for="stock_taking_number"><i class="fa fa-info"></i> Inventurni broj:</label>
                                    <input class="form-control" type="text" name="stock_taking_number" value=<?php echo $stock_taking->stock_taking_number; ?> readonly>
                                </div>
                            </div>
                        </div><!--row-->

                        <div class="row">
                            <div class="col-md-12">
                                    <table class="table table-hover table-striped table-condensed" id="stock-taking-table">
                                        <thead>
                                            <th>#</th>
                                            <th>Slika</th>
                                            <th>Kod</th>
                                            <th>Artikl</th>
                                            <th>Opis</th>
                                            <th>Cijena</th>
                                            <th class="text-center">Kolicina</th>
                                            <th class="text-center">Stvarna Kolicina</th>
                                            <th>Opcije</th>
                                        </thead>
                                        <tbody>
                                            <?php $i = 0; ?>
                                            <?php foreach ($itemStocks as $item): ?>
                                            <tr>
                                                <td>
                                                    <?php echo $item->item_id; ?>
                                                    <input id=<?php echo "hidden-item-id-".$item->id ?> class='hidden' name='item_id[]' value=<?php echo $item->id; ?>>
                                                </td>
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
                                                <td><?php echo substr($item->description, 0, 75)."..."; ?></td>
                                                <td><?php echo $item->price; ?> kn</td>
                                                <td class="text-center" id=<?php echo "inventory-qnt-".$item->id; ?> data-qnt=<?php echo $item->quantity;?>>
                                                    <?php
                                                        $label = "class='label label-primary'";
                                                        if($item->quantity < 0){
                                                            $label = "class='label label-danger'";
                                                        }
                                                     ?>
                                                    <span <?php echo $label; ?>><?php echo $item->quantity; ?></span>
                                                </td>
                                                <td class="text-center real-qnt" id=<?php echo "real-qnt-".$item->id; ?> data-id=<?php echo $item->id; ?>>
                                                    <strong><?php echo $itemCorrectionStocks[$i]->quantity; ?></strong>
                                                </td>
                                                <td class="item_quantity">
                                                    <button type="button" class="btn btn-xs btn-primary btn-qnt" id=<?php echo $item->id; ?>><i class="fa fa-calculator"></i> </button>
                                                    <button type="button" class="btn btn-xs btn-success btn-reset" id=<?php echo $item->id; ?>><i class="fa fa-retweet"></i> </button>
                                                    <button type="button" class="btn btn-xs btn-danger btn-write-off" id=<?php echo $item->id; ?>><i class="fa fa-ban"></i> </button>
                                                </td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                            </div>
                        </div>

                        <div class="box-footer with-border">
                            <button class="btn btn-primary" id="spremi_btn" type="submit"> Spremi </button>
                        </div>
                        <?php echo form_close(); ?>
                    </div><!--box body-->
                </div><!--box-->                
            </div><!--col-md-12-->
        </div><!--row-->

    </section>

</div>
