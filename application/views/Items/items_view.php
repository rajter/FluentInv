<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h1 class="box-title"><i class="fa fa-tag"></i> Artikli</h1>
                        <a href=<?php echo current_url().'/newItem' ?> class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Novi Artikl</a>
                    </div>
                    <!-- <?php echo var_dump($query); ?> -->
                    <div class="box-body">
                      <table id="items_table" class="table table-striped table-bordered" width="100%">
                              <thead>
                                  <tr>
                                      <th>#</th>
                                      <th style="width: 75px">Slika</th>
                                      <th style="width: 150px"><i class="fa fa-book" aria-hidden="true"></i> Ime</th>
                                      <th style="width: 400px"><i class="fa fa-binoculars" aria-hidden="true"></i> Opis</th>
                                      <th><i class="fa fa-money" aria-hidden="true"></i> Cijena</th>
                                      <th><i class="fa fa-key" aria-hidden="true"></i> Tip</th>
                                      <th style="width: 80px"><i class="fa fa-info" aria-hidden="true"></i> Status</th>
                                      <th style="width: 80px"><i class="fa fa-barcode" aria-hidden="true"></i> Kod</th>
                                      <th style="width: 250px"><i class="fa fa-gear" aria-hidden="true"></i> Opcije</th>
                                  </tr>
                              </thead>
                              <tbody>

                                  <?php foreach ($query as $item): ?>
                                      <tr>
                                          <td><?php echo $item->id; ?></td>
                                          <td class="text-center">
                                              <?php if(!empty($item->image)){ ?>
                                                    <img class="img img-responsive center-block" style="width: 75px; " id="image"
                                                    <?php
                                                    echo "src=".base_url()."assets/dropzone/uploads/".$item->image;
                                                    ?>>
                                              <?php }else {?>
                                                    <i class="fa fa-ban"></i>
                                              <?php }; ?>
                                          </td>
                                          <td><?php echo $item->name; ?></td>
                                          <td><?php echo substr($item->description, 0, 50); ?></td>
                                          <td><?php echo $item->price; ?></td>
                                          <td><?php echo $item->type; ?></td>
                                          <td><span <?php
                                                            if($item->item_status_id == 1){
                                                                echo "class='label label-success'";
                                                            }
                                                            elseif($item->item_status_id == 2){
                                                                echo "class='label label-warning'";
                                                            }
                                                            else {
                                                                echo "class='label label-danger'";
                                                            }
                                                    ?>><?php echo $item->status; ?></span></td>
                                          <td><?php echo $item->code; ?></td>
                                          <td>
                                              <div class="btn-group btn-group-xs">
                                                  <a href=<?php echo current_url().'/view/'.$item->id; ?> data-toggle="modal"
                                                    type="button" class="btn btn-info"><i class="fa fa-search"></i> Pregled</a>
                                                  <a href=<?php echo current_url().'/edit/'.$item->id; ?> type="button" class="btn btn-primary"><i class="fa fa-edit"></i> Uredi</a>
                                                  <button class="btn btn-danger item" id=<?php echo "item-".$item->id; ?> type="button" name="button"><i class="fa fa-trash-o"></i> Obriši</button>
                                                  <!-- <a href="#modal_delete_item" data-toggle="modal"
                                                    data-id=<?php echo $item->id; ?>
                                                    type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i> Obriši</a> -->
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

        <p class="hidden" id="base_url"><?php echo base_url(); ?></p>
        <?php
          $attributes = array('id' => 'ajaxform');
          echo form_open('', $attributes);
          echo form_close();
        ?>

        <!-- <div class="row">
          <div class="modal fade" id="modal_delete_item" role="dialog">
            <div class="modal-dialog">
              <!-- Modal content
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Obriši artikl</h4>
                </div>
                <div class="modal-body">
                  <p>Jest li sigurni da želite obrisati artikl: <b class="modal_item"></b></p>
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
        </div> -->

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
    <?php
        if(!empty($alert))
        {
            echo $alert;
        }
    ?>

</div>
