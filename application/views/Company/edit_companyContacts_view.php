<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
          <i class="fa fa-map-marker"></i>  Kontakti
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-map-marker"></i> LogTrack</a></li>
          <li class="active">Kontakti</li>
        </ol>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header">
                        <button id="btn-new-contact" class="btn btn-primary" type="button" name="button" data-toggle="tooltip"  data-placement="bottom" title="Novi Kontakt"><i class="fa fa-user-plus"></i></button>
                        <button id="btn-add-contact" class="btn btn-info" type="button" name="button" data-toggle="tooltip" data-placement="bottom" title="Dodaj postojeći kontakt"><i class="fa fa-archive"></i></button>

                    </div>
                    <div class="box-body">
                        <div class="row" id="company-contacts-list">
                            <!-- <?php echo var_dump($company); ?>-->
                                <?php for($i = 0; $i<count($CompanyContacts); $i++) { ?>
                                    <div class="col-md-3" id=<?php echo "contact-".$CompanyContacts[$i]->id; ?>>
                                        <div class="box box-solid box-primary">
                                            <!-- <div class="box-header with-border" style="background-color: #F001A5;"> -->
                                            <div class="box-header with-border">
                                                <h3 class="box-title"><i class="fa fa-user"></i> <?php echo $CompanyContacts[$i]->name." ".$CompanyContacts[$i]->surname;?></h3>
                                                <div class="box-tools pull-right">
                                                    <button class="btn btn-box-tool btn-edit-contact" data-toggle="tooltip" data-placement="bottom" title="Uredi"
                                                    id=<?php echo $CompanyContacts[$i]->id; ?>>
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-box-tool btn-remove-contact" type="button" name="button"
                                                    data-toggle="tooltip" data-placement="bottom" title="Makni Kontakt" id=<?php echo $CompanyContacts[$i]->id; ?>>
                                                        <i class="fa fa-remove"></i>
                                                    </button>
                                                </div><!-- /.box-tools -->
                                            </div><!-- /.box-header -->
                                            <div class="box-body">
                                                <p><strong><i class="fa fa-phone"></i> Tel:</strong>  <?php echo $CompanyContacts[$i]->tel;?></p>
                                                <p><strong><i class="fa fa-mobile-phone"></i> Mob:</strong>  <?php echo $CompanyContacts[$i]->mob;?></p>
                                                <p><strong><i class="fa fa-envelope"></i> E-mail:</strong>  <?php echo $CompanyContacts[$i]->email;?></p>
                                            </div><!-- /.box-body -->
                                        </div><!-- /.box -->
                                    </div><!--col-md-3-->
                                <?php }; ?>
                            </form>
                        </div><!-- row -->
                    </div><!--box body-->
                </div><!--box-->
            </div><!--col-md-12-->
        </div><!--row-->

        <p class="hidden" id="token">
            <?php echo $this->security->get_csrf_token_name(); ?>
        </p>
        <p class="hidden" id="hash">
            <?php echo $this->security->get_csrf_hash(); ?>
        </p>

        <?php
          $attributes = array('id' => 'ajaxform');
          echo form_open('', $attributes);
          echo form_close();
        ?>

        <!--*******************************-->
        <!--MODALNI DIALOG ODABIRA KONTAKTI-->
        <!--*******************************-->
        <div class="row">
          <div class="modal fade" id="modal_add_contact" role="dialog">
            <div class="modal-dialog modal-lg">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Popis Kontakti</h4>
                </div>
                <div class="modal-body">
                  <table id="add_contacts_table" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                              <thead>
                                  <tr>
                                      <th>ID</th>
                                      <th>Ime</th>
                                      <th>Prezime</th>
                                      <th>Tel</th>
                                      <th>Mob</th>
                                      <th>email</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php foreach ($contacts as $contact): ?>
                                      <tr class="contact_row">
                                        <td id="contact_id"><?php echo $contact->id; ?></td>
                                        <td id="contact_name"><?php echo $contact->name; ?></td>
                                        <td id="contact_surname"><?php echo $contact->surname; ?></td>
                                        <td id="contact_tel"><?php echo $contact->tel; ?></td>
                                        <td id="contact_mob"><?php echo $contact->mob; ?></td>
                                        <td id="contact_email"><?php echo $contact->email; ?></td>
                                      </tr>
                                  <?php endforeach; ?>
                              </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <input id="id" type="hidden" name="id" value="">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>

            </div>
          </div>
      </div><!--ROW-->

    </section>

</div>
