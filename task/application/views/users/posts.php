<h3><strong>My Articles</strong></h3>
<br>
<?php foreach ($articles as $article) : ?>
	<h3><?php echo $article['title']; ?></h3>
	<div class="row">
		<div class="col-md-3">
			<img class="post-thumb" src="<?php echo site_url(); ?>assets/images/articles/<?php echo $article['post_image'] ?>">
		</div>
		<div class="col-md-9">
			<small class="post-date">Posted on <?php echo $article['created_at']; ?></small><br>
			<?php echo word_limiter($article['body'], 60); ?>
			<p><a href="<?php echo site_url('/articles/'.$article['slug']); ?>">Read More</a></p>
		</div>
	</div>
	<br>
<?php endforeach; ?>
<br>
<br>
<br>
<div style="text-align: center;">
	<a class="btn btn-primary" href="<?php echo base_url(); ?>articles/create">Add New Article</a></li>
</div>
<br>

