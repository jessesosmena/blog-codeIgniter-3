<h3 class="text-center"><?= $title ?></h3>

<?php echo form_open('posts/update'); ?>
  <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
  <div class="form-group col-lg-6 col-lg-offset-3">
    <label>Title</label>
    <input type="text" class="form-control" name="title" placeholder="Add Title" value="<?php echo $post['title']; ?>">
    <?php echo form_error('title', '<p class="text-danger error">', '</p>'); ?>
  </div>
  <div class="form-group col-lg-6 col-lg-offset-3">
    <label>Body</label>
    <textarea id="editor1" class="form-control" name="body" placeholder="Add Body">
    <?php echo $post['body']; ?>
    </textarea>
    <?php echo form_error('body', '<p class="text-danger error">', '</p>'); ?>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1' );
            </script>
  <br />
  <select name="category_id" class="form-control">
    <?php foreach($categories as $category): ?>
      <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option> 
    <?php endforeach; ?>
  </select>
  <br />
  <button type="submit" class="btn btn-primary btn-sm">Submit</button>
</form>