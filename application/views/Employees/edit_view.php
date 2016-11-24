<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <br>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> LogTrack</a></li>
          <li class="active">Zaposlenik</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-user"></i> Zaposlenik</h3>
                    </div>
                    <?php echo form_open('employees/update'); ?>
                        <div class="box-body">
                            <?php echo validation_errors(); ?>
                            <input type="hidden" name="id" value=<?php echo $id ?>>
                            <div class="form-group">
                                <label for="name">Ime</label>
                                <input class="form-control" type="text" name="name" value=<?php echo $name; ?> placeholder="Ime">
                            </div>
                            <div class="form-group">
                                <label for="surname">Prezime</label>
                                <input class="form-control" type="text" name="surname" value=<?php echo $surname; ?> placeholder="Prezime">
                            </div>
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input class="form-control" type="email" name="email" value=<?php echo $email; ?> placeholder="e-mail">
                            </div>
                            <div class="form-group">
                                <label for="username">Korisničko Ime</label>
                                <input class="form-control" type="text" name="username" value=<?php echo $username; ?> placeholder="Korisničko ime">
                            </div>
                            <div class="form-group">
                                <label for="password">Lozinka</label>
                                <input class="form-control" type="password" name="password" value=<?php echo $password; ?> placeholder="password">
                            </div>
                            <div class="form-group">
                                <label for="role">Funkcija</label>
                                <input class="form-control" type="text" name="role" value=<?php echo $role; ?> placeholder="Funkcija">
                            </div>
                        </div><!--box body-->
                        <div class="box-footer with-border">
                            <button class="btn btn-primary" type="Submit" name="newEmployee">Spremi</button>
                        </div>
                    </form>
                </div><!--box-->
            </div><!--col-md-6-->
        </div><!--row-->
    </section>

</div>
