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
                    <!-- <?php echo var_dump($avatars) ?> -->
                    <?php echo form_open('users/update'); ?>
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
                                            if($user->image == NULL){
                                                echo "src=''";
                                            }else{
                                                echo "src=".base_url()."assets/dist/img/".$user->image;
                                            }
                                            ?> alt="slika artikla">
                                            <input class="form-control hidden" id="input-avatar" type="text" name="avatar" value=<?php echo $user->image; ?>>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <input type="hidden" name="id" value=<?php echo $user->id; ?>>
                                    <div class="form-group <?php if($nameIsEmpty){ echo "has-error";} ?>">
                                        <label for="name">Ime</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </div>
                                            <input class="form-control" type="text" name="name" value=<?php echo $user->name; ?> placeholder="Ime">
                                        </div>
                                    </div>
                                    <div class="form-group <?php if($surnameIsEmpty){ echo "has-error";} ?>">
                                        <label for="surname">Prezime</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-user-o"></i>
                                            </div>
                                            <input class="form-control" type="text" name="surname" value=<?php echo $user->surname; ?> placeholder="Prezime">
                                        </div>
                                    </div>
                                    <div class="form-group <?php if($emailIsEmpty){ echo "has-error";} ?>">
                                        <label for="email">E-mail</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-envelope"></i>
                                            </div>
                                            <input class="form-control" type="email" name="email" value=<?php echo $user->email; ?> placeholder="e-mail">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group <?php if($usernameIsEmpty){ echo "has-error";} ?>">
                                <label for="username">Korisničko Ime</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-user-secret"></i>
                                    </div>
                                    <input class="form-control" type="text" name="username" value=<?php echo $user->username; ?> placeholder="Korisničko ime">
                                </div>
                            </div>

                            <div class="form-group <?php if($passwordIsEmpty){ echo "has-error";} ?>">
                                <label for="password">Lozinka</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                    <input class="form-control" type="password" name="" value="Stvarno si mislil da ce pisat lozinka :P" placeholder="password" readonly>
                                    <span class="input-group-btn">
                                        <a class="btn btn-danger btn-flat" type="button"
                                            href="#modal_password" data-toggle="modal"
                                            data-toggle="tooltip" data-placement="bottom" data-original-title="Resetiraj lozinku">
                                            <i class="fa fa-user-secret"></i>
                                        </a>
                                    </span>
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
                                            <?php if($user->UserTypeID == $type->id)
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
                            <button class="btn btn-primary" type="Submit" name="newEmployee">Spremi</button>
                        </div>
                    </form>
                </div><!--box-->
            </div><!--col-md-6-->
        </div><!--row-->

        <!-- MODALNI DIALOG ZA AVATARE -->
        <div class="row">
            <div class="modal fade" id="modal_choose_image" role="dialog">
                <div class="modal-dialog modal-lg">
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

        <!-- Modni dialog za promjenu lozinke -->
        <div class="row">
            <div class="modal fade" id="modal_password" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Upiši novu Lozinku</h4>
                    </div>
                    <div class="modal-body">
                        <input class="text-center form-control" id="input-password" type="password" name="password" value=""
                            style="font-size: 50px; height: 75px;">
                    </div>
                    <div class="modal-footer">
                        <?php
                            $attributes = array('id' => 'ajaxform');
                            echo form_open('', $attributes);
                        ?>
                        <input id="" name="user-id" type="hidden" value="<?php echo $user->id; ?>">
                        <button type="button" class="btn btn-primary" id="btn-change-password">Promjeni lozinku</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <?php echo form_close(); ?>
                        </form>
                    </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

</div>
