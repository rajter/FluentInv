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
                    <!-- <?php echo var_dump($user); ?> -->
                    <?php echo form_open('users/update'); ?>
                        <div class="box-body">
                            <?php echo validation_errors(); ?>
                            <input type="hidden" name="id" value=<?php echo $user->id; ?>>
                            <div class="form-group">
                                <label for="name">Ime</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <input class="form-control" type="text" name="name" value=<?php echo $user->name; ?> placeholder="Ime">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="surname">Prezime</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-user-o"></i>
                                    </div>
                                    <input class="form-control" type="text" name="surname" value=<?php echo $user->surname; ?> placeholder="Prezime">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <input class="form-control" type="email" name="email" value=<?php echo $user->email; ?> placeholder="e-mail">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="username">Korisničko Ime</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-user-secret"></i>
                                    </div>
                                    <input class="form-control" type="text" name="username" value=<?php echo $user->username; ?> placeholder="Korisničko ime">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password">Lozinka</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </div>
                                    <input class="form-control" type="password" name="password" value=<?php echo $user->password; ?> placeholder="password">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Skladište:</label>
                                <div class="input-group location">
                                    <div class="input-group-addon">
                                        <i class="fa fa-map-pin"></i>
                                    </div>
                                    <select  class="form-control" name="location">
                                        <?php foreach ($locations as $location) {?>
                                            <?php if($location->id == $user->location_id)
                                            {
                                                echo "<option value=".$location->id." selected>".$location->name."</option>";
                                            }
                                            else {
                                                echo "<option value=".$location->id.">".$location->name."</option>";
                                            }?>
                                        <?php } ?>
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
                            <button class="btn btn-primary" type="Submit" name="newEmployee">Spremi</button>
                        </div>
                    </form>
                </div><!--box-->
            </div><!--col-md-6-->
        </div><!--row-->
    </section>

</div>
