<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title"><i class="fa fa-edit"></i> Međuskladišnica <?php echo $transfer[0]->transaction_number; ?></h3>
                    </div>
                    <div class="box-body">
                        <!-- <?php echo var_dump($transferData); ?>
                        <?php echo var_dump($transfer); ?>
                        <?php echo var_dump($query); ?> -->

                        <?php echo form_open('transfers/Update'); ?>
                            <input class="hidden" type="text" name="transaction_id" value=<?php echo $transfer[0]->trans_id; ?>>
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
                                                    <input class="form-control pull-right datepicker" id="datepicker" type="text" name="date"
                                                    value=<?php echo $transfer[0]->date; ?>>
                                                </div>
                                                <!-- /.input group -->
                                            </div>

                                            <div class="form-group">
                                                <label>Iz Lokacije:</label><p class="hidden" id="current-from-location"><?php echo $transfer[0]->from_location_id; ?></p>
                                                <select  class="form-control" name="from_location" id="from-location-select">
                                                    <?php foreach ($locations as $location) {?>
                                                        <option value=<?php echo $location->id; ?>><?php echo $location->name;?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                            <div class="form-group">
                                                <label>U Lokaciju:</label><p class="hidden" id="current-location"><?php echo $transfer[0]->location_id; ?></p>
                                                <select  class="form-control" name="location" id="location-select">
                                                    <?php foreach ($locations as $location) {?>
                                                        <option value=<?php echo $location->id; ?>><?php echo $location->name;?></option>
                                                        <?php } ?>
                                                </select>
                                            </div>


                                            <div class="form-group">
                                                <label>Dobavljač:</label><p class="hidden" id="current-client"><?php echo $transfer[0]->client_id; ?></p>
                                                <select  class="form-control" name="client" id="client-select">
                                                    <?php foreach ($clients as $client) {?>
                                                        <option value=<?php echo $client->id; ?>><?php echo $client->name;?></option>
                                                        <?php } ?>
                                                </select>
                                            </div>

                                        </div>
                                    </div><!--row-->
                                </div><!--col-md-6-->
                            </div><!--row-->

                            <div class="row">
                                <div class="col col-xs-12">
                                    <div class="box-header">
                                        <h3 class="box-title"><i class="fa fa-ticket"></i> Artikli</h4>
                                    </div>
                                    <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <th style="width: 40px;">#</th>
                                            <th style="width: 50px;">Slika</th>
                                            <th>Kol</th>
                                            <th>Ime</th>
                                            <th>Opis</th>
                                            <th>Kod</th>
                                            <th>Cijena</th>
                                        </thead>
                                        <p class="hidden" id="base_url"><?php echo base_url(); ?></p>
                                        <tbody id="selected_items_table_body">
                                            <?php $totalPrice = 0; ?>
                                            <?php $totalQuantity = 0; ?>
                                            <?php foreach ($transferData as $key=>$item): ?> <!-- $key je index -->
                                                <?php $totalPrice += $item->price * $item->quantity; ?>
                                                <?php $totalQuantity += $item->quantity; ?>
                                                <tr id=<?php echo "row-".$item->id; ?>>
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
                                                    <td class="item_quantity">
                                                        <strong id=<?php echo "qnt-".$item->id ?> style="padding-left:5px; color:blue;"><?php echo $item->quantity; ?></strong>
                                                        <div class="btn-group btn-group-sm pull-right" role="group" aria-label="..." style="margin:0px;">
                                                            <button type="button" class="btn btn-default btn-minus" id=<?php echo $item->id; ?>> - </button>
                                                            <button type="button" class="btn btn-default btn-plus" id=<?php echo $item->id; ?>> + </button>
                                                        </div>
                                                    </td>
                                                    <td><?php echo $item->name; ?></td>
                                                    <td><?php echo $item->description; ?></td>
                                                    <td><?php echo $item->code; ?></td>
                                                    <td><?php echo $item->price; ?> kn</td>
                                                    <td><button class="btn btn-danger btn-xs btn-remove" type="button" name="button" id=<?php echo $item->id; ?>><i class="fa fa-times"></i></button></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <a href="#modal_code" data-toggle="modal"
                                          type="button" class="btn btn-default"><i class="fa fa-barcode"></i>  Učitaj kod</a>

                                    <a href="#modal_add_item" data-toggle="modal"
                                    data-id=""
                                    type="button" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Dodaj Artikl</a>
                                    <br><br>

                                    <div class="form-group">
                                        <label>Napomena:</label>
                                        <textarea class="form-control" id="footnote" placeholder="Tekst Napomene"><?php echo $transfer[0]->footnote; ?></textarea>
                                        <textarea id="hidden-footnote" name="footnote" rows="8" cols="40" class="hidden"><?php echo $transfer[0]->footnote; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 hidden" id="hidden_id">
                                    <?php foreach ($transferData as $key=>$item): ?> <!-- $key je index -->
                                            <input id=<?php echo "hidden-item-id-".$item->id ?> class='' name='item_id[]' value=<?php echo $item->id; ?>>
                                            <input id=<?php echo "hidden-item-qnt-".$item->id ?> class='' name='item_qnt[]' value=<?php echo $item->quantity; ?>>
                                            <br>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <div class="box-footer with-border">
                                <button class="btn btn-primary" id="kreiraj_btn" type="submit"> Spremi </button>
                            </div>

                        <?php echo form_close(); ?>

                    </div><!--box body-->
                </div><!--box-->
            </div><!--col-md-12-->
        </div><!--row-->

        <!--**********************************************-->
        <!--MODALNI DIALOG DODAVANJA ARTIKLA CITANJEM KODA-->
        <!--**********************************************-->
        <div class="row">
          <div class="modal fade" id="modal_code" role="dialog">
            <div class="modal-dialog">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Učitaj kod</h4>
                </div>
                <div class="modal-body">
                    <p class="text-center">
                        <!-- <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
                        <span class="sr-only">Loading...</span> -->
                    </p>
                  <input class="text-center form-control" id="input-code" type="text" name="code" value=""
                        style="font-size: 50px; height: 75px;" autofocus>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </form>
                </div>
              </div>

            </div>
          </div>
        </div>

        <!--*******************************-->
        <!--MODALNI DIALOG ODABIRA ARTIKALA-->
        <!--*******************************-->
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
                  <table id="add_items_table" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                              <thead>
                                  <tr>
                                      <th>ID</th>
                                      <th>Ime</th>
                                      <th>Slika</th>
                                      <th>Opis</th>
                                      <th>Tip</th>
                                      <th>Kod</th>
                                      <th>Cijena</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php foreach ($query as $item): ?>
                                      <tr class="item_row">
                                        <td id="item_id"><?php echo $item->id; ?></td>
                                        <td id="item-image" class="text-center">
                                            <?php if(!empty($item->image)){ ?>
                                                  <img class="img img-responsive center-block" style="width: 40px; " id="image"
                                                  <?php
                                                  echo "src=".base_url()."assets/dropzone/uploads/".$item->image;
                                                  ?>>
                                            <?php }else {?>
                                                  <i class="fa fa-ban"></i>
                                            <?php }; ?>
                                        </td>
                                        <td id="item_name"><?php echo $item->name; ?></td>
                                        <td id="item_description"><?php echo substr($item->description, 0, 50); ?></td>
                                        <td id="item_type"><?php echo $item->type; ?></td>
                                        <td id="item_code"><?php echo $item->code; ?></td>
                                        <td id="item_price"><?php echo $item->price; ?></td>
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
                  <!-- <?php echo $this->security->get_csrf_token_name(); ?>
                  <?php echo $this->security->get_csrf_hash(); ?> -->
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
