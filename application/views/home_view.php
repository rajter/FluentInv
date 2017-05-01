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
                <p>Ukupno artikala</p>
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
                <h3>#<?php echo $receiptCount; ?></h3>
                <p>Primke</p>
              </div>
              <div class="icon">
                <i class="fa fa-book"></i>
              </div>
              <a href="<?php echo base_url(); ?>index.php/Receipts" class="small-box-footer">Više informacija <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-md-3 col-sm-6 col-sx-12">
            <div class="small-box bg-red">
              <div class="inner">
                <h3>#<?php echo $issueCount; ?></h3>
                <p>Izdatnice</p>
              </div>
              <div class="icon">
                <i class="fa fa-external-link"></i>
              </div>
              <a href="<?php echo base_url(); ?>index.php/Issues" class="small-box-footer">Više informacija <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-md-3 col-sm-6 col-sx-12">
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3>#<?php echo $transferNoteCount ?></h3>
                <p>Međuskladišnice</p>
              </div>
              <div class="icon">
                <i class="fa fa-exchange"></i>
              </div>
              <a href="<?php echo base_url(); ?>index.php/Transfers" class="small-box-footer">Više informacija <i class="fa fa-arrow-circle-right"></i></a>
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
                          <th><i class="fa fa-archive"></i> Tip</th>
                          <th><i class="fa fa-tags"></i> Broj</th>
                          <th><i class="fa fa-user"></i> Klijent</th>
                          <th><i class="fa fa-map-pin"></i> Lokacija</th>
                          <th><i class="fa fa-user"></i> Korisnik</th>
                          <th><i class="fa fa-calendar"></i> Datum</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php foreach ($latestTransactions as $trans) {
                              $label = "success";
                              $transactionType = 'Receipts';
                              switch ($trans->transaction_type_id) {
                                  case '1':
                                      $label = "label label-success";
                                      $transactionType = 'Receipts';
                                      break;
                                  case '2':
                                      $label = "label label-danger";
                                      $transactionType = 'Issues';
                                      break;
                                  case '3':
                                      $label = "label label-warning";
                                      $transactionType = 'Transfers';
                                      break;
                                  default:
                                      $label = "label label-success";
                                      $transactionType = 'Receipts';
                                      break;
                              }
                              ?>
                              <tr>
                                  <td><span class="<?php echo $label; ?>"><?php echo $trans->description; ?></span></td>
                                  <td><a href="<?php echo base_url().'index.php/'.$transactionType.'/view/'.$trans->transaction_number; ?>"><?php echo $trans->transaction_number; ?></a></td>
                                  <td><?php echo $trans->Client; ?></td>
                                  <td><?php echo $trans->Location; ?></td>
                                  <td><?php echo $trans->Name." ".$trans->Surname; ?></td>
                                  <td><?php echo $trans->date; ?></td>
                              </tr>
                          <?php } ?>
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
                      <h3 class="box-title">Zaposlenici</h3>
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
                                <a class="users-list-name" href="#"><?php echo $user->name;?></a>
                                <span class="users-list-date"><?php echo $user->login_date; ?></span>
                            </li>
                          <?php } ?>

                      </ul><!-- /.users-list -->
                    </div><!-- /.box-body -->
                    <div class="box-footer text-center">
                      <a href="<?php echo base_url(); ?>index.php/Employees" class="uppercase">Pregled svih Zaposlenika</a>
                    </div><!-- /.box-footer -->
                  </div>
            </div>
        </div>

    </section>

</div>
