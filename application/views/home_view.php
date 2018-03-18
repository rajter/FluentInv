<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
          Kontrolna ploča
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> LogTrack</a></li>
          <li class="active">Kontrolna ploča</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">

          <div class="col-md-3 col-sm-6 col-sx-12">
            <div class="small-box bg-aqua">
              <div class="inner">
                <h3>#<?php echo $itemCount; ?></h3>
                <p>Artikli</p>
              </div>
              <div class="icon">
                <i class="fa fa-tags"></i>
              </div>
              <a href="<?php echo base_url(); ?>index.php/Items" class="small-box-footer">Više informacija <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-md-3 col-sm-6 col-sx-12">
            <div class="small-box bg-green">
              <div class="inner">
                <h3>#</h3>
                <p>Praćenje artikala</p>
              </div>
              <div class="icon">
                <i class="fa fa-book"></i>
              </div>
              <a href="<?php echo base_url(); ?>index.php/transactions" class="small-box-footer">Više informacija <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-md-3 col-sm-6 col-sx-12">
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3>#</h3>
                <p>Popis transakcija</p>
              </div>
              <div class="icon">
                <i class="fa fa-exchange"></i>
              </div>
              <a href="<?php echo base_url(); ?>index.php/transactions/viewall" class="small-box-footer">Više informacija <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-md-3 col-sm-6 col-sx-12">
            <div class="small-box bg-purple">
              <div class="inner">
                <h3>#</h3>
                <p>Poduzeće</p>
              </div>
              <div class="icon">
                <i class="fa fa-bank"></i>
              </div>
              <a href="<?php echo base_url(); ?>index.php/company" class="small-box-footer">Više informacija <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

        </div>

        <div class="row">
            <div class="col-md-7">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Mjesečne Transakcije</h3>
                        <div class="box-tools pull-right">
                          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                          <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body" id="home-chart">
                        <div class="" id="items-chart" style="position: relative; height: 300px;"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="box box-solid bg-green-gradient">
                    <div class="box-header ui-sortable-handle" style="cursor: move;">
                      <i class="fa fa-calendar"></i>
                      <h3 class="box-title">Calendar</h3>
                      <!-- tools box -->
                      <div class="pull-right box-tools">
                        <button class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                      </div><!-- /. tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body no-padding">
                      <!--The calendar -->
                      <div id="calendar" class="">

                      </div>
                    </div><!-- /.box-body -->
                    <!-- <div class="box-footer">

                    </div> -->
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-9">
                <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Zadnje Transakcije</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                            <tr>
                                <th style="width: 70px;"><i class="fa fa-image"></i> Artikl</th>
                                <th class="hidden">Artikl</th>
                                <th ><i class="fa fa-user"></i> Izdao</th>
                                <th ><i class="fa fa-address-card-o"></i> Dužnik</th>
                                <th ><i class="fa fa-calendar"></i> Izdano</th>
                                <th ><i class="fa fa-calendar-times-o"></i> Rok vraćanja</th>
                                <th ><i class="fa fa-calendar-check-o"></i> Vraćeno</th>
                                <th ><i class="fa fa-commenting-o"></i> Napomena</th>
                                <th ><i class="fa fa-info"></i> Status</th>
                            </tr>
                        </thead>
                      <tbody>
                          <?php foreach ($latestTransactions as $trans): ?>
                              <tr id="<?php echo "receipt-row-".$trans->id; ?>">
                                  <!-- <td><?php echo $trans->id; ?></td> -->
                                  <!-- <td><?php echo $trans->transaction_number; ?></td> -->
                                  <td>
                                      <a href="#">
                                          <img class="media-object"
                                          data-toggle="tooltip"  data-placement="bottom" title="<?php echo $trans->name; ?>"
                                          <?php
                                          if($trans->image == NULL){
                                              echo "src=''";
                                          }else{
                                              echo "src=".base_url()."assets/dropzone/uploads/".$trans->image;
                                          }
                                          ?>
                                          alt="slika artikla" style="width: 50px; height:50px;">
                                      </a>
                                  </td>
                                  <td class="hidden"><?php echo $trans->name . " - " . $trans->description; ?></td>
                                  <td><span class='label label-info'><?php echo $trans->user; ?></span></td>
                                  <td><span class='label label-danger'><?php echo $trans->debtor; ?></span></td>
                                  <td><?php echo $trans->date_taken; ?></td>
                                  <td><?php echo $trans->deadline; ?></td>
                                  <td><?php echo $trans->date_returned; ?></td>
                                  <td><?php echo substr($trans->footnote, 0, 50)." ..."; ?></td>
                                  <td><?php
                                          switch($trans->status)
                                          {
                                              case 0:
                                                  echo "<span class='label label-danger'>Zaduženo</span>";
                                              break;
                                              case 1:
                                                  echo "<span class='label label-success'>Vraćeno</span>";
                                              break;
                                              default:
                                                  echo "<span class='label label-warning'>Zaduženo</span>";
                                          }
                                      ?>
                                  </td>
                              </tr>
                              <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->

                <div class="box-footer clearfix">
                  <!-- <a href="#" class="btn btn-sm btn-default btn-flat pull-right">Pregled Transackija</a> -->
                </div><!-- /.box-footer -->
              </div>
            </div>

            <div class="col-md-3">
                <div class="box box-danger">
                    <div class="box-header with-border">
                      <h3 class="box-title">Korisnici</h3>
                      <div class="box-tools pull-right">
                        <!-- <span class="label label-danger">8 New Members</span> -->
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                      </div>
                    </div><!-- /.box-header -->
                    <div class="box-body no-padding">
                      <ul class="users-list clearfix">
                          <?php foreach ($users as $user) {?>
                            <li>
                                <img src="<?php echo base_url()."assets/dropzone/uploads/".$user->image; ?>" alt="User Image">
                                <a class="users-list-name" href="<?php echo base_url().'index.php/users/view/'.$user->id; ?>" target="blank"><?php echo $user->name;?></a>
                                <span class="users-list-date"><?php echo $user->login_date; ?></span>
                            </li>
                          <?php } ?>

                      </ul><!-- /.users-list -->
                    </div><!-- /.box-body -->
                    <div class="box-footer text-center">
                      <a href="<?php echo base_url(); ?>index.php/Users" class="uppercase">Pregled svih Korisnika</a>
                    </div><!-- /.box-footer -->
                  </div>
            </div>
        </div>

    </section>

</div>
