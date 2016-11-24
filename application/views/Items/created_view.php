<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <br>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> LogTrack</a></li>
          <li class="active">Novi Artikl</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-user"></i> Novi Artikl</h3>
                    </div>
                    <div class="box box-body">
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Artikl <?php echo $newItem; ?> uspješno kreiran!</h4>
                            Možete otići natrag na pregled svih artikala ili imate mogućnost kreiranja novog.
                        </div>
                        <a href=<?php echo site_url().'/items' ?> class="btn btn-default"><i class="fa fa-backward"></i> Natrag na pregled</a>
                        <a href=<?php echo site_url().'/items/newItem' ?> class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Novi Artikl</a>
                    </div>
                </div><!--box-->
            </div><!--col-md-6-->
            <div class="col-md-6">
                <h1><?php if($created){ echo 'created'; } ?></h1>
            </div>
        </div><!--row-->
    </section>

</div>
