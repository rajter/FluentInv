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
                            <?php echo form_open_multipart('warehouses/update'); ?>
                                <div class="col-md-6">
                                    <div class="box-body">
                                        <?php echo validation_errors(); ?>
                                        <input type="hidden" name="id" value=<?php echo $warehouse->id ?>>
                                        <input type="hidden" name="address_id" value=<?php echo $warehouse->address_id ?>>
                                        <div class="form-group">
                                            <label for="name">Ime</label>
                                            <input class="form-control" type="text" name="name" value="<?php echo $warehouse->name; ?>" placeholder="Ime Novog Skladišta">
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Opis</label>
                                            <textarea class="form-control" name="description" rows="3" cols="40"><?php echo $warehouse->description; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Adresa</label>
                                            <input class="form-control" type="text" name="address" value="<?php echo $warehouse->address; ?>" placeholder="Adresa">
                                        </div>
                                        <div class="form-group">
                                            <label for="city">Grad</label>
                                            <input class="form-control" type="text" name="city" value="<?php echo $warehouse->city; ?>" placeholder="Ime Grada">
                                        </div>
                                        <div class="form-group">
                                            <label for="zipcode">Pošta</label>
                                            <input class="form-control" type="text" name="zipcode" value="<?php echo $warehouse->zipcode; ?>" placeholder="Poštanski broj npr. 40000 za Čakovec">
                                        </div>
                                        <div class="form-group">
                                            <label for="state">Pokrajina</label>
                                            <input class="form-control" type="text" name="state" value="<?php echo $warehouse->state; ?>" placeholder="Ime Pokrajine npr. Međimurje">
                                        </div>
                                        <div class="form-group">
                                            <label for="country">Država</label>
                                            <input class="form-control" type="text" name="country" value="<?php echo $warehouse->country; ?>" placeholder="Ime Države">
                                        </div>
                                    </div><!--box body-->
                                    <div class="box-footer with-border">
                                        <button class="btn btn-primary" type="Submit" name="newItem">Spremi</button>
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
