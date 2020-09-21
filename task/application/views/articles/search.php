<?php if($results) : ?>
<?php foreach ($results as $result) : ?>
	<h3><?php echo $result['title']; ?></h3>
	<div class="row">
		<div class="col-md-3">
			<img class="post-thumb" src="<?php echo site_url(); ?>assets/images/articles/<?php echo $result['post_image'] ?>">
		</div>
		<div class="col-md-9">
			<small class="post-date">Posted on <?php echo $result['created_at']; ?></small><br>
			<?php echo word_limiter($result['body'], 60); ?>
			<p><a href="<?php echo site_url('/articles/'.$result['slug']); ?>">Read More</a></p>
		</div>
	</div>
<?php endforeach; ?>
<?php else : ?>
	<p>No Articles to Display</p>
<?php endif; ?>