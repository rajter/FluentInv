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
                        <?php echo form_open('stockTakings/finishLock'); ?>
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
                                                <td class="text-center real-qnt" id=<?php echo "real-qnt-".$item->id; ?> data-id=<?php echo $item->id; ?>>
                                                    <label class="label label-primary"><strong><?php echo $itemCorrectionStocks[$i]->quantity; ?></strong></label>
                                                </td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                            </div>
                        </div>

                        <div class="box-footer with-border">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="box box-default">
                                        <div class="box-body">
                                            <strong><i class="fa fa-info"></i> Bitna napomena</strong>
                                            <p>
                                                Zaključavanjem inventure nije više moguće mjenjati inventurnu listu niti obrisati inventuru.
                                            </p>
                                            <hr>
                                            <button class="btn btn-danger btn-block" id="lock_btn" type="submit"> Zakljucaj </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div><!--box body-->
                </div><!--box-->

            </div><!--col-md-12-->
        </div><!--row-->

    </section>

</div>
