<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <p class="hidden" id="base_url"><?php echo base_url(); ?></p>

    <section class="content-header">
        <h1>
          <i class="fa fa-list"></i>
          Inventure
          <small><?php // TODO: fali opis ?></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-ticket"></i> FluentInventory</a></li>
          <li class="active">Inventure</li>
        </ol>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header">
                        <!-- <h3 class="box-title"><i class="fa fa-ticket"></i> Primke</h3> -->
                        <a href=<?php echo current_url().'/newStockTaking' ?> class="btn btn-primary"><i class="fa fa-plus"></i> Nova Inventura</a>
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <table id="stock_takings_table" class="table table-bordered table-hover table-striped" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width: 50px"><i class="fa fa-info"></i> ID</th>
                                        <th style="width: 200px"><i class="fa fa-file-o"></i> Broj Inventure</th>
                                        <th><i class="fa fa-user"></i> Korisnik</th>
                                        <th><i class="fa fa-map-marker"></i> Lokacija</th>
                                        <th style="width: 200px"><i class="fa fa-calendar"></i> Datum</th>
                                        <th style="width: 100px"><i class="fa fa-lock"></i> Status</th>
                                        <th style="width: 250px"><i class="fa fa-gears"></i> Opcije</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- <?php echo var_dump($stock_takings); ?> -->

                                    <?php foreach ($stock_takings as $st): ?>
                                        <?php $disabled = '';
                                            if($st->status=='1')
                                            {
                                                $disabled = "disabled";
                                            }?>
                                        <tr id=<?php echo "stock_taking-row-".$st->id; ?>>
                                            <td><?php echo $st->id; ?></td>
                                            <td><?php echo $st->stock_taking_number; ?></td>
                                            <td><?php echo $st->user; ?></td>
                                            <td><?php echo $st->location; ?></td>
                                            <td><?php echo $st->date; ?></td>
                                            <td>
                                                <?php if($st->status==0)
                                                {
                                                    echo "<label class='label label-primary'>U obradi</label>";
                                                }
                                                else
                                                {
                                                    echo "<label class='label label-danger'>Zaključana</label>";
                                                }
                                                ?>

                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-xs">
                                                    <a href=<?php echo current_url().'/printStockTaking/'.$st->id; ?> data-toggle="modal"
                                                        type="button" class="btn btn-default"><i class="fa fa-print"></i> Ispis</a>
                                                    <a href=<?php echo current_url().'/lock/'.$st->id; ?> data-toggle="modal"
                                                        type="button" class="<?php echo 'btn btn-warning '.$disabled; ?>"><i class="fa fa-lock"></i> Zaključaj</a>
                                                    <a href=<?php echo current_url().'/edit/'.$st->id; ?> type="button" class="<?php echo 'btn btn-primary '.$disabled; ?>"><i class="fa fa-edit"></i> Uredi</a>
                                                    <button type="button" class="btn btn-danger stock_taking_modal_delete" data-id=<?php echo $st->id; ?> data-inv-number=<?php echo $st->stock_taking_number; ?>>
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

                    </div><!--box body-->
                </div><!--box-->
            </div><!--col-md-12-->
        </div><!--row-->


    </section>

</div>
