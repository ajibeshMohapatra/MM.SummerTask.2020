

<h2><?php echo $forum['forum_title']; ?></h2>
<small class="post-date">Started on <?php echo $forum['forum_created_at']; ?> by <?php echo $forum['username']; ?></small><br>
<div class="well">
	<?php echo $forum['forum_body']; ?>
</div>
<br>
<h3>Replies</h3>
<?php if($replies) : ?>
	<?php foreach($replies as $reply) : ?>
		<div class="well">
		<h5><?php echo $reply['reply']; ?> [by <strong><?php echo $reply['username']; ?> </strong>at<strong><?php echo $reply['reply_created_at'];  ?></strong>]</h5>
		</div>	
	<?php endforeach ; ?>
<?php else : ?>
	<p>No Discussions on this topic to Display</p>
<?php endif; ?>
<hr>

<?php if($this->session->userdata('logged_in')){?>
              <h3>Reply to this</h3>
<?php echo validation_errors(); ?>
<?php echo form_open('forums/reply/'.$forum['id']); ?>
	<div class="form-group">
		<textarea name="reply" class="form-control"></textarea>
	</div>
	<input type="hidden" name="username" value="<?php echo $this->session->userdata('username'); ?>">
	<input type="hidden" name="id" value="<?php echo $forum['id']; ?>">
	<button class="btn btn-primary" type="submit">Submit</button>
</form>
 <?php }else{?> <a class="btn btn-primary" href="<?php echo base_url(); ?>users/login">Log in to Reply here </a><?php } ?>
