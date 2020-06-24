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
    <textarea class="form-control" id="editor1" name="body" value="<?php echo $article['body']; ?>"></textarea>
  </div>
   <div class="form-group">
  	<label>Upload image</label>
  	<input type="file" name="userfile" size="20" value="<?php echo $article['post_image']; ?>">
  </div>
  <button type="Submit" class="btn btn-default">Submit</button>
</form>