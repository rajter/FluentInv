<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
          <i class="fa fa-map-marker"></i>  Praćenje
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-book"></i> LogTrack</a></li>
          <li class="active">Praćenje</li>
        </ol>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <a href=<?php echo base_url().'index.php/transactions/newTransaction' ?> id=""
                    class="btn btn-app bg-blue" type="button" name="button" data-toggle="tooltip" data-placement="bottom"
                    title="Zaduži artikl">
                    <i class="fa fa-tag"></i>
                    Zaduži artikl
                </a>
                <a href="#modal-code" id="btn-return-item"
                    data-toggle="modal"
                    class="btn btn-app bg-green" type="button" name="button" data-toggle="tooltip" data-placement="bottom"
                    title="Vrati artikl">
                    <i class="fa fa-barcode"></i>
                    Vrati artikl
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="box box-info">

                    <div class="box-header" style="cursor: move;">
                        <i class="fa fa-book"></i>
                        <h3 class="box-title">Zaduženja</h3>
                        <!-- tools box -->
                        <!-- <div class="pull-right box-tools">
                            <a href=<?php echo base_url().'index.php/transactions/newTransaction' ?> id="btn-new-contact" class="btn btn-primary pull-right" type="button" name="button" data-toggle="tooltip"  data-placement="bottom" title="Zaduži artikl"><i class="fa fa-tag"></i></a>
                        </div><!-- /. tools -->
                    </div>

                    <div class="box-body">
                        <!-- <?php echo var_dump($items_due); ?> -->
                        <?php for($i = 0; $i<count($items_due); $i++) { ?>
                            <div class="col-md-12" id="transaction-box-<?php echo $items_due[$i]->id; ?>">

                                <div class="box box-solid box-primary">

                                    <!-- <div class="box-tools pull-right">
                                        <a href=<?php echo base_url().'index.php/transactions/edit/'.$items_due[$i]->id; ?>
                                            class="btn btn-xs btn-success" type="button" name="button"> <i class="fa fa-edit"></i></a>
                                        <a href="" class="btn btn-xs btn-danger" type="button" name="button"><i class="fa fa-close"></i></a>
                                    </div> -->

                                    <div class="box-body">
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object"
                                                    data-toggle="tooltip"  data-placement="bottom" title="<?php echo $items_due[$i]->footnote; ?>"
                                                    <?php
                                                    if($items_due[$i]->image == NULL){
                                                        echo "src=''";
                                                    }else{
                                                        echo "src=".base_url()."assets/dropzone/uploads/".$items_due[$i]->image;
                                                    }
                                                    ?> alt="slika artikla" style="width: 125px; height:125px;">
                                                </a>
                                                <a href=<?php echo base_url().'index.php/transactions/edit/'.$items_due[$i]->id; ?>
                                                    class="btn btn-success" type="button" name="button"
                                                    data-toggle="tooltip"  data-placement="top" title="Uredi"><i class="fa fa-edit"></i></a>

                                                <a href=<?php echo base_url().'index.php/transactions/returnItem/'.$items_due[$i]->id; ?>
                                                    class="btn btn-primary" type="button" name="button"
                                                    data-toggle="tooltip"  data-placement="top" title="Vrati"><i class="fa fa-reply"></i> </a>

                                                <a href="#modal-delete" data-toggle="modal"
                                                    data-id="<?php echo $items_due[$i]->id; ?>"
                                                    data-name="<?php echo $items_due[$i]->name; ?>"
                                                    class="btn btn-danger" type="button" name="button"><i class="fa fa-close"></i></a>
                                            </div>
                                            <div class="media-body">
                                                <!-- <?php echo var_dump($items_due[$i]); ?> -->
                                                <div class="row">
                                                    <div class="col-md-4 col-xs-4">
                                                        <h4><span class="text-primary"><?php echo $items_due[$i]->name; ?></span><small> (CODE: AAAAA)</small></h4>
                                                        <i class="fa fa-calendar"></i> Izdano <strong> <?php echo date('d-m-Y', strtotime($items_due[$i]->date_taken)); ?></strong><br>
                                                        <i class="fa fa-calendar-times-o"></i> Rok <strong><?php echo date('d-m-Y', strtotime($items_due[$i]->deadline)); ?></strong><br><br>
                                                    </div>
                                                    <div class="col-md-4 col-xs-4">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span for="" class="label label-danger">Duznik</span>
                                                                <a href="<?php echo base_url().'index.php/users/view/'.$items_due[$i]->userID; ?>" target="_blank">
                                                                    <img class="media-object"
                                                                    data-toggle="tooltip"  data-placement="left" title="<?php echo $items_due[$i]->user; ?>"
                                                                    <?php
                                                                    if($items_due[$i]->userImage == NULL){
                                                                        echo "src=''";
                                                                    }else{
                                                                        echo "src=".base_url()."assets/dropzone/uploads/".$items_due[$i]->userImage;
                                                                    }
                                                                    ?>
                                                                    alt="slika korisnika" style="width: 50px; height:50px; margin-top: 5px;">
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span for="" class="label label-success">Izdao</span>
                                                                <a href="<?php echo base_url().'index.php/users/view/'.$items_due[$i]->debtorID; ?>" target="_blank">
                                                                    <img class="media-object"
                                                                    data-toggle="tooltip"  data-placement="left" title="<?php echo $items_due[$i]->debtor; ?>"
                                                                    <?php
                                                                    if($items_due[$i]->debtorImage == NULL){
                                                                        echo "src=''";
                                                                    }else{
                                                                        echo "src=".base_url()."assets/dropzone/uploads/".$items_due[$i]->debtorImage;
                                                                    }
                                                                    ?>
                                                                    alt="slika duznika" style="width: 50px; height:50px; margin-top: 5px;">
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div><!-- /.box-body -->

                                </div><!-- /.box -->
                            </div><!--col-md-3-->
                        <?php }; ?>
                    </div><!-- /.box -->

                </div><!--box box-info-->
            </div><!--col-md-6-->

            <div class="col-md-6">
                <div class="box box-info">

                    <div class="box-header" style="cursor: move;">
                        <i class="fa fa-exclamation-triangle"></i>
                        <h3 class="box-title">Prekoračenja</h3>
                    </div>

                    <div class="box-body" id="postpone-items">
                        <!-- <?php echo var_dump($items_due_deadline); ?> -->
                        <?php for($i = 0; $i<count($items_due_deadline); $i++) { ?>
                            <div class="col-md-12" id="transaction-box-<?php echo $items_due_deadline[$i]->id; ?>">
                                <div class="box box-solid box-danger">

                                    <div class="box-body">
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object"
                                                    data-toggle="tooltip"  data-placement="bottom" title="<?php echo $items_due_deadline[$i]->footnote; ?>"
                                                    <?php
                                                    if($items_due_deadline[$i]->image == NULL){
                                                        echo "src=''";
                                                    }else{
                                                        echo "src=".base_url()."assets/dropzone/uploads/".$items_due_deadline[$i]->image;
                                                    }
                                                    ?> alt="slika artikla" style="width: 125px; height:125px;">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h4><span class="text-primary"><?php echo $items_due_deadline[$i]->name; ?></span><small> (CODE: AAAAA)</small></h4>
                                                Izdano <strong> <?php echo $items_due_deadline[$i]->date_taken; ?></strong> do <strong><?php echo $items_due_deadline[$i]->deadline; ?></strong><br>
                                                Dužnik <a href="#"><strong><?php echo $items_due_deadline[$i]->debtor; ?></strong></a>, izdao<strong> <?php echo $items_due_deadline[$i]->user; ?></strong><br>

                                                <a href=<?php echo base_url().'index.php/transactions/edit/'.$items_due_deadline[$i]->id; ?>
                                                    class="btn btn-success" type="button" name="button"
                                                    data-toggle="tooltip"  data-placement="bottom" title="Uredi"><i class="fa fa-edit"></i></a>

                                                <a href=<?php echo base_url().'index.php/transactions/returnItem/'.$items_due_deadline[$i]->id; ?>
                                                   class="btn btn-primary" type="button" name="button"><i class="fa fa-reply"></i> Vrati</a>

                                                <a href="#modal-postpone" data-toggle="modal"
                                                    data-id=<?php echo $items_due_deadline[$i]->id; ?>
                                                    type="button" class="btn btn-default btn-postpone"><i class="fa fa-hourglass-half"></i> Produži</a>

                                                <a href="#modal-delete" data-toggle="modal"
                                                    data-id="<?php echo $items_due_deadline[$i]->id; ?>"
                                                    data-name="<?php echo $items_due_deadline[$i]->name; ?>"
                                                    class="btn btn-danger" type="button" name="button"
                                                    data-toggle="tooltip"  data-placement="bottom" title="Obriši"><i class="fa fa-close"></i></a>
                                            </div>
                                        </div>
                                    </div><!-- /.box-body -->
                                </div><!-- /.box -->
                            </div><!--col-md-3-->
                        <?php }; ?>
                    </div><!-- /.box -->

                </div><!--box box-info-->
            </div><!--col-md-6-->
        </div>

        <p class="hidden" id="token">
            <?php echo $this->security->get_csrf_token_name(); ?>
        </p>
        <p class="hidden" id="hash">
            <?php echo $this->security->get_csrf_hash(); ?>
        </p>

        <?php
          $attributes = array('id' => 'ajaxform');
          echo form_open('', $attributes);
          echo form_close();
        ?>

        <!--***************************************-->
        <!--MODALNI DIALOG ZA PRODULJENJE DEADLINEA-->
        <!--***************************************-->
        <div class="row">
          <div class="modal fade" id="modal-postpone" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Produži zaduženje</h4>
                </div>
                <div class="modal-body">
                    <?php echo form_open('transactions/postponeItem'); ?>
                    <div class="form-group">
                        <label>Rok vraćanja:</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar-times-o"></i>
                            </div>
                            <input class="form-control pull-right datepicker" id="datepicker" type="text" name="deadline"
                            value=<?php echo date('Y-m-d'); ?>>
                        </div>
                        <!-- /.input group -->
                    </div>

                </div>
                <div class="modal-footer">

                    <input id="trans-id" type="hidden" name="transaction-id" value="">
                    <button type="submit" class="btn btn-success "name="button" id="id_btn"><i class="fa fa-hourglass-half"></i> Produži</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i>Close</button>
                  </form>
                </div>
              </div>

            </div>
          </div>
        </div>

        <!--**************************************-->
        <!--MODALNI DIALOG ZA BRISANJE TRANSAKCIJE-->
        <!--**************************************-->
        <div class="row">
          <div class="modal fade" id="modal-delete" role="dialog">
            <div class="modal-dialog">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Obriši zaduženje</h4>
                </div>
                <div class="modal-body">
                  <p>Jest li sigurni da želite obrisati zaduženje za artikl: <b id="modal-zaduzenje"></b></p>
                </div>
                <div class="modal-footer">
                  <!-- <?php
                    $attributes = array('id' => 'delete_form');
                    echo form_open('', $attributes);
                  ?> -->
                    <input id="id" type="hidden" name="id" value="">
                    <button type="submit" class="btn btn-danger "name="button" id="btn-delete">Obrisi</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </form>
                </div>
              </div>

            </div>
          </div>
        </div>

        <!--**********************************************-->
        <!--MODALNI DIALOG DODAVANJA ARTIKLA CITANJEM KODA-->
        <!--**********************************************-->
        <div class="row">
          <div class="modal fade" id="modal-code" role="dialog">
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
                  <input class="text-center form-control" id="input-return-code" type="text" name="code" value=""
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

        <div class="error">

        </div>


    </section>

</div>
