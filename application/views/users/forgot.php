<br />
 <div class="row">
  <div class="col-lg-6 col-lg-offset-3">
  <div class="col-lg-12">
   <div class="well bs-component">
  <fieldset>
    <h4 class="text-center">Forgot Password</h4>
    <?php echo form_open('users/forgot'); ?>
    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Email</label>
      <div>
        <input type="email" class="form-control" name="email" placeholder="Enter Email">
        <?php echo form_error('email', '<p class="text-danger error">', '</p>'); ?>
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