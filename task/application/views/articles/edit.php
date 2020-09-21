<h2><?= $title ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('articles/update'); ?>
	<input type="hidden" name="id" value="<?php echo $article['id'] ?>">
	 <div class="form-group">
    <label>Title</label>
    <input type="text" class="form-control" name="title" value="<?php echo $article['title']; ?>">
  </div>
   <div class="form-group">
    <label>Body</label>
    <textarea class="form-control" id="editor1" name="body"><?php echo $article['body']; ?></textarea>
  </div>
   <div class="form-group">
  	<label>Change image
      <br><img src="<?php echo site_url(); ?>assets/images/articles/<?php echo $article['post_image'] ?>"></label>
  	<input type="file" name="userfile" size="20">
  </div>
  <button type="Submit" class="btn btn-default">Submit</button>
</form>