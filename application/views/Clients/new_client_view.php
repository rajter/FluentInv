<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
          <i class="fa fa-map-marker"></i>  Novi Klijent
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-map-marker"></i> LogTrack</a></li>
          <li class="active">Novi Klijent</li>
        </ol>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-body">
                        <div class="row">
                            <?php echo form_open_multipart('clients/create'); ?>
                                <div class="col-md-6">
                                    <div class="box-body">
                                        <?php echo validation_errors(); ?>
                                        <div class="form-group">
                                            <label for="name">Ime</label>
                                            <input class="form-control" type="text" name="name" value="" placeholder="Ime Novog Klijenta">
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Opis</label>
                                            <textarea class="form-control" name="description" rows="3" cols="40" placeholder="Kratki opis"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="clientType">Tip:</label>
                                            <select  class="form-control" name="clientType" id="type-select">
                                                <?php for ($i = 0; $i < count($clientTypes) ; $i++) {?>
                                                        <option value=<?php echo $clientTypes[$i]->id; ?>><?php echo $clientTypes[$i]->type;?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="tel">Tel</label>
                                            <input class="form-control" type="text" name="tel" value="" placeholder="Tel">
                                        </div>
                                        <div class="form-group">
                                            <label for="fax">Fax</label>
                                            <input class="form-control" type="text" name="fax" value="" placeholder="Fax">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input class="form-control" type="text" name="email" value="" placeholder="Email">
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
                                </div><!--col-md-6-->
                                <div class="box-footer with-border">
                                    <button class="btn btn-primary" type="Submit" name="newItem">Kreiraj</button>
                                </div>
                            </form>
                        </div><!-- row -->
                    </div><!--box body-->
                </div><!--box-->
            </div><!--col-md-12-->
        </div><!--row-->

    </section>

</div>
