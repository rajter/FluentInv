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
  max-width: 400px;
  margin: auto auto auto auto;
}

.row-fluid {
  /*height: 100%;
  display:table-cell;
  vertical-align: middle;*/
  padding: 100px 35px 35px 35px;
  margin: 0px 0px;
  background-color: #3498DB;
  border-radius: 8px;
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

<div class="container-login">
	<?php echo validation_errors(); ?>

    <div class="row-fluid">
        <div class="centering text-center">
          <?php
            $attributes = array('class' => 'form-signin', 'role' => 'form');
            echo form_open('verifylogin', $attributes);
          ?>
          <!--<form class="form-signin" role="form" method="POST" action="<?php echo base_url();?>index.php/verifylogin">-->
            <h1 class="form-signin-heading" style="text-align: center; color: #FFFFFF;"><b>Fluent</b> Inventory</h1>
            <hr>
            <label for="username" class="sr-only">Email address</label>
            <input class="form-control" id="username" name="username" type="text" value="" placeholder="Username" required="" autofocus=""  >
            <label for="password" class="sr-only">Password</label>
            <input class="form-control" type="password" id="password" name="password" placeholder="Password" required="">
            <div class="checkbox pull-left">
              <label  style="color: #FFFFFF;">
                <input value="remember-me" type="checkbox"> Remember me
              </label>
            </div>
            <button style="background-color: #357CA5;" class="btn btn-lg btn-primary btn-block" type="submit">Log in</button>
          </form>
        </div>
    </div>
</div>
<!-- <h1>Base url =<?php echo base_url(); ?></h1>    -->

 </body>
