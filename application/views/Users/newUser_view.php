<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <br>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> LogTrack</a></li>
          <li class="active">Novi Korisnik</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-user"></i> Novi Korisnik</h3>
                    </div>
                    <?php echo form_open('users/create'); ?>
                        <div class="box-body">
                            <?php echo validation_errors(); ?>
                            <!-- <input type="hidden" name="id" value=<?php echo $user->id; ?>> -->
                            <div class="form-group">
                                <label for="name">Ime</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <input class="form-control" type="text" name="name" value="" placeholder="Ime">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="surname">Prezime</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-user-o"></i>
                                    </div>
                                    <input class="form-control" type="text" name="surname" value="" placeholder="Prezime">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <input class="form-control" type="email" name="email" value="" placeholder="e-mail">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="username">Korisničko Ime</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-user-secret"></i>
                                    </div>
                                    <input class="form-control" type="text" name="username" value="" placeholder="Korisničko ime">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password">Lozinka</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </div>
                                    <input class="form-control" type="password" name="password" value="" placeholder="Lozinka">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Skladište:</label>
                                <div class="input-group location">
                                    <div class="input-group-addon">
                                        <i class="fa fa-map-pin"></i>
                                    </div>
                                    <select  class="form-control" name="location">
                                        <?php foreach ($locations as $location) {
                                                echo "<option value=".$location->id.">".$location->name."</option>";
                                            }
                                        ?>
                                        </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Tip Korisnika:</label>
                                <div class="input-group location">
                                    <div class="input-group-addon">
                                        <i class="fa fa-gears"></i>
                                    </div>
                                    <select  class="form-control" name="user_type">
                                        <?php foreach ($userTypes as $type) {?>
                                            <?php if($type->id == $user->user_type_id)
                                            {
                                                echo "<option value=".$type->id." selected>".$type->name."</option>";
                                            }
                                            else {
                                                echo "<option value=".$type->id.">".$type->name."</option>";
                                            }?>
                                        <?php } ?>
                                        </select>
                                </div>
                            </div>
                            
                        </div><!--box body-->
                        <div class="box-footer with-border">
                            <button class="btn btn-primary" type="Submit" name="newEmployee">Kreiraj</button>
                        </div>
                    </form>
                </div><!--box-->
            </div><!--col-md-6-->
        </div><!--row-->
    </section>

</div>
