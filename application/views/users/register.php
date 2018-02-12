 <br />
 <div class="row">
  <div class="col-lg-6 col-lg-offset-3">
  <div class="col-lg-12">
   <div class="well bs-component">
  <fieldset>
    <legend class="text-center"><?= $title ?></legend>
    <?php echo form_open('users/register'); ?>
    <div class="form-group">
      <label for="inputFirstName" class="control-label">First Name</label>
      <div>
        <input type="text" class="form-control" name="first_name" placeholder="First Name">
        <?php echo form_error('first_name', '<p class="text-danger error">', '</p>'); ?>
      </div>
    </div>
    <div class="form-group">
      <label for="inputLastName" class="control-label">Last Name</label>
      <div>
        <input type="text" class="form-control" name="last_name" placeholder="Last Name">
        <?php echo form_error('last_name', '<p class="text-danger error">', '</p>'); ?>
      </div>
    </div>
    <div class="form-group">
      <label for="inputUsername" class="control-label">Username</label>
      <div>
        <input type="text" class="form-control" name="username" placeholder="Enter Username">
        <?php echo form_error('username', '<p class="text-danger error">', '</p>'); ?>
      </div>
    </div>
    <div class="form-group">
      <label for="inputEmail" class="control-label">Email</label>
      <div>
        <input type="email" class="form-control" name="email" placeholder="Enter Email">
        <?php echo form_error('email', '<p class="text-danger error">', '</p>'); ?>
      </div>
    </div>
    <div class="form-group">
      <label for="inputPassword" class="control-label">Password</label>
      <div>
        <input type="password" class="form-control" name="password" placeholder="Enter Password">
        <?php echo form_error('password', '<p class="text-danger error">', '</p>'); ?>
      </div>
    </div>
    <div class="form-group">
      <label for="inputConfirmPassword" class="control-label">Confirm Password</label>
      <div>
        <input type="password" class="form-control" name="password2" placeholder="Confirm Password">
        <?php echo form_error('password2', '<p class="text-danger error">', '</p>'); ?>
      </div>
    </div>
    <div class="form-group">
      <div>
        <button type="submit" class="btn btn-primary btn-block">Submit</button>
      </div>
    </div>
    <?php echo form_close(); ?>
  </fieldset>
  </div>
  </div>
 </div>
</div>

