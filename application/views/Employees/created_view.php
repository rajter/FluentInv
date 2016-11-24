<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <br>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> LogTrack</a></li>
          <li class="active">Novi Zaposlenik</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-user"></i> Novi Zaposlenik</h3>
                    </div>
                    <div class="box box-body">
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Korisnik <?php echo $newEmployee; ?> uspješno kreiran!</h4>
                            Možete otići natrag na pregled svih zaposlenika ili imate mogućnost kreiranja novog.
                        </div>
                        <a href=<?php echo site_url().'/employees' ?> class="btn btn-default"><i class="fa fa-backward"></i> Natrag na pregled</a>
                        <a href=<?php echo site_url().'/employees/newEmployee' ?> class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Novi Zaposlenik</a>
                    </div>
                </div><!--box-->
            </div><!--col-md-6-->
        </div><!--row-->
    </section>

</div>
