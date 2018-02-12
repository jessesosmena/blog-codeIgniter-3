<h3><?= $title ?></h3>
<br/>
<ul class="list-group">
   <?php foreach($categories as $category) : ?>
       <li class="list-group-item"><a href="<?php echo base_url('/categories/posts/' .$category['id']); ?>"><?php echo $category['name']; ?></a>
   <?php endforeach ?>
</ul>