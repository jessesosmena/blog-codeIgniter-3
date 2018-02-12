<h3><?= $title ?></h3>
<?php 
if ( !empty($posts) ) 
foreach($posts as $post) 

: ?>

     <h3><?php echo $post['title']; ?></h3>
     <div class="row">
     <div class="col-md-3">
          <img class="thumbnail" style="width: 250px;" src="<?php echo base_url(); ?>assets/images/posts/<?php echo $post['post_image']; ?>">
     </div>
     <div class="col-md-9">
          <small class="text-info">Posted on:  <?php echo $post['created_at']; ?> in <strong><?php echo $post['name']; ?></strong></small><br /><br /><br />
          <?php echo word_limiter($post['body'], 60); ?>
          <br />
          <p><a class="btn btn-primary btn-sm" href="<?php echo base_url('/posts/' .$post['slug']); ?>">Read More</a></p><br /> <!-- redirect to posts/view -->
     </div>
     </div>
<?php endforeach ?>
