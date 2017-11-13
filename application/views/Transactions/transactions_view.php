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
                    </div>

                    <div class="box-body">
                        <!-- <?php echo var_dump($items_due); ?> -->
                        <?php for($i = 0; $i<count($items_due); $i++) { ?>
                            <?php $item = $items_due[$i]; ?>
                            <div class="col-md-6" id="transaction-box-<?php echo $item->id; ?>">
                                <div class="box box-success">
                                    <div class="box-body box-profile">
                                        <img class="profile-user-img img-responsive"
                                        data-toggle="tooltip"  data-placement="bottom" title="<?php echo $item->footnote; ?>"
                                        <?php
                                        if($item->image == NULL){
                                            echo "src=''";
                                        }else{
                                            echo "src=".base_url()."assets/dropzone/uploads/".$item->image;
                                        }
                                        ?> alt="slika artikla" style="width: 125px; height:125px;">
                                        <h3 class="profile-username text-center"><?php echo $item->name; ?> <small class="text-muted"><?php echo $item->description; ?></small></h3>


                                        <ul class="list-group list-group-unbordered">
                                            <li class="list-group-item">
                                                <b><i class="fa fa-calendar"></i> Izdano</b> <span class="pull-right"><?php echo date('d-m-Y', strtotime($item->date_taken)); ?></span>
                                            </li>
                                            <li class="list-group-item">
                                                <b><i class="fa fa-calendar-times-o"></i> Rok</b> <span class="pull-right"><?php echo date('d-m-Y', strtotime($item->deadline)); ?></span>
                                            </li>
                                            <li class="list-group-item">
                                                <b><i class="fa fa-user-o"></i> Izdao</b>
                                                <img class="img img-responsive pull-right"
                                                <?php
                                                if($item->userImage == NULL){
                                                    echo "src=''";
                                                }else{
                                                    echo "src=".base_url()."assets/dropzone/uploads/".$item->userImage;
                                                }
                                                ?>
                                                alt="slika korisnika" style="width: 25px; height:25px;">
                                                <b class="pull-right text-primary"><?php echo $item->user; ?> </b>
                                            </li>
                                            <li class="list-group-item">
                                                <b><i class="fa fa-user"></i> Duznik</b>
                                                <img class="img img-responsive pull-right"
                                                <?php
                                                if($item->debtorImage == NULL){
                                                    echo "src=''";
                                                }else{
                                                    echo "src=".base_url()."assets/dropzone/uploads/".$item->debtorImage;
                                                }
                                                ?>
                                                alt="slika korisnika" style="width: 25px; height:25px;">
                                                <b class="pull-right text-danger"> <?php echo $item->debtor; ?> </b>
                                            </li>
                                        </ul>

                                        <a href=<?php echo base_url().'index.php/transactions/edit/'.$item->id; ?>
                                            class="btn btn-success" type="button" name="button"
                                            data-toggle="tooltip"  data-placement="bottom" title="Uredi"><i class="fa fa-edit"></i></a>

                                        <a href=<?php echo base_url().'index.php/transactions/returnItem/'.$item->id; ?>
                                           class="btn btn-primary" type="button" name="button"><i class="fa fa-reply"></i> Vrati</a>

                                        <a href="#modal-delete" data-toggle="modal"
                                            data-id="<?php echo $item->id; ?>"
                                            data-name="<?php echo $item->name; ?>"
                                            class="btn btn-danger" type="button" name="button"
                                            data-toggle="tooltip"  data-placement="bottom" title="Obriši"><i class="fa fa-close"></i></a>
                                    </div><!-- /.box-body -->
                                </div>
                            </div>
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

                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-body" id="postpone-items">
                                <!-- <?php echo var_dump($items_due_deadline); ?> -->
                                <?php for($i = 0; $i<count($items_due_deadline); $i++) { ?>
                                    <?php $item = $items_due_deadline[$i]; ?>
                                    <div class="col-md-6" id="transaction-box-<?php echo $item->id; ?>">
                                        <div class="box box-danger">
                                            <div class="box-body box-profile">
                                                <img class="profile-user-img img-responsive"
                                                data-toggle="tooltip"  data-placement="bottom" title="<?php echo $item->footnote; ?>"
                                                <?php
                                                if($item->image == NULL){
                                                    echo "src=''";
                                                }else{
                                                    echo "src=".base_url()."assets/dropzone/uploads/".$item->image;
                                                }
                                                ?> alt="slika artikla" style="width: 125px; height:125px;">
                                                <h3 class="profile-username text-center"><?php echo $item->name; ?> <small class="text-muted"><?php echo $item->description; ?></small></h3>


                                                <ul class="list-group list-group-unbordered">
                                                    <li class="list-group-item">
                                                        <b><i class="fa fa-calendar"></i> Izdano</b> <span class="pull-right"><?php echo date('d-m-Y', strtotime($item->date_taken)); ?></span>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b><i class="fa fa-calendar-times-o"></i> Rok</b> <span class="pull-right"><?php echo date('d-m-Y', strtotime($item->deadline)); ?></span>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b><i class="fa fa-user-o"></i> Izdao</b>
                                                        <img class="img img-responsive pull-right"
                                                        <?php
                                                        if($item->userImage == NULL){
                                                            echo "src=''";
                                                        }else{
                                                            echo "src=".base_url()."assets/dropzone/uploads/".$item->userImage;
                                                        }
                                                        ?>
                                                        alt="slika korisnika" style="width: 25px; height:25px;">
                                                        <b class="pull-right text-primary"><?php echo $item->user; ?> </b>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b><i class="fa fa-user"></i> Duznik</b>
                                                        <img class="img img-responsive pull-right"
                                                        <?php
                                                        if($item->debtorImage == NULL){
                                                            echo "src=''";
                                                        }else{
                                                            echo "src=".base_url()."assets/dropzone/uploads/".$item->debtorImage;
                                                        }
                                                        ?>
                                                        alt="slika korisnika" style="width: 25px; height:25px;">
                                                        <b class="pull-right text-danger"> <?php echo $item->debtor; ?> </b>
                                                    </li>
                                                </ul>

                                                <a href=<?php echo base_url().'index.php/transactions/edit/'.$item->id; ?>
                                                    class="btn btn-success" type="button" name="button"
                                                    data-toggle="tooltip"  data-placement="bottom" title="Uredi"><i class="fa fa-edit"></i></a>

                                                <a href=<?php echo base_url().'index.php/transactions/returnItem/'.$item->id; ?>
                                                   class="btn btn-primary" type="button" name="button"><i class="fa fa-reply"></i> Vrati</a>

                                                <a href="#modal-postpone" data-toggle="modal"
                                                    data-id=<?php echo $item->id; ?>
                                                    type="button" class="btn btn-default btn-postpone"><i class="fa fa-hourglass-half"></i> Produži</a>

                                                <a href="#modal-delete" data-toggle="modal"
                                                    data-id="<?php echo $item->id; ?>"
                                                    data-name="<?php echo $item->name; ?>"
                                                    class="btn btn-danger" type="button" name="button"
                                                    data-toggle="tooltip"  data-placement="bottom" title="Obriši"><i class="fa fa-close"></i></a>
                                            </div><!-- /.box-body -->
                                        </div>
                                    </div>
                                <?php }; ?>
                            </div><!-- /.box -->

                        </div>
                    </div>

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
                        style="font-size: 50px; height: 75px;" >
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
