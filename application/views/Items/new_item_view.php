<?php

    $nameIsEmpty = !empty(form_error('name'));
    $codeIsEmpty = !empty(form_error('code'));

    $priceIsEmpty = empty(set_value('price'));
    $itemTypeId = set_value('item_type_id');

 ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title"><i class="fa fa-tag"></i> Novi Artikl</h3>
                    </div>
                    <div class="box-body">
                            <div class="row">
                                <?php echo form_open_multipart('items/create'); ?>
                                    <div class="col-md-6">
                                        <div class="box-body">
                                            <div class="form-group <?php if($nameIsEmpty){ echo "has-error";} ?>">
                                                <label for="name">Ime <?php if($nameIsEmpty){ echo "- ne smije biti prazno!";} ?></label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-tag"></i>
                                                    </div>
                                                    <input class="form-control" type="text" name="name" value="<?php echo set_value('name'); ?>" placeholder="Ime Artikla">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Opis</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-binoculars"></i>
                                                    </div>
                                                    <textarea class="form-control" name="description" rows="3" cols="40" placeholder="Opis Artikla"><?php echo set_value('description'); ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="price">Cijena</label>
                                                <span class="text-green"> -> Koristiti decimalnu točku umjesto zareza!</span>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-money"></i>
                                                    </div>
                                                    <input class="form-control" type="number" min="0.01" step="0.01" name="price" value="<?php if($priceIsEmpty){ echo "0.00";}else{ echo set_value('price');} ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Tip </label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-info"></i>
                                                    </div>
                                                    <select class="form-control" name="item_type_id">
                                                        <?php
                                                        foreach ($types as $type) {
                                                            if($itemTypeId == $type->id){
                                                                echo "<option selected='selected' value=". $type->id .">". $type->id . " - ". $type->name . "</option>";
                                                            }else{
                                                                echo "<option value=". $type->id .">". $type->id . " - ". $type->name . "</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group <?php if($codeIsEmpty){ echo "has-error";} ?>">
                                                <label for="code">Kod <?php if($codeIsEmpty){ echo "- ne smije biti prazan!";} ?></label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-barcode"></i>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col col-md-9">
                                                            <input class="form-control" id="item_code" type="text" name="code" value="<?php echo set_value('code'); ?>" placeholder="Jedinstven kod artikla" readonly>
                                                        </div>
                                                        <div class="col col-md-3">
                                                            <a href="#modal_code" data-toggle="modal"
                                                            type="button" class="btn btn-default"><i class="fa fa-barcode"></i>  Učitaj kod</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input class="form-control hidden" id="item-image" type="text" name="image" value="<?php echo set_value('image'); ?>" readonly>
                                        </div><!--box body-->
                                        <div class="box-footer with-border">
                                            <button class="btn btn-primary" type="Submit" name="newItem">Kreiraj</button>
                                        </div>
                                    </div><!--col-md-6-->
                                </form>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Image"><i class="fa fa-image"></i> Slika:</label>
                                        <p class="hidden" id="base_url"><?php echo base_url(); ?></p>
                                        <form action="<?php echo site_url('items/upload'); ?>" class="dropzone text-center" id="my-awesome-dropzone" style="height:350px;">
                                            <input name=<?php echo $this->security->get_csrf_token_name(); ?>
                                                    value=<?php echo $this->security->get_csrf_hash(); ?> style="display:none;" type="hidden">
                                            <!-- <button class="btn btn-danger" type="button" name="button" id="btn-delete-image">Ukloni sliku</button> -->
                                        </form>
                                    </div>
                                </div><!--col-md-6-->

                            </div><!-- row -->
                    </div><!--box body-->
                </div><!--box-->

            </div><!--col-md-12-->

        </div><!--row-->

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




    </section>

</div>
