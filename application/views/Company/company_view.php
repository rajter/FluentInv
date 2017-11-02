<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content">

        <p class="hidden" id="base_url"><?php echo base_url(); ?></p>

        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header">
                        <!-- <h3 class="box-title"><i class="fa fa-tags"></i> Tipovi artikala</h3> -->
                        <!-- <a href=<?php echo current_url().'/newClient' ?> class="btn btn-primary"><i class="fa fa-plus"></i> Novi Klijent</a> -->
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="box box-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-aqua-active">
                                <h2><i class="fa fa-tag"></i> <?php echo $company->name; ?></h2>
                                <!-- <h5 class="widget-user-desc"> -->
                            </div>
                            <div class="widget-user-image">
                                <img class="" src=<?php echo base_url().'assets/images/Logo.png'; ?> alt="slika poduzeca" style="border:none;">
                            </div>
                            <div class="box-footer">
                              <div class="row">
                                <div class="col-sm-4 border-right">
                                  <div class="description-block">
                                    <h3 class="description-header"><?php echo count($users); ?></h3>
                                    <span class="description-text"><i class="fa fa-user"></i> ZAPOSLENI</span>
                                  </div>
                                  <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 border-right">
                                  <div class="description-block">
                                    <h3 class="description-header"><?php echo count($items); ?></h3>
                                    <span class="description-text"><i class="fa fa-tags"></i> ARTIKLI</span>
                                  </div>
                                  <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4">
                                  <div class="description-block">
                                    <h3 class="description-header">2017</h3>
                                    <span class="description-text"><i class="fa fa-user"></i> God. osnivanja</span>
                                  </div>
                                  <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                              </div>
                              <!-- /.row -->
                            </div>
                        </div>
                        </div>
                        <?php
                        $attributes = array('id' => 'ajaxform');
                        echo form_open('', $attributes);
                        echo form_close();
                        ?>

                        <!-- <?php echo var_dump($clients) ?> -->
                    </div><!--box body-->
                </div><!--box-->
            </div><!--col-md-12-->
        </div><!--row-->

        <div class="row">
            <div class="col col-md-4">
                <div class="box box-solid box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Podaci</h3>
                        <div class="box-tools pull-right">
                            <a class="btn btn-box-tool " href=<?php echo current_url().'/edit/'; ?>>
                                <i class="fa fa-edit"></i> Uredi
                            </a>
                        </div>
                    </div>
                    <div class="box-body">
                        <address style="margin:0px;">
                            Adresa: <?php echo $company->address; ?><br>
                            Poštanski broj: <?php echo $company->city.", ".$company->zipcode; ?><br>
                            Županija: <?php echo $company->state; ?><br>
                            Tel: <?php echo $company->tel; ?><br>
                            Fax: <?php echo $company->fax; ?><br>
                            Email: <?php echo $company->email; ?>
                        </address>
                    </div>
                </div>
            </div>
            <div class="col col-md-8">
                <div class="box box-solid box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Kontakti</h3>
                        <div class="box-tools pull-right">
                            <a class="btn btn-box-tool " href=<?php echo current_url().'/editContacts/'; ?>>
                                <i class="fa fa-edit"></i> Uredi
                            </a>
                        </div>
                    </div>
                    <div class="box-body">
                        <?php foreach ($contacts as $contact) { ?>
                            <p><strong><i class="fa fa-user"></i> Ime:</strong> <?php echo $contact->name." ".$contact->surname;?></p>
                            <p><strong><i class="fa fa-phone"></i> Tel:</strong>  <?php echo $contact->tel;?></p>
                            <p><strong><i class="fa fa-mobile-phone"></i> Mob:</strong>  <?php echo $contact->mob;?></p>
                            <p><strong><i class="fa fa-envelope"></i> E-mail:</strong>  <?php echo $contact->email;?></p>
                            <hr>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

    </section>

</div>
