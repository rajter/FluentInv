<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
          <i class="fa fa-list"></i>
          Nova Inventura
          <small><?php // TODO: fali opis ?></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-ticket"></i> Fluent Inventory</a></li>
          <li class="active">Nova Inventura</li>
        </ol>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-body">
                    <?php echo form_open('stockTakings/Create'); ?>
                        <div class="row">

                            <div class="col-md-6">

                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <label>Datum:</label>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input class="form-control pull-right datepicker" id="datepicker" type="text" name="date"
                                                value=<?php echo date('Y-m-d'); ?>>
                                            </div>
                                            <!-- /.input group -->
                                        </div>

                                        <div class="form-group">
                                            <label>Lokacija:</label>
                                            <div class="input-group location">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-map-pin"></i>
                                                </div>
                                                <select  class="form-control" name="location">
                                                    <?php foreach ($locations as $location) {?>
                                                        <option value=<?php echo $location->id; ?>><?php echo $location->name;?></option>
                                                        <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="stock_taking_number">Inventurni broj:</label>
                                            <div class="input-group location">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-info"></i>
                                                </div>
                                                <input class="form-control" type="text" name="stock_taking_number" value="" placeholder="Jedinstven broj">
                                            </div>
                                        </div>

                                    </div>
                                </div><!--row-->
                            </div><!--col-md-6-->
                        </div><!--row-->

                        <div class="row">
                            <div class="col col-xs-12">

                                <div class="form-group">
                                    <label><i class="fa fa-sticky-note"></i> Napomena:</label>
                                    <textarea class="form-control" id="footnote" placeholder="Tekst Napomene" name="footnote"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 hidden" id="hidden_id"></div>
                        </div>

                        <div class="box-footer with-border">
                            <button class="btn btn-primary" id="kreiraj_btn" type="submit"> Kreiraj </button>
                        </div>

                    </form>
                    </div><!--box body-->
                </div><!--box-->
            </div><!--col-md-12-->
        </div><!--row-->

    </section>

</div>
