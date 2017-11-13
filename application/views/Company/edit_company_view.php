<?php

    $nameIsEmpty = !empty(form_error('name'));
    $telIsEmpty = !empty(form_error('tel'));
    $faxIsEmpty = !empty(form_error('fax'));
    $emailIsEmpty = !empty(form_error('email'));
    $addressIsEmpty = !empty(form_error('address'));
    $cityIsEmpty = !empty(form_error('city'));
    $zipcodeIsEmpty = !empty(form_error('zipcode'));
    $stateIsEmpty = !empty(form_error('state'));

 ?>
<div class="content-wrapper">

    <section class="content-header">
        <h1>
          <i class="fa fa-map-marker"></i>  Poduzeće
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-map-marker"></i> LogTrack</a></li>
          <li class="active">Poduzeće</li>
        </ol>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-body">
                        <div class="row">
                            <!-- <?php echo var_dump($company); ?>-->
                            <?php echo form_open_multipart('company/update'); ?>
                                <div class="col-md-6">
                                    <div class="box-body">
                                        <input type="hidden" name="id" value=<?php echo $company->id ?>>
                                        <div class="form-group <?php if($nameIsEmpty){ echo "has-error";} ?>">
                                            <label for="name">Ime</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-building"></i>
                                                </div>
                                                <input class="form-control" type="text" name="name" value="<?php echo $company->name; ?>" placeholder="Ime Poduzeća">
                                            </div>
                                        </div>
                                        <div class="form-group <?php if($telIsEmpty){ echo "has-error";} ?>">
                                            <label for="tel">Tel</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-phone"></i>
                                                </div>
                                                <input class="form-control" type="text" name="tel" value="<?php echo $company->tel; ?>" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group <?php if($faxIsEmpty){ echo "has-error";} ?>">
                                            <label for="fax">Fax</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-fax"></i>
                                                </div>
                                                <input class="form-control" type="text" name="fax" value="<?php echo $company->fax; ?>" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group <?php if($emailIsEmpty){ echo "has-error";} ?>">
                                            <label for="email">Email</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-envelope"></i>
                                                </div>
                                                <input class="form-control" type="text" name="email" value="<?php echo $company->email; ?>" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group <?php if($addressIsEmpty){ echo "has-error";} ?>">
                                            <label for="address">Adresa</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-address-card"></i>
                                                </div>
                                                <input class="form-control" type="text" name="address" value="<?php echo $company->address; ?>" placeholder="Adresa">
                                            </div>
                                        </div>
                                        <div class="form-group <?php if($cityIsEmpty){ echo "has-error";} ?>">
                                            <label for="city">Grad</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-map-marker"></i>
                                                </div>
                                                <input class="form-control" type="text" name="city" value="<?php echo $company->city; ?>" placeholder="Ime Grada">
                                            </div>
                                        </div>
                                        <div class="form-group <?php if($zipcodeIsEmpty){ echo "has-error";} ?>">
                                            <label for="zipcode">Pošta</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-inbox"></i>
                                                </div>
                                                <input class="form-control" type="text" name="zipcode" value="<?php echo $company->zipcode; ?>" placeholder="Poštanski broj npr. 40000 za Čakovec">
                                            </div>
                                        </div>
                                        <div class="form-group <?php if($stateIsEmpty){ echo "has-error";} ?>">
                                            <label for="state">Pokrajina</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-map"></i>
                                                </div>
                                                <input class="form-control" type="text" name="state" value="<?php echo $company->state; ?>" placeholder="Ime Pokrajine npr. Međimurje">
                                            </div>
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
