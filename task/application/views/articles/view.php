<script type="text/javascript">
	
    $(document).ready(function () {
    	var Id = <?php echo $article['id']; ?>;
    	var count = <?php echo $article['view']; ?>;
    	count++;
    	var sendData = {"view": count};

    	 $.ajax({
                url: "<?php echo base_url(); ?>articles/view_counter/" + Id,
                type: "post",
                data: sendData,
                success: function (data) {}
            });

            return false;
    })
</script>

<h2><?php echo $article['title']; ?></h2>
<small class="post-date">Posted on <?php echo $article['created_at']; ?></small><br>
<img src="<?php echo site_url(); ?>assets/images/articles/<?php echo $article['post_image'] ?>">
<div class="post-body">
	<?php echo $article['body']; ?>
</div>
<?php if($this->session->userdata('user_id') == $article['user_id']) : ?>
<hr>
<a class="btn btn-default pull-left" href="<?php echo base_url(); ?>articles/edit/<?php echo $article['slug']; ?>">Edit</a>
<?php echo form_open('/articles/delete/'.$article['id']); ?>
	<input type="submit" value="delete" class="btn btn-danger">
</form>
<?php endif; ?>
<hr>
<h3>Comments</h3>
<?php if($comments) : ?>
	<?php foreach($comments as $comment) : ?>
		<div class="well">
		<h5><?php echo $comment['body']; ?> [by <strong><?php echo $comment['name'] ?></strong>]</h5>
		</div>	
	<?php endforeach ; ?>
<?php else : ?>
	<p>No Comments to Display</p>
<?php endif; ?>
<hr>
<?php if($this->session->userdata('logged_in')){?>
              <h3>Add comment</h3>
<?php echo validation_errors(); ?>
<?php echo form_open('comments/create/'.$article['id']); ?>
	<div class="form-group">
		<textarea name="body" class="form-control"></textarea>
	</div>
	<input type="hidden" name="request" value="<?php echo $this->session->userdata('role_id'); ?>">
	<input type="hidden" name="name" value="<?php echo $this->session->userdata('username'); ?>">
	<input type="hidden" name="email" value="<?php echo $this->session->userdata('email'); ?>">
	<input type="hidden" name="slug" value="<?php echo $article['slug']; ?>">
	<button class="btn btn-primary" type="submit">Submit</button>
</form>
 <?php }else{?> <a class="btn btn-primary" href="<?php echo base_url(); ?>users/login">Log in to Comment </a><?php } ?>

<hr>
<h3>Comment Requests</h3>
<?php if($requests) : ?>
	<?php foreach($requests as $request) : ?>
		<div class="well">
		<h5><?php echo $request['body']; ?> [by <strong><?php echo $request['name'] ?></strong>]</h5>
		<?php echo form_open('/comments/delete/'.$request['id']); ?>
			<input type="text" value="<?php echo $request['id'] ?>">
		 	<input type="submit" value="reject" class="btn btn-danger">
        </form>
        <?php echo form_open('/comments/update/'.$request['id']); ?>
        	<input type="text" value="<?php echo $request['id'] ?>">
		  <input type="submit" value="accept" class="btn btn-success">
        </form>
		</div>	
	<?php endforeach ; ?>
<?php else : ?>
	<p>No Comment Requests to Display</p>
<?php endif; ?>
