<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
          Zaposlenici
          <small>- <?php // TODO: fali opis ?></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> LogTrack</a></li>
          <li class="active">Zaposlenici</li>
        </ol>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title"><i class="fa fa-users"></i> Zaposlenici</h3>
                        <a href=<?php echo current_url().'/newEmployee' ?> class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Novi Zaposlenik</a>
                    </div>
                    <div class="box-body">
                      <table id="employee_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                              <thead>
                                  <tr>
                                      <th style="width: 75px">ID</th>
                                      <th>Ime</th>
                                      <th>Prezime</th>
                                      <th>Funkcija</th>
                                      <th style="width: 250px">Opcije</th>
                                  </tr>
                              </thead>
                              <tbody>

                                  <?php foreach ($query as $employee): ?>
                                      <tr>
                                          <td><?php echo $employee->id; ?></td>
                                          <td><?php echo $employee->name; ?></td>
                                          <td><?php echo $employee->surname; ?></td>
                                          <td><?php echo $employee->role; ?></td>
                                          <td>
                                              <div class="btn-group btn-group-xs">
                                                  <a href="#modal_view" data-toggle="modal"
                                                    data-id=<?php echo $employee->id; ?>
                                                    data-name=<?php echo $employee->name; ?>
                                                    data-surname=<?php echo $employee->surname; ?>
                                                    data-role=<?php echo $employee->role; ?>
                                                    type="button" class="btn btn-info"><i class="fa fa-search"></i> Pregled</a>
                                                  <a href=<?php echo current_url().'/edit/'.$employee->id; ?> type="button" class="btn btn-primary"><i class="fa fa-edit"></i> Uredi</a>
                                                  <a href="#modal_delete" data-toggle="modal"
                                                    data-id=<?php echo $employee->id; ?>
                                                    data-name=<?php echo $employee->name; ?>
                                                    data-surname=<?php echo $employee->surname; ?>
                                                    data-role=<?php echo $employee->role; ?>
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

        <div class="row">
          <div class="modal fade" id="modal_view" role="dialog">
            <div class="modal-dialog">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Pregled</h4>
                </div>
                <div class="modal-body">
                  <p>Ime: <b class="modal-name"></b></p>
                  <p>Prezime: <b class="modal-surname"></b></p>
                  <p>Funkcija: <b class="modal-role"></b></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </form>
                </div>
              </div>

            </div>
          </div>
        </div>
    </section>

</div>
