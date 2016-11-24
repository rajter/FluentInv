<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
          Nova Primka
          <small><?php // TODO: fali opis ?></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-ticket"></i> Fluent Inventory</a></li>
          <li class="active">Nova Primka</li>
        </ol>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title"><i class="fa fa-ticket"></i> Nova Primka</h3>
                    </div>
                    <div class="box-body">
                    <?php echo form_open('receipts/Create'); ?>
                        <div class="row">

                            <div class="col-md-6">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Datum:</label>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input class="form-control pull-right" id="datepicker" type="text" name="date"
                                                value=<?php echo date('Y-m-d'); ?>>
                                            </div>
                                            <!-- /.input group -->
                                        </div>

                                        <div class="form-group">
                                            <label>Lokacija:</label>
                                            <select  class="form-control" name="location">
                                                <?php foreach ($locations as $location) {?>
                                                    <option value=<?php echo $location->id; ?>><?php echo $location->name;?></option>
                                                    <?php } ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Dobavljač:</label>
                                            <select  class="form-control" name="client">
                                                <?php foreach ($clients as $client) {?>
                                                    <option value=<?php echo $client->id; ?>><?php echo $client->name;?></option>
                                                    <?php } ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Napomena:</label>
                                            <textarea class="form-control" id="footnote" placeholder="Tekst Napomene"></textarea>
                                            <textarea id="hidden-footnote" name="footnote" rows="8" cols="40" class="hidden"></textarea>
                                        </div>

                                    </div>
                                </div><!--row-->


                            </div>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box-header">
                                            <h3 class="box-title"><i class="fa fa-ticket"></i> Artikli</h4>
                                        </div>
                                        <table id="items_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th style="width: 75px">ID</th>
                                                    <th>Ime</th>
                                                    <th>Opis</th>
                                                    <th>Tip</th>
                                                    <th>Kod</th>
                                                    <th>Kol</th>
                                                </tr>
                                            </thead>
                                            <p class="hidden" id="base_url"><?php echo base_url(); ?></p>
                                            <tbody id="selected_items_table_body">

                                            </tbody>
                                        </table>
                                        <a href="#modal_add_item" data-toggle="modal"
                                        data-id=""
                                        type="button" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Dodaj Artikl</a>
                                        <br><br>
                                    </div>
                                    <div class="col-md-12" id="hidden_id"></div>
                                </div><!--row-->
                            </div>
                        </div>

                        <div class="box-footer with-border">
                            <button class="btn btn-primary" id="kreiraj_btn" type="submit"> Kreiraj </button>
                        </div>
                    </form>
                    </div><!--box body-->
                </div><!--box-->
            </div><!--col-md-12-->
        </div><!--row-->

        <div class="row">
          <div class="modal fade" id="modal_add_item" role="dialog">
            <div class="modal-dialog modal-lg">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Popis Artikli</h4>
                </div>
                <div class="modal-body">
                  <table id="add_items_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                              <thead>
                                  <tr>
                                      <th>ID</th>
                                      <th>Ime</th>
                                      <th>Opis</th>
                                      <th>Tip</th>
                                      <th>Kod</th>
                                      <!-- <th style="width: 20px;">Oznaci</th> -->
                                      <th>Kol</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php foreach ($query as $item): ?>
                                      <tr class="item_row">
                                        <td id="item_id"><?php echo $item->id; ?></td>
                                        <td id="item_name"><?php echo $item->name; ?></td>
                                        <td id="item_description"><?php echo $item->description; ?></td>
                                        <td id="item_type"><?php echo $item->type; ?></td>
                                        <td id="item_code"><?php echo $item->code; ?></td>
                                        <!-- <td id="item_selected">
                                            <input class="item_chkbox" type="checkbox"
                                            id=<?php echo $item->id; ?>
                                            code=<?php echo $item->code; ?>>
                                        </td> -->
                                        <td id="item_qnt">
                                            <input class="item_quantity" type="number" min="0" step="1" id=<?php echo $item->id; ?> value="0" style="width: 75px;"
                                            qnt=""></td>
                                        </td>
                                      </tr>
                                  <?php endforeach; ?>
                              </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                  <?php
                    $attributes = array('id' => 'ajaxform');
                    echo form_open('', $attributes);
                    echo form_close();
                  ?>
                  <?php echo $this->security->get_csrf_token_name(); ?>
                  <?php echo $this->security->get_csrf_hash(); ?>
                    <input id="id" type="hidden" name="id" value="">
                    <button type="button" class="btn btn-primary " data-dismiss="modal" name="button" id="dodaj_btn">Dodaj</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </form>
                </div>
              </div>

            </div>
          </div>
        </div>


    </section>

</div>
