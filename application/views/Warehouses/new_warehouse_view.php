<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
          <i class="fa fa-map-marker"></i>  Novo Skladište
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-map-marker"></i> LogTrack</a></li>
          <li class="active">Novo Skladište</li>
        </ol>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-body">
                        <div class="row">
                            <?php echo form_open_multipart('warehouses/create'); ?>
                                <div class="col-md-6">
                                    <div class="box-body">
                                        <?php echo validation_errors(); ?>
                                        <div class="form-group">
                                            <label for="name">Ime</label>
                                            <input class="form-control" type="text" name="name" value="" placeholder="Ime Novog Skladišta">
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Opis</label>
                                            <textarea class="form-control" name="description" rows="3" cols="40"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Adresa</label>
                                            <input class="form-control" type="text" name="address" value="" placeholder="Adresa">
                                        </div>
                                        <div class="form-group">
                                            <label for="city">Grad</label>
                                            <input class="form-control" type="text" name="city" value="" placeholder="Ime Grada">
                                        </div>
                                        <div class="form-group">
                                            <label for="zipcode">Pošta</label>
                                            <input class="form-control" type="text" name="zipcode" value="" placeholder="Poštanski broj npr. 40000 za Čakovec">
                                        </div>
                                        <div class="form-group">
                                            <label for="state">Pokrajina</label>
                                            <input class="form-control" type="text" name="state" value="" placeholder="Ime Pokrajine npr. Međimurje">
                                        </div>
                                        <div class="form-group">
                                            <label for="country">Država</label>
                                            <input class="form-control" type="text" name="country" value="" placeholder="Ime Države">
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

    </section>

</div>
