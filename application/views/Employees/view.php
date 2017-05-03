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
                                <h2><i class="fa fa-tag"></i> <?php echo $employee->name; ?></h2>
                                <h5 class="widget-user-desc"><?php echo $employee->surname; ?></h5>
                            </div>
                            <div class="widget-user-image">
                                <img class="img-circle"
                                <?php
                                if($employee->image == NULL){
                                    echo "src=''";
                                }else{
                                    echo "src=".base_url()."assets/dist/img/".$employee->image;
                                }
                                ?> alt="slika artikla">
                            </div>
                            <div class="box-footer">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3><i class="fa fa-edit"></i> Detalji</h3>
                                <div class="box-tools pull-right" style="margin-top: 15px;">
                                    <a class="btn btn-primary" href=<?php echo base_url(). "index.php/employees/edit/". $employee->id; ?>><i class="fa fa-edit"></i> Uredi</a>
                                </div>
                            </div>
                            <div class="box-body">
                                <style>
                                    .label{
                                        font-size: 100%;
                                    }
                                </style>
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="#"><i class="fa fa-user"></i> Ime <span class="label label-success pull-right"><?php echo $employee->name.' '.$employee->surname; ?></span></a></li>
                                    <li><a href="#"><i class="fa fa-envelope"></i> E-mail <span class="label label-primary pull-right"><?php echo $employee->email; ?></span></a></li>
                                    <li><a href="#"><i class="fa fa-envelope"></i> Role <span class="label label-warning pull-right"><?php echo $employee->role; ?></span></a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <!-- <?php echo var_dump($transactions); ?> -->
                    </div>
                </div>

            </div><!--col-md-6-->

            <!--TIMELINE-->
            <!-- <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Transakcije</h3>
                    </div>
                    <div class="box-body">
                        <ul class="timeline">
                            <?php foreach ($transactions as $transaction): ?>
                                <?php $label_color = 'blue';
                                      $label_icon = 'fa fa-arrow-left';
                                    switch($transaction->transaction_type_id)
                                    {
                                        case 1:
                                            $label_color = 'green';
                                            $label_icon = 'fa fa-arrow-left';
                                            break;
                                        case 2:
                                            $label_color = 'red';
                                            $label_icon = 'fa fa-arrow-right';
                                            break;
                                        case 3:
                                            $label_color = 'purple';
                                            $label_icon = 'fa fa-exchange';
                                            break;
                                        case 7:
                                            $label_color = 'yellow';
                                            $label_icon = 'fa fa-info';
                                            break;
                                        default:
                                            $label_color = 'green';
                                            $label_icon = 'fa fa-arrow-left';
                                    }
                                ?>
                                <li class="time-label">
                                  <span class=<?php echo "bg-".$label_color ?>>
                                    <?php echo $transaction->transaction_number;; ?>
                                  </span>
                                  <div class="btn-group">
                                  </div>
                                </li>
                                <li>
                                    <i class=<?php echo '"'. $label_icon.' bg-'.$label_color.'"' ?>></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i><?php echo date_format(new DateTime($transaction->date), 'd.m.Y. H:m'); ?></span>
                                        <div class="timeline-body">
                                            <p>Tip transakcije: <?php echo $transaction->transaction_type_id." - ".$transaction->TransactionType; ?></p>
                                            <p>Kolicina: <?php echo $transaction->quantity; ?></p>
                                            <p>Lokacija: <?php echo $transaction->Location_IN; ?></p>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div> -->
            <!-- TIMELINE -->
        </div><!--row-->

    </section>

</div>
