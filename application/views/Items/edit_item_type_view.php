<?php

    $nameIsEmpty = !empty(form_error('name'));
    $descriptionIsEmpty = !empty(form_error('description'));

 ?>
<div class="content-wrapper">

    <section class="content-header">
        <h1>
          <i class="fa fa-tag"></i> Promjeni Tip
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-tag"></i> LogTrack</a></li>
          <li class="active"> Promjeni Tip</li>
        </ol>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-body">
                        <div class="row">
                            <?php  echo form_open_multipart('itemTypes/updateItemType/'.$item_type->id); ?>
                                <div class="col-md-6">
                                    <div class="box-body">
                                        <input type="hidden" name="id" value=<?php echo $item_type->id; ?>>
                                        <div class="form-group <?php if($nameIsEmpty){ echo "has-error";} ?>">
                                            <label for="name">Ime</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-key"></i>
                                                </div>
                                                <input class="form-control" type="text" name="name" value="<?php echo $item_type->name; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group <?php if($descriptionIsEmpty){ echo "has-error";} ?>">
                                            <label for="description">Opis <?php if($descriptionIsEmpty){ echo "ne smije biti prazan!";} ?></label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-binoculars"></i>
                                                </div>
                                                <textarea class="form-control" name="description" rows="3" cols="40"><?php echo $item_type->description; ?></textarea>
                                            </div>
                                        </div>
                                    </div><!--box body-->
                                    <div class="box-footer with-border">
                                        <button class="btn btn-primary" type="Submit" name="newItem">Spremi</button>
                                    </div>
                                </div><!--col-md-6-->
                            </form>
                        </div><!-- row -->
                    </div><!--box body-->
                </div><!--box-->
            </div><!--col-md-12-->
        </div><!--row-->
        <!-- <?php echo var_dump($item_type) ?> -->

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
