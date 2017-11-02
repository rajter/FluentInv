<?php

    $avatarIsEmpty = empty(set_value('avatar'));
    $nameIsEmpty = !empty(form_error('name'));
    $surnameIsEmpty = !empty(form_error('surname'));
    $emailIsEmpty = !empty(form_error('email'));
    $usernameIsEmpty = !empty(form_error('username'));
    $passwordIsEmpty = !empty(form_error('password'));

    $userTypeId = set_value('user_type');

 ?>
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

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="image">Slika</label>
                                        <div class="input-group">
                                            <a class="input-group-addon btn btn-success" id="btn-choose-image" href="#modal_choose_image" data-toggle="modal">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <img class="img img-responsive form-controls" id="image-avatar" style="border-style: solid; border-width:1px; padding:1px; border-color: #D2D6DE;"
                                            <?php
                                                if($avatarIsEmpty)
                                                {
                                                    echo "src=".base_url()."assets/dist/img/".$avatars[0];
                                                }
                                                else
                                                {
                                                    echo "src=".base_url()."assets/dist/img/".set_value('avatar');
                                                }
                                            ?> alt="slika artikla">
                                            <input class="form-control" id="input-avatar" type="text" name="avatar" value="<?php if($avatarIsEmpty){ echo $avatars[0]; }else{ echo set_value('avatar'); } ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <input type="hidden" name="id" value="">
                                    <div class="form-group <?php if($nameIsEmpty){ echo "has-error";} ?>">
                                        <label for="name">Ime <?php if($nameIsEmpty){ echo "- ne smije biti prazno!";} ?></label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </div>
                                            <input class="form-control" type="text" name="name" value="<?php echo set_value('name'); ?>" placeholder="Ime">
                                        </div>
                                    </div>
                                    <div class="form-group <?php if($surnameIsEmpty){ echo "has-error";} ?>">
                                        <label for="surname">Prezime <?php if($surnameIsEmpty){ echo "- ne smije biti prazno!";} ?></label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-user-o"></i>
                                            </div>
                                            <input class="form-control" type="text" name="surname" value="<?php echo set_value('surname'); ?>" placeholder="Prezime">
                                        </div>
                                    </div>
                                    <div class="form-group <?php if($emailIsEmpty){ echo "has-error";} ?>">
                                        <label for="email">E-mail <?php if($emailIsEmpty){ echo "- ne smije biti prazno!";} ?></label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-envelope"></i>
                                            </div>
                                            <input class="form-control" type="email" name="email" value="<?php echo set_value('email'); ?>" placeholder="e-mail">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group <?php if($usernameIsEmpty){ echo "has-error";} ?>">
                                <label for="username">Korisničko Ime <?php if($usernameIsEmpty){ echo "- ne smije biti prazno!";} ?></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-user-secret"></i>
                                    </div>
                                    <input class="form-control" type="text" name="username" value="<?php echo set_value('username'); ?>" placeholder="Korisničko ime">
                                </div>
                            </div>

                            <div class="form-group <?php if($passwordIsEmpty){ echo "has-error";} ?>">
                                <label for="password">Lozinka <?php if($passwordIsEmpty){ echo "- ne smije biti prazno!";} ?></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </div>
                                    <input class="form-control" type="password" name="password" value="" placeholder="Lozinka">
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
                                            <?php if($userTypeId == $type->id)
                                            {
                                                echo "<option value=".$type->id." selected>".$type->description."</option>";
                                            }
                                            else {
                                                echo "<option value=".$type->id.">".$type->description."</option>";
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

        <!-- MODALNI DIALOG ZA AVATARE -->
        <div class="row">
            <div class="modal fade" id="modal_choose_image" role="dialog">
                <div class="modal-dialog modal-lg">
                  <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Slike</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <?php foreach ($avatars as $avatar): ?>
                                    <div class="col-md-4">
                                        <img class="img img-resposive img-thumbnail avatar"
                                        <?php echo "src=".base_url()."assets/dist/img/".$avatar; ?>
                                        alt=""
                                        data-name="<?php echo $avatar; ?>">
                                    </div>
                                <?php endforeach; ?>
                            </div>
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
