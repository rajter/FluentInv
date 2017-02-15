<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
          <i class="fa fa-tag"></i>  Novi Tip
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-tag"></i> LogTrack</a></li>
          <li class="active">Novi Tip</li>
        </ol>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-body">
                        <div class="row">
                            <?php echo form_open_multipart('itemTypes/createItemType'); ?>
                                <div class="col-md-6">
                                    <div class="box-body">
                                        <?php echo validation_errors(); ?>
                                        <div class="form-group">
                                            <label for="name">Ime</label>
                                            <input class="form-control" type="text" name="name" value="" placeholder="Ime Novog Tipa">
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Opis</label>
                                            <textarea class="form-control" name="description" rows="3" cols="40"></textarea>
                                        </div>
                                    </div><!--box body-->
                                    <div class="box-footer with-border">
                                        <button class="btn btn-primary" type="Submit" name="newItem">Kreiraj</button>
                                    </div>
                                </div><!--col-md-6-->
                            </form>
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
