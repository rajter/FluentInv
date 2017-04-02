<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
          Klijenti
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-users"></i> LogTrack</a></li>
          <li class="active">Klijenti</li>
        </ol>
    </section>

    <section class="content">

        <p class="hidden" id="base_url"><?php echo base_url(); ?></p>

        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header">
                        <!-- <h3 class="box-title"><i class="fa fa-tags"></i> Tipovi artikala</h3> -->
                        <a href=<?php echo current_url().'/newClient' ?> class="btn btn-primary"><i class="fa fa-plus"></i> Novi Klijent</a>
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <table id="clients_table" class="table table-bordered table-hover table-striped" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width: 50px"><i class="fa fa-info"></i> ID</th>
                                        <th style="width: 200px"><i class="fa fa-book"></i> Ime</th>
                                        <th style="width: 350px"><i class="fa fa-map-marker"></i> Adresa</th>
                                        <th><i class="fa fa-phone"></i> Tel</th>
                                        <th><i class="fa fa-fax"></i> Fax</th>
                                        <th><i class="fa fa-envelope"></i> E-mail</th>
                                        <th><i class="fa fa-key"></i> Tip</th>
                                        <th style="width: 150px"><i class="fa fa-gears"></i> Opcije</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($clients as $client): ?>
                                    <tr id=<?php echo 'client-'.$client->id; ?>>
                                        <td><?php echo $client->id; ?></td>
                                        <td><?php echo $client->name; ?></td>
                                        <td><?php echo $client->address.', '.$client->zipcode.' '.$client->city.' - '.$client->country; ?></td>
                                        <td><?php echo $client->tel; ?></td>
                                        <td><?php echo $client->fax; ?></td>
                                        <td><?php echo $client->email; ?></td>
                                        <td><?php echo $client->type; ?></td>
                                        <td>
                                            <div class="btn-group btn-group-xs">
                                                <a href=<?php echo current_url().'/edit/'.$client->id; ?> type="button" class="btn btn-primary"><i class="fa fa-edit"></i> Uredi</a>
                                                <button type="button" class="btn btn-danger client_modal_delete" id=<?php echo 'id-'.$client->id  ?> data-name="<?php echo $client->name; ?>">
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
                        <!-- <?php echo var_dump($clients) ?> -->
                    </div><!--box body-->
                </div><!--box-->
            </div><!--col-md-12-->
        </div><!--row-->


    </section>

</div>
