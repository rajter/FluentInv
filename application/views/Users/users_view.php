<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
          Korisnici
          <small><?php // TODO: fali opis ?></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> LogTrack</a></li>
          <li class="active">Korisnici</li>
        </ol>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title"><i class="fa fa-users"></i> Korisnici</h3>
                        <a href=<?php echo current_url().'/newUser' ?> class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Novi Korisnik</a>
                    </div>
                    <!-- <?php echo var_dump($query); ?> -->
                    <div class="box-body">
                      <table id="users_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                              <thead>
                                  <tr>
                                      <th style="width: 75px">ID</th>
                                      <th style="width: 75px">Slika</th>
                                      <th>Ime</th>
                                      <th>Prezime</th>
                                      <th>Tip Korisnika</th>
                                      <th>Skladište</th>
                                      <th style="width: 250px">Opcije</th>
                                  </tr>
                              </thead>
                              <tbody>

                                  <?php foreach ($query as $user): ?>
                                      <tr>
                                          <td><?php echo $user->id; ?></td>
                                          <td class="text-center">
                                              <?php if(!empty($user->image)){ ?>
                                                    <img class="img img-responsive center-block" style="width: 75px; " id="image"
                                                    <?php
                                                    echo "src=".base_url()."assets/dropzone/uploads/".$user->image;
                                                    ?>>
                                              <?php }else {?>
                                                    <i class="fa fa-ban"></i>
                                              <?php }; ?>
                                          </td>
                                          <td><?php echo $user->name; ?></td>
                                          <td><?php echo $user->surname; ?></td>
                                          <td><?php echo $user->UserType; ?></td>
                                          <td><?php echo $user->warehouse; ?></td>
                                          <td>
                                              <div class="btn-group btn-group-xs">
                                                  <a href=<?php echo current_url().'/view/'.$user->id; ?> type="button" class="btn btn-info"><i class="fa fa-search"></i> Pregled</a>
                                                  <a href=<?php echo current_url().'/edit/'.$user->id; ?> type="button" class="btn btn-primary"><i class="fa fa-edit"></i> Uredi</a>
                                                  <a href="#modal_delete" data-toggle="modal"
                                                    data-id=<?php echo $user->id; ?>
                                                    data-name=<?php echo $user->name; ?>
                                                    data-surname=<?php echo $user->surname; ?>
                                                    data-role=<?php echo $user->role; ?>
                                                    type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i> Obriši</a>
                                              </div>
                                          </td>
                                      </tr>
                                  <?php endforeach; ?>
                              </tbody>
                          </table>
                    </div><!--box body-->
                </div><!--box-->
            </div><!--col-md-12-->
        </div><!--row-->

        <div class="row">
          <div class="modal fade" id="modal_delete" role="dialog">
            <div class="modal-dialog">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Obriši zaposlenika</h4>
                </div>
                <div class="modal-body">
                  <p>Jest li sigurni da želite obrisati zaposlenika: <b class="modal-zaposlenik"></b></p>
                </div>
                <div class="modal-footer">
                  <?php
                    $attributes = array('id' => 'delete_form');
                    echo form_open('', $attributes);
                  ?>
                    <input id="id" type="hidden" name="id" value="">
                    <button type="submit" class="btn btn-danger "name="button" id="id_btn">Obrisi</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </form>
                </div>
              </div>

            </div>
          </div>
        </div>

    </section>

</div>
