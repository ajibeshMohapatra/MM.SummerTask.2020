<h2><?= $title ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('forums/create'); ?>
	 <div class="form-group">
    <label>Title</label>
    <input type="text" class="form-control" name="forum_title" placeholder="Add Topic">
  </div>
   <div class="form-group">
    <label>Body</label>
    <textarea id="editor1" class="form-control" name="forum_body" placeholder="Add Body"></textarea>
  </div>
  <button type="Submit" class="btn btn-default">Submit</button>
</form>