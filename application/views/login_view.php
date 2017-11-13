 <style type="text/css">
 html, body{
   height:100%;
   margin:0;
   padding:0;
   background-color: #ECF0F5;
 }

.container-login{
  height:75%;
  display:table;
  position: relative;
  top: 15%;
  width: 100%;
  padding: 0;
  padding-top: 5px;
  max-width: 400px;
  margin: auto auto auto auto;
}

.row-fluid {
  /*height: 100%;
  display:table-cell;
  vertical-align: middle;*/
  /*padding: 50px 35px 35px 35px;
  margin: 0px 0px;
  background-color: #222D32;
  /*background-color: #3498DB;*/
  /*border-radius: 8px;*/
}

.centering {
  float:none;
  margin:0 auto;
}

.form-control{
  font-size: 16px;
  height: 40px;
  margin: 0px 0px 10px 0px;
  border-radius: 3px;
}

hr{
   border: 0; height: 1px; background-image: linear-gradient(to right, rgba(0, 0, 0, 0), #286090, rgba(0, 0, 0, 0));
}
</style>

<body>

<?php
    $avatarIsEmpty = empty(set_value('avatar'));
    $nameIsEmpty = !empty(form_error('name'));
?>

<div class="container-login">

    <div class="row-fluid">
        <div class="centering text-center">
          <?php
            $attributes = array('class' => 'form-signin', 'role' => 'form');
            echo form_open('verifylogin', $attributes);
          ?>
            <img class="img-responsive center-block" style="width:75%;" src=<?php echo base_url().'assets/images/Logo.png'; ?> alt="" />
            <h1 class="form-signin-heading" style="text-align: center; color: #37779D;"><b>Fluent</b> Inventory</h1>
            <hr>
            <div class="row">
                <div class="col-md-8 col-md-offset-2 col-xs-8 col-xs-offset-2">
                    <label for="username" class="sr-only">Email address</label>
                    <input class="form-control" id="username" name="username" type="text" value="" placeholder="Username" required="">
                    <label for="password" class="sr-only">Password</label>
                    <input class="form-control" type="password" id="password" name="password" placeholder="Password" required="">
                    <button style="background-color: #3C8DBC;" class="btn btn-lg btn-primary btn-block" type="submit">Log in</button>
                </div>
            </div>
            <br>
            <?php if(!empty(validation_errors())): ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger" role="alert"><?php echo validation_errors(); ?></div>
                </div>
            </div>
            <?php endif; ?>
          </form>
        </div>
    </div>
</div>
<!-- <h1>Base url =<?php echo base_url(); ?></h1> -->

 </body>
