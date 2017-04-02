<body onload="window.print();">
<!-- <body> -->

    <!-- <?php echo var_dump($stock_taking); ?> -->
    <div class="wrapper">
        <section class="invoice">
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        <i class="fa fa-globe"></i> <?php echo $company[0]->name; ?>
                        <small class="pull-right">Datum: <?php echo $stock_taking->date; ?></small>
                        <small><?php echo $company[0]->address; ?></small>
                        <small><?php echo $company[0]->city.", ".$company[0]->zipcode; ?></small>
                    </h2>
                </div><!-- /.col -->
            </div>


            <div class="row invoice-info">
                <div class="col-xs-8 invoice-col">
                    <h3>INVENTURA: <strong><?php echo $stock_taking->stock_taking_number; ?></strong><br></h3>
                </div><!-- /.col -->
                <div class="col-xs-4 invoice-col">
                </div><!-- /.col -->
            </div>

            <div class="row">
                <div class="col-xs-12 table-responsive">
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
            </div><!-- row -->

            <div class="row">
                <div class="col-xs-6">
                    <h2>Napomena:</h2>
                    <div class="well well-sm text-muted">
                        <?php echo $stock_taking->footnote; ?>
                    </div>
                </div>
                <div class="col-xs-5 col-xs-offset-1">

                </div>
            </div>
        </section>
    </div>
