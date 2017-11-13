<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <p class="hidden" id="base_url"><?php echo base_url(); ?></p>

    <section class="content-header">
        <h1>
          <i class="fa fa-book"></i>
          Transakcije
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-ticket"></i> FluentInventory</a></li>
          <li class="active">Transakcije</li>
        </ol>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header">
                        <!-- <h3 class="box-title"><i class="fa fa-ticket"></i> Primke</h3> -->
                        <!-- <a href=<?php echo current_url().'/newReceipt' ?> class="btn btn-primary"><i class="fa fa-plus"></i> Nova Primka</a> -->
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <table id="transactions_table" class="table table-bordered table-hover table-striped" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <!-- <th style="width: 40px">ID</th>
                                        <th ><i class="fa fa-file-o"></i> Broj</th> -->
                                        <th style="width: 70px;"><i class="fa fa-image"></i> Artikl</th>
                                        <th class="hidden">Artikl</th>
                                        <th style="width: 100px;"><i class="fa fa-user"></i> Izdao</th>
                                        <th style="width: 100px;"><i class="fa fa-address-card-o"></i> Dužnik</th>
                                        <th style="width: 150px;"><i class="fa fa-calendar"></i> Izdano</th>
                                        <th style="width: 150px;"><i class="fa fa-calendar-times-o"></i> Rok vraćanja</th>
                                        <th style="width: 150px;"><i class="fa fa-calendar-check-o"></i> Vraćeno</th>
                                        <th ><i class="fa fa-commenting-o"></i> Napomena</th>
                                        <th ><i class="fa fa-info"></i> Status</th>
                                        <th style="width: 115px"><i class="fa fa-gears"></i> Opcije</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($transactions as $trans): ?>
                                        <tr id="<?php echo "transaction-row-".$trans->id; ?>">
                                            <!-- <td><?php echo $trans->id; ?></td> -->
                                            <!-- <td><?php echo var_dump($trans); ?></td> -->
                                            <td>
                                                <a href="<?php echo base_url().'index.php/items/view/'.$trans->item_id; ?>" target="_blank">
                                                    <img class="media-object"
                                                    <?php
                                                    if($trans->image == NULL){
                                                        echo "src=''";
                                                    }else{
                                                        echo "src=".base_url()."assets/dropzone/uploads/".$trans->image;
                                                    }
                                                    ?>
                                                    alt="slika artikla" style="width: 50px; height:50px;">
                                                </a>
                                                <strong class="text-muted"><?php echo $trans->name; ?></strong>
                                            </td>
                                            <td class="hidden"><?php echo $trans->name . " - " . $trans->description; ?></td>
                                            <td>
                                                <a href="<?php echo base_url().'index.php/users/view/'.$trans->userID; ?>" target="_blank">
                                                    <img class="img img-thumbnail"
                                                    data-toggle="tooltip"  data-placement="bottom" title="<?php echo $trans->user; ?>"
                                                    <?php
                                                    if($trans->image == NULL){
                                                        echo "src=''";
                                                    }else{
                                                        echo "src=".base_url()."assets/dropzone/uploads/".$trans->userImage;
                                                    }
                                                    ?>
                                                    alt="slika artikla" style="width: 50px; height:50px;">
                                                </a>
                                                <b class="text-primary"><?php echo $trans->user; ?> </b>
                                            </td>
                                            <td>
                                                <a href="<?php echo base_url().'index.php/users/view/'.$trans->debtorID; ?>" target="_blank">
                                                    <img class="img img-thumbnail"
                                                    data-toggle="tooltip"  data-placement="bottom" title="<?php echo $trans->debtor; ?>"
                                                    <?php
                                                    if($trans->image == NULL){
                                                        echo "src=''";
                                                    }else{
                                                        echo "src=".base_url()."assets/dropzone/uploads/".$trans->debtorImage;
                                                    }
                                                    ?>
                                                    alt="slika artikla" style="width: 50px; height:50px;">
                                                </a>
                                                <b class="text-primary"><?php echo $trans->debtor; ?> </b>
                                            </td>
                                            <td><?php echo date('Y-m-d', strtotime($trans->date_taken)); ?></td>
                                            <td><?php echo date('Y-m-d', strtotime($trans->deadline)); ?></td>
                                            <td>
                                                <?php if($trans->status == 1){ echo date('Y-m-d', strtotime($trans->date_returned)); }else{ echo "/"; }?>
                                            </td>
                                            <td><?php echo substr($trans->footnote, 0, 50)." ..."; ?></td>
                                            <td><?php
                                                    switch($trans->status)
                                                    {
                                                        case 0:
                                                            echo "<span class='label label-danger'>Zaduženo</span>";
                                                        break;
                                                        case 1:
                                                            echo "<span class='label label-success'>Vraćeno</span>";
                                                        break;
                                                        default:
                                                            echo "<span class='label label-warning'>Zaduženo</span>";
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-xs">
                                                    <!-- <?php if($trans->status == 1) ?> -->
                                                    <a href="<?php echo base_url().'index.php/transactions/view/'.$trans->id; ?>"
                                                    data-toggle="tooltip"  data-placement="bottom" title="Pregled"
                                                    type="button" class="btn btn-info"><i class="fa fa-search"></i></a>
                                                    <a href="<?php echo base_url().'index.php/transactions/edit/'.$trans->id; ?>"
                                                        data-toggle="tooltip"  data-placement="bottom" title="Uredi"
                                                        type="button" class=
                                                            <?php
                                                                if($trans->status == 1)
                                                                {
                                                                    echo "'btn btn-success disabled'";
                                                                }
                                                                else
                                                                {
                                                                    echo "'btn btn-success'";
                                                                }
                                                            ?>
                                                         ><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger transaction_modal_delete" id="btn-delete-transaction"
                                                        data-transactionID=<?php echo $trans->id; ?> title="Obriši"
                                                        data-item-image=<?php echo $trans->image; ?>
                                                        data-item-name=<?php echo $trans->name; ?>>
                                                        <i class="fa fa-trash-o"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                            </table>
                        </div>
                    </div><!--box body-->
                </div><!--box-->
            </div><!--col-md-12-->
        </div><!--row-->

    </section>

</div>
