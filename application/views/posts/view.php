<h3><?php echo $post['title']; ?></h3>
  <small class="text-info">Posted on:  <?php echo $post['created_at']; ?></small><br />
   <img class="thumbnail" style="width: 250px;" src="<?php echo base_url(); ?>assets/images/posts/<?php echo $post['post_image']; ?>">
<div>
   <?php echo $post['body']; ?>
</div>

<?php if($this->session->userdata('user_id') == $post['user_id']) : ?>
<hr>
<?php echo form_open('/posts/edit/' .$post['slug']); ?> <!-- slug parameter is like id this is the slug of the current post slug if id 1 then slug 1 -->
  <input class="btn btn-default pull-left btn-sm" type="submit" value="edit" class="btn btn-default">
</form>
<?php echo form_open('/posts/delete/' .$post['id']); ?>
  <input type="submit" value="delete" class="btn btn-danger btn-sm">
</form>
<?php endif; ?>

<hr>
<h3>Comments</h3>

<?php if($comments) : ?>

 <?php foreach($comments as $comment) : ?>
  <div class="well">
   <label>From:  <?php echo $comment['name']; ?><br />Posted on: <?php echo $comment['created_at']; ?></label><br />
 	 <h5><?php echo $comment['body']; ?></h5>
  </div>
 <?php endforeach; ?>

<?php else : ?>

   <p>No Comments to display</p>

<?php endif; ?>


<hr>
<h5 class="text-success">Add Comment</h5>

<form id="myform" action="<?php echo base_url('comments/create/' .$post['id']); ?>" method="post">

<input type="hidden" name="slug" value="<?php echo $post['slug']; ?>">

<div class="form-group col-lg-3">
  <label>Name</label>
   <input type="text" name="name" class="form-control">
</div>
<div class="form-group col-lg-3">
  <label>Email</label>
   <input type="text" name="email" class="form-control"><br />
</div>
<div class="form-group col-lg-7">
  <label>Body</label>
   <textarea rows="4" cols="50" name="body" class="form-control"></textarea><br />
   <input class="btn btn-primary btn-sm" type="submit" value="Submit">
</div>
</div>
</form>
