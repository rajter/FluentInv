<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <p class="hidden" id="base_url"><?php echo base_url(); ?></p>

    <section class="content-header">
        <h1>
          <i class="fa fa-book"></i>
          Primke
          <small>- <?php // TODO: fali opis ?></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-ticket"></i> FluentInventory</a></li>
          <li class="active">Primke</li>
        </ol>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header">
                        <!-- <h3 class="box-title"><i class="fa fa-ticket"></i> Primke</h3> -->
                        <a href=<?php echo current_url().'/newReceipt' ?> class="btn btn-primary"><i class="fa fa-plus"></i> Nova Primka</a>
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <table id="receipts_table" class="table table-bordered table-hover table-striped" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width: 100px"><i class="fa fa-file-o"></i> Broj</th>
                                        <th><i class="fa fa-user"></i> Korisnik</th>
                                        <th><i class="fa fa-address-card-o"></i> Klijent</th>
                                        <th><i class="fa fa-map-marker"></i> Lokacija</th>
                                        <th style="width: 200px"><i class="fa fa-calendar"></i> Datum</th>
                                        <th style="width: 200px"><i class="fa fa-gears"></i> Opcije</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($query as $trans): ?>
                                        <tr id=<?php echo "receipt-row-".$trans->transaction_number; ?>>
                                            <td><?php echo $trans->transaction_number; ?></td>
                                            <td><?php echo $trans->user; ?></td>
                                            <td><?php echo $trans->client; ?></td>
                                            <td><?php echo $trans->location; ?></td>
                                            <td><?php echo $trans->date; ?></td>
                                            <td>
                                                <div class="btn-group btn-group-xs">
                                                    <a href=<?php echo current_url().'/view/'.$trans->transaction_number; ?> data-toggle="modal"
                                                        type="button" class="btn btn-info"><i class="fa fa-search"></i> Pregled</a>
                                                    <a href=<?php echo current_url().'/edit/'.$trans->transaction_number; ?> type="button" class="btn btn-primary"><i class="fa fa-edit"></i> Uredi</a>
                                                    <button type="button" class="btn btn-danger receipt_modal_delete" data=<?php echo $trans->transaction_number; ?>>
                                                        <i class="fa fa-trash-o"></i> Obriši</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                            </table>
                            <?php
                              $attributes = array('id' => 'ajaxform');
                              echo form_open('', $attributes);
                              echo form_close();
                            ?>
                        </div>

                        <!-- <div class="col-md-4">
                            <div class="box box-solid" style="margin-top: 25px;">
                                <div class="box-header">
                                    <h3 class="box-titles" id="receipt-number"></h3>
                                    <table class="table table-bordered table-condensed table-hover">
                                        <thead>
                                            <th>#</th>
                                            <th>Ime</th>s
                                            <th>Kod</th>
                                            <th>Kol</th>
                                        </thead>
                                        <tbody id="info-table-body">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> -->

                    </div><!--box body-->
                </div><!--box-->
            </div><!--col-md-12-->
        </div><!--row-->


    </section>

</div>
