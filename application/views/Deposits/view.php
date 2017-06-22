<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content">
        <section class="content-header">
            <h1>
                <i class="fa fa-book"></i>
                Polog
                <small> <?php echo "#".$deposit[0]->transaction_number; ?></small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> FluentInventory</a></li>
              <li class="active">Template</li>
            </ol>
        </section>

        <section class="invoice">
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        <i class="fa fa-globe"></i> <?php echo $company[0]->name; ?>
                        <small class="pull-right">Datum: <?php echo $deposit[0]->date; ?></small>
                        <small><?php echo $company[0]->address; ?></small>
                        <small><?php echo $company[0]->city.", ".$company[0]->zipcode; ?></small>
                    </h2>
                </div><!-- /.col -->
            </div>


            <div class="row invoice-info">
                <div class="col-sm-8 invoice-col">
                    <br>
                    <!-- <?php echo var_dump($deposit); ?> -->
                    <address>
                        <strong><?php echo $deposit[0]->location; ?></strong><br>
                        <?php echo $deposit[0]->description; ?><br>
                        <?php echo $deposit[0]->address; ?><br>
                        <?php echo $deposit[0]->city.", ".$deposit[0]->zipcode; ?><br>
                        <!-- Tel: <?php echo $deposit[0]->tel; ?><br>
                        Email: <?php echo $deposit[0]->email; ?> -->
                    </address>
                </div><!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <h3>Polog: <strong><?php echo $deposit[0]->transaction_number; ?></strong></h3>
                    <b>Datum:</b> <?php echo $deposit[0]->date; ?><br>
                </div><!-- /.col -->
            </div>

            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <th style="width: 40px;">#</th>
                            <th style="width: 50px;">Slika</th>
                            <th>Kol</th>
                            <th>Ime</th>
                            <th>Opis</th>
                            <th>Kod</th>
                            <th>Cijena</th>
                        </thead>
                        <tbody>
                            <?php $totalPrice = 0; ?>
                            <?php $totalQuantity = 0; ?>
                            <?php foreach ($depositData as $key=>$item): ?> <!-- $key je index -->
                                <?php $totalPrice += $item->price * $item->quantity; ?>
                                <?php $totalQuantity += $item->quantity; ?>
                                <tr>
                                    <!-- <td><?php echo $key+1; ?></td> -->
                                    <td><?php echo $item->id; ?></td>
                                    <td class="text-center">
                                        <?php if(!empty($item->image)){ ?>
                                              <img class="img img-responsive center-block" style="width: 40px; " id="image"
                                              <?php
                                              echo "src=".base_url()."assets/dropzone/uploads/".$item->image;
                                              ?>>
                                        <?php }else {?>
                                              <i class="fa fa-ban"></i>
                                        <?php }; ?>
                                    </td>
                                    <td>
                                        <?php
                                        $max = (int)$maxQuantity[0]->quantity;
                                        $qnt = (int)$item->quantity;
                                        $percent =round($qnt/$max,3) * 100;
                                        ?>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100"
                                            style="<?php echo "min-width: 1em; width: ".$percent."%;" ?>">
                                            <?php echo $item->quantity; ?>
                                        </div>
                                    </div>
                                    <!-- <?php echo $percent; ?> -->
                                </td>
                                    <td><?php echo $item->name; ?></td>
                                    <td><?php echo substr($item->description, 0, 100)."..."; ?></td>
                                    <td><?php echo $item->code; ?></td>
                                    <td><?php echo $item->price; ?> kn</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div><!-- row -->

            <div class="row">
                <div class="col-xs-6">
                    <h2>Napomena:</h2>
                    <div class="well well-sm text-muted">
                        <?php echo $deposit[0]->footnote; ?>
                    </div>
                </div>
                <div class="col-xs-5 col-xs-offset-1">
                    <p class="lead">UKUPNO</p>
                    <div class="table responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Kolicina:</th>
                                    <td><?php echo $totalQuantity ?></td>
                                </tr>
                                <tr>
                                    <th>Ukupno:</th>
                                    <td><?php echo $totalPrice; ?> kn</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row no-print">
                <div class="col-xs-12">
                    <a href=<?php echo base_url().'index.php/Deposits/edit/'.$deposit[0]->transaction_number; ?> class="btn btn-success"><i class="fa fa-edit"></i> Uredi</a>
                    <a href=<?php echo base_url().'index.php/Deposits/generatePDF/'.$deposit[0]->transaction_number; ?>
                        class="btn btn-primary pull-right"><i class="fa fa-download"></i> Generiraj PDF</a>
                    <a href=<?php echo base_url().'index.php/Deposits/printDeposit/'.$deposit[0]->transaction_number; ?>
                        target="blank" class="btn btn-default pull-right" style="margin-right: 5px;"><i class="fa fa-print"></i> Print</a>
                </div>
            </div>
        </section>
    </section>

</div>
