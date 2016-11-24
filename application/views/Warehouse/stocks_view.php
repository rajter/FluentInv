<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
          Stanje Zaliha
          <small>- <?php // TODO: fali opis ?></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-ticket"></i> FluentInventory</a></li>
          <li class="active">Stanje Zaliha</li>
        </ol>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title"><i class="fa fa-ticket"></i> Stanje Zaliha</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">

                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="Warehouse">Skladište:</label>
                                    <select  class="form-control" name="location">
                                        <?php foreach ($locations as $location) {?>
                                            <option value=<?php echo $location->id; ?>><?php echo $location->name;?></option>
                                            <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="form-group">
                                            <label for="Date">Od: </label>
                                            <input class="form-control pull-right datepicker" id="from_datepicker" type="text" name="date"
                                            value=<?php echo date('Y-m-d'); ?>>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="form-group">
                                            <label for="Date">Do: </label>
                                            <input class="form-control pull-right datepicker" id="to_datepicker" type="text" name="date"
                                            value=<?php echo date('Y-m-d'); ?>>
                                        </div>
                                    </div>
                                    <div class="col-xs-2">
                                        <!-- <div class="form-group"> -->
                                        <label for="">Komande:</label>
                                        <div class="btn-group btn-group-justified" role="group" aria-label="...">
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-primary form-control" type="button" name="button"><i class="fa fa-search"></i></button>
                                            </div>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-warning form-control" type="button" name="button"><i class="fa fa-ban"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--row-->
                        <br>
                        <div class="row">
                            <div class="col-xs-12">
                                <table class="table table-hover table-striped" id="stocks_table">
                                    <thead>
                                        <th>#</th>
                                        <th>Datum</th>
                                        <th>Korisnik</th>
                                        <th>Opcije</th>
                                    </thead>
                                    <tbody>
                                        <td>16-000001</td>
                                        <td>2016-11-05</td>
                                        <td>Admin</td>
                                        <td></td>
                                    </tbody>
                                </table>
                            </div>
                        </div><!--row-->

                    </div><!--box body-->
                </div><!--box-->
            </div><!--col-md-12-->
        </div><!--row-->


    </section>

</div>
