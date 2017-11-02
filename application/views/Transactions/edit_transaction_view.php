<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
          <i class="fa fa-book"></i>
          Transakcija
          <small><?php // TODO: fali opis ?></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-ticket"></i> Fluent Inventory</a></li>
          <li class="active">Transakcija</li>
        </ol>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-body">
                    <?php echo form_open('transactions/Update'); ?>
                        <input class="form-control hidden" type="text" name="transaction-id" value=<?php echo $transaction->id; ?> readonly="">
                        <input class="form-control hidden" type="text" name="previous-item" value=<?php echo $item->id; ?> readonly="">
                        <div class="row">

                            <div class="col-md-12">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group" id="button-form-group">
                                            <a href="#modal_add_item" data-toggle="modal"data-id=""
                                            type="button" class="btn btn-info " id="btn-choose-item-manually"><i class="fa fa-tags"></i> Izaberi artikl</a>

                                            <a href="#modal_code" data-toggle="modal" data-id=""
                                            type="button" class="btn btn-success" id="btn-choose-item-via-code"><i class="fa fa-barcode"></i> Izaberi artikl</a>
                                        </div>

                                        <!-- <?php echo var_dump($transaction); ?>
                                        <?php echo var_dump($item); ?> -->

                                        <div class="row" id="item-taken-row" style="">
                                            <div class="col-md-3">
                                                <img class="img img-thumbnail" src=<?php echo base_url()."assets/dropzone/uploads/".$item->image; ?> alt="" style="width:125; height:125px;" id="item-img" />
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <input class="form-control hidden" id="item-taken" type="text" name="item-taken" value="<?php echo $item->id; ?>" readonly="">
                                                    <h4><span class="text-primary" id="item-name"><?php echo $item->name; ?></span><small> (CODE: <?php echo $item->code; ?>)</small></h4>
                                                    Opis <strong id="item-description"> <?php echo $item->description; ?></strong><br>
                                                    Cijena <strong id="item-price"> <?php echo $item->price; ?></strong>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Datum izdavanja:</label>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar-check-o"></i>
                                                </div>
                                                <input class="form-control pull-right datepicker" id="datepicker" type="text" name="date-taken"
                                                value=<?php echo $transaction->date_taken; ?>>
                                            </div>
                                            <!-- /.input group -->
                                        </div>

                                        <div class="form-group">
                                            <label>Rok vraćanja:</label>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar-times-o"></i>
                                                </div>
                                                <input class="form-control pull-right datepicker" id="datepicker" type="text" name="deadline"
                                                value=<?php echo $transaction->deadline; ?>>
                                            </div>
                                            <!-- /.input group -->
                                        </div>

                                        <div class="form-group">
                                            <label>Dužnik:</label>
                                            <div class="input-group location">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-user"></i>
                                                </div>
                                                <select  class="form-control" name="debtor">
                                                    <?php
                                                        $i = 1;
                                                        foreach ($users as $user) {
                                                            if($user->id ==$transaction->debtor_id)
                                                            {
                                                                echo "<option value=".$user->id." selected>";
                                                                echo $user->name ." ". $user->surname . " - [". $user->email ."]";
                                                                echo "</option>";
                                                            }
                                                            else{
                                                                echo "<option value=".$user->id.">";
                                                                echo $user->name ." ". $user->surname . " - [". $user->email ."]";
                                                                echo "</option>";
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Napomena:</label>
                                            <textarea class="form-control" id="footnote" placeholder="Tekst Napomene" name="footnote"><?php echo $transaction->footnote; ?></textarea>
                                        </div>

                                        <?php if(validation_errors() != '') {?>
                                            <div class="alert alert-danger" role="alert">
                                                <?php echo validation_errors(); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div><!--row-->

                            </div><!--col-md-6-->

                        </div><!--row-->

                        <div class="box-footer with-border">
                            <button class="btn btn-success" id="uredi_btn" type="submit"> Uredi </button>
                        </div>
                    </form>
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
                                  <?php foreach ($items as $item): ?>
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </form>
                </div>
              </div>

            </div>
          </div>
        </div>


    </section>

    <div class="hidden" id="base-url-images">
        <?php echo base_url()."assets/dropzone/uploads/"; ?>
    </div>

</div>
