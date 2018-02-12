<h3>Group/<?= $title ?></h3>
<br/>
<?php echo form_open_multipart('categories/create'); ?>  
     <div class="form-group col-lg-5">
       <label>Name</label>
        <input type="text" class="form-control" name="name" placeholder="Enter name">
        <?php echo form_error('name', '<p class="text-danger error">', '</p>'); ?>
        <br/>
        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
     </div>
</form>