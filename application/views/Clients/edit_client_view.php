<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
          <i class="fa fa-map-marker"></i>  Klijent
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-map-marker"></i> LogTrack</a></li>
          <li class="active">Klijent</li>
        </ol>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-body">
                        <div class="row">
                            <!-- <?php echo var_dump($client); ?>
                            <?php echo var_dump($clientTypes); ?> -->
                            <?php echo form_open_multipart('clients/update'); ?>
                                <div class="col-md-6">
                                    <div class="box-body">
                                        <?php echo validation_errors(); ?>
                                        <input type="hidden" name="id" value=<?php echo $client->id ?>>
                                        <input type="hidden" name="address_id" value=<?php echo $client->address_id ?>>
                                        <div class="form-group">
                                            <label for="name">Ime</label>
                                            <input class="form-control" type="text" name="name" value="<?php echo $client->name; ?>" placeholder="Ime Novog Skladišta">
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Opis</label>
                                            <textarea class="form-control" name="description" rows="3" cols="40"><?php echo $client->description; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="clientType">Tip:</label><?php $clientTypeID = $client->client_type_id; ?></p>
                                            <select  class="form-control" name="clientType" id="type-select">
                                                <?php for ($i = 0; $i < count($clientTypes) ; $i++) {
                                                    if($clientTypeID == $i+1){?>
                                                        <option value=<?php echo $clientTypes[$i]->id; ?> selected><?php echo $clientTypes[$i]->type;?></option>
                                                    <?php }
                                                    else {?>
                                                        <option value=<?php echo $clientTypes[$i]->id; ?>><?php echo $clientTypes[$i]->type;?></option>
                                                    <?php }
                                                } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="tel">Tel</label>
                                            <input class="form-control" type="text" name="tel" value="<?php echo $client->tel; ?>" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="fax">Fax</label>
                                            <input class="form-control" type="text" name="fax" value="<?php echo $client->fax; ?>" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input class="form-control" type="text" name="email" value="<?php echo $client->email; ?>" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Adresa</label>
                                            <input class="form-control" type="text" name="address" value="<?php echo $client->address; ?>" placeholder="Adresa">
                                        </div>
                                        <div class="form-group">
                                            <label for="city">Grad</label>
                                            <input class="form-control" type="text" name="city" value="<?php echo $client->city; ?>" placeholder="Ime Grada">
                                        </div>
                                        <div class="form-group">
                                            <label for="zipcode">Pošta</label>
                                            <input class="form-control" type="text" name="zipcode" value="<?php echo $client->zipcode; ?>" placeholder="Poštanski broj npr. 40000 za Čakovec">
                                        </div>
                                        <div class="form-group">
                                            <label for="state">Pokrajina</label>
                                            <input class="form-control" type="text" name="state" value="<?php echo $client->state; ?>" placeholder="Ime Pokrajine npr. Međimurje">
                                        </div>
                                        <div class="form-group">
                                            <label for="country">Država</label>
                                            <input class="form-control" type="text" name="country" value="<?php echo $client->country; ?>" placeholder="Ime Države">
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
