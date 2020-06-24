<h2><?= $title ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open_multipart('articles/create'); ?>
	 <div class="form-group">
    <label>Title</label>
    <input type="text" class="form-control" name="title" placeholder="Add Title">
  </div>
   <div class="form-group">
    <label>Body</label>
    <textarea id="editor1" class="form-control" name="body" placeholder="Add Body"></textarea>
  </div>
  <div class="form-group">
  	<label>Upload image</label>
  	<input type="file" name="userfile" size="20">
  </div>
  <button type="Submit" class="btn btn-default">Submit</button>
</form>