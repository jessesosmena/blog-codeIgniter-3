<h3 class="text-center"><?= $title ?></h3>

<?php echo form_open_multipart('posts/create'); ?>
  <div class="form-group col-lg-6 col-lg-offset-3">
    <label>Title</label>
    <input type="text" class="form-control" name="title" placeholder="Add Title">
    <?php echo form_error('title', '<p class="text-danger error">', '</p>'); ?>
  </div>
  <div class="form-group col-lg-6 col-lg-offset-3">
    <label>Body</label>
    <textarea id="editor1" class="form-control" name="body" placeholder="Add Body">
  </textarea>
  <?php echo form_error('body', '<p class="text-danger error">', '</p>'); ?>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1' );
            </script>
  <br />
  <div class="form-group">
  <label>Category</label>
   <select name="category_id" class="form-control">
     <?php foreach($categories as $category): ?>
        <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option> 
     <?php endforeach; ?>
   </select>
  </div>
  <div class="form-group">
   <label>Upload Image</label>
    <input type="file" name="userfile" size="20">
  </div>
  <button type="submit" class="btn btn-primary btn-sm">Submit</button>
</form>