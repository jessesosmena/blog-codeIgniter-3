<br />
 <div class="row">
  <div class="col-lg-6 col-lg-offset-3">
  <div class="col-lg-12">
   <div class="well bs-component">
  <fieldset>
    <legend class="text-center"><?= $title ?></legend>
    <?php echo form_open('users/login'); ?>
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
      <div>
        <button type="submit" class="btn btn-primary btn-block">Submit</button>
        <br/>
        <a href='<?php echo base_url("users/forgot") ?>'>Forgot Password ?</a>
      </div>
    </div>
    <?php echo form_close(); ?>
  </fieldset>
  </div>
  </div>
 </div>
</div>

