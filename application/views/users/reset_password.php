<br />
 <div class="row">
  <div class="col-lg-4 col-lg-offset-4">
   <div class="well bs-component">
  <fieldset>
    <legend class="text-center"><?= $title ?></legend>
    <?php echo form_open('users/reset_password_validation'); ?>
    <div class="form-group">
      <label for="inputEmail" class="control-label">Email</label>
      <div>
        <input type="email" class="form-control" name="email" placeholder="Enter Email">
        <?php echo form_error('email', '<p class="text-danger error">', '</p>'); ?>
      </div>
    </div>
    <div class="form-group">
      <label for="inputNewPassword" class="control-label">New Password</label>
      <div>
        <input type="password" class="form-control" name="npassword" placeholder="Enter New Password">
        <?php echo form_error('npassword', '<p class="text-danger error">', '</p>'); ?>
      </div>
    </div>
    <div class="form-group">
      <label for="inputPassword" class="control-label">Confirm Password</label>
      <div>
        <input type="password" class="form-control" name="cpassword" placeholder="Confirm Password">
        <?php echo form_error('cpassword', '<p class="text-danger error">', '</p>'); ?>
      </div>
    </div>
    <div class="form-group">
      <div>
        <button type="submit" class="btn btn-primary btn-block">Update</button>
      </div>
    </div>
    <?php echo form_close(); ?>
  </fieldset>
  </div>
 </div>
</div>

