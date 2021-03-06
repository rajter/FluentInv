<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-tag"></i> Artikl</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <?php echo form_open_multipart('items/update'); ?>
                            <div class="col-md-6">
                                <div class="box-body">
                                    <?php echo validation_errors(); ?>
                                    <input type="hidden" name="id" value=<?php echo $item->id; ?>>
                                    <div class="form-group">
                                        <label for="name">Ime</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-tag"></i>
                                            </div>
                                            <input class="form-control" type="text" name="name" value="<?php echo $item->name; ?>" placeholder="Ime Artikla">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Opis</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-binoculars"></i>
                                            </div>
                                            <textarea class="form-control" name="description" rows="3" cols="40"><?php echo $item->description; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Cijena</label>
                                        <span class="text-green"> -> Koristiti decimalnu točku umjesto zareza!</span>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-money"></i>
                                            </div>
                                            <input class="form-control" type="number" min="0.01" step="0.01" name="price" value=<?php echo $item->price ?>>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Tip</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-info"></i>
                                            </div>
                                            <select class="form-control" name="item_type_id">
                                                <?php
                                                foreach ($types as $type) {
                                                    if($item->item_type_id == $type->id){
                                                        echo "<option selected='selected' value=". $type->id .">". $type->id . " - ". $type->name . "</option>";
                                                    }else{
                                                        echo "<option value=". $type->id .">". $type->id . " - ". $type->name . "</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="code">Kod</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-barcode"></i>
                                            </div>
                                            <div class="row">
                                                <div class="col col-md-9">
                                                    <input class="form-control" id="item_code" type="text" name="code" value=<?php echo $item->code; ?> placeholder="Jedinstven kod artikla" readonly>
                                                </div>
                                                <div class="col col-md-3">
                                                    <a href="#modal_code" data-toggle="modal"
                                                    type="button" class="btn btn-default"><i class="fa fa-barcode"></i>  Učitaj kod</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input class="form-control hidden" id="item-image" type="text" name="image" value=<?php echo $item->image; ?> readonly>
                                </div><!--box-body-->

                                <div class="box-footer with-border">
                                    <button class="btn btn-primary" type="Submit" name="updateItem">Spremi</button>
                                </div>

                            </div><!--col-md-6-->
                            <?php echo form_close(); ?>

                            <div class="col-md-6">
                                <br>
                                <div class="form-group" id="div-image">
                                    <label for="Image"><i class="fa fa-image"></i>  Slika:</label>
                                    <p class="hidden" id="base_url"><?php echo base_url(); ?></p>
                                    <?php if(!empty($item->image)){ ?>
                                            <img class="img img-responsive center-block" style="width: 250px; height: 250px;" id="image"
                                            <?php
                                            echo "src=".base_url()."assets/dropzone/uploads/".$item->image;
                                            ?> alt="slika artikla">
                                            <button class="btn btn-default" type="button" name="button" id="btn-change-image"> Promjeni sliku</button>
                                    <?php } ?>

                                    <form action="<?php echo site_url('items/upload'); ?>" class="dropzone text-center" id="my-awesome-dropzone" style="height:350px;">
                                        <input
                                            name=<?php echo $this->security->get_csrf_token_name(); ?>
                                            value=<?php echo $this->security->get_csrf_hash(); ?> style="display:none;" type="hidden">
                                    </form>
                                    <br>
                                    <button class="btn btn-danger" type="button" name="button" id="btn-abort-image-upload"><i class="fa fa-ban"></i> Prekid</button>
                                </div>
                            </div><!--col-md-6-->

                        </div><!--row-->
                    </div><!--box body-->
                </div><!--box-->
            </div><!--col-md-6-->
        </div><!--row-->

        <p class="hidden" id="base_url"><?php echo base_url(); ?></p>

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
                        style="font-size: 50px; height: 75px;">
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
