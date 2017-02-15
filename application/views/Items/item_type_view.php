<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
          Tipovi artikala
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-tags"></i> LogTrack</a></li>
          <li class="active">Tipovi artikala</li>
        </ol>
    </section>

    <section class="content">
        <p class="hidden" id="base_url"><?php echo base_url(); ?></p>

        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header">
                        <!-- <h3 class="box-title"><i class="fa fa-tags"></i> Tipovi artikala</h3> -->
                        <a href=<?php echo current_url().'/newItemType' ?> class="btn btn-primary"><i class="fa fa-plus"></i> Novi Tip</a>
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <table id="receipts_table" class="table table-bordered table-hover table-striped" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width: 50px"><i class="fa fa-info"></i> ID</th>
                                        <th style="width: 350px"><i class="fa fa-book"></i> Ime</th>
                                        <th><i class="fa fa-binoculars"></i> Opis</th>
                                        <th style="width: 150px"><i class="fa fa-gears"></i> Opcije</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($item_types as $type): ?>
                                    <tr id=<?php echo 'item-type-'.$type->id; ?>>
                                        <td><?php echo $type->id; ?></td>
                                        <td><?php echo $type->name; ?></td>
                                        <td><?php echo $type->description; ?></td>
                                        <td>
                                            <div class="btn-group btn-group-xs">
                                                <a href=<?php echo current_url().'/editItemType/'.$type->id; ?> type="button" class="btn btn-primary"><i class="fa fa-edit"></i> Uredi</a>
                                                <button type="button" class="btn btn-danger item_type_modal_delete" id=<?php echo 'type-'.$type->id  ?>>
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
