<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content">

        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-aqua-active">
                                <h2><i class="fa fa-tag"></i> <?php echo $transaction->ItemName; ?></h2>
                                <h5 class="widget-user-desc"><?php echo $transaction->ItemDescription; ?></h5>
                            </div>
                            <div class="widget-user-image">
                                <img class="img-circle"
                                <?php
                                if($transaction->ItemImage == NULL){
                                    echo "src=''";
                                }else{
                                    echo "src=".base_url()."assets/dropzone/uploads/".$transaction->ItemImage;
                                }
                                ?> alt="slika artikla">
                            </div>
                            <div class="box-footer">
                              <div class="row">
                                <div class="col-sm-4 border-right">
                                  <div class="description-block">
                                    <h3 class="description-header"><?php echo substr($transaction->ItemDescription, 0, 50); ?></h3>
                                    <span class="description-text">OPIS</span>
                                  </div>
                                  <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 border-right">
                                  <div class="description-block">
                                    <h5 class="description-header"><?php echo $transaction->id; ?></h5>
                                    <span class="description-text">ID Transakcije</span>
                                  </div>
                                  <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4">
                                  <div class="description-block">
                                    <h5 class="description-header"><?php echo $transaction->ItemId; ?></h5>
                                    <span class="description-text">ID Artikla</span>
                                  </div>
                                  <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                              </div>
                              <!-- /.row -->
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- DETALJI TRANSAKCIJE-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3><i class="fa fa-edit"></i> Detalji</h3>
                                <div class="box-tools pull-right" style="margin-top: 15px;">
                                    <a class="<?php if($transaction->TransactionStatus == 1){echo 'btn btn-success disabled';} else{echo 'btn btn-success';}?>"
                                    href=<?php echo base_url(). "index.php/transactions/edit/". $transaction->id; ?>><i class="fa fa-edit"></i> Uredi</a>
                                </div>
                            </div>
                            <div class="box-body">

                                <div class="user-block">
                                    <img class="img-circle img-bordered-sm" 
                                        <?php
                                        if($transaction->userImage == NULL){echo "src=''";}
                                        else{echo "src=".base_url()."assets/dropzone/uploads/".$transaction->userImage;}
                                        ?>
                                    >
                                    <span class="username"><a href="#"><?php echo $transaction->user ?></a></span>
                                    <span class="description"><i class="fa fa-calendar"></i>  Izdao - <?php echo date('d/m/Y', strtotime($transaction->date_taken)); ?></span>
                                </div>
                                <div class="user-block">
                                    <img class="img-circle img-bordered-sm" 
                                        <?php
                                        if($transaction->debtorImage == NULL){echo "src=''";}
                                        else{echo "src=".base_url()."assets/dropzone/uploads/".$transaction->debtorImage;}
                                        ?>
                                    >
                                    <span class="username"><a href="#"><?php echo $transaction->debtor ?></a></span>
                                    <span class="description"><i class="fa fa-calendar-check-o"></i>  Rok vraćanja - <?php echo date('d/m/Y', strtotime($transaction->deadline)); ?></span>
                                </div>
                                <br>
                                <div class="post">
                                    <p><i class="fa fa-commenting"></i> <?php echo $transaction->footnote; ?></p>
                                </div>
                                
                            </div>

                        </div>
                    </div>
                </div>
            </div><!--col-md-6-->

            

            


        </div><!--row-->

    </section>

</div>
