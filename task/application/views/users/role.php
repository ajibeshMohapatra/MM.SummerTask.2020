
<?php foreach ($users as $user) : ?>
<script type="text/javascript">$(document).ready(function(){
  $(".role_<?php echo $user['id'] ?> option[value ='<?php echo $user['role_id']; ?>']").attr("selected",true);
});
</script>
<br>
<div class="card" style="width: 24rem;">
  <div class="card-body">
    <h5 class="card-title"><?php echo $user['name']; ?></h5>
    <h6 class="card-subtitle mb-2 text-muted"><?php echo $user['username']; ?></h6>
    <?php echo form_open('users/update'); ?>
	<input type="hidden" name="id" value="<?php echo $user['id'] ?>">
	<div class="form-group">
    <select name="role_id" class="form-control role_<?php echo $user['id'] ?>">
    	<option value="0">User</option>
    	<option value="1">Admin</option>
    </select>
</div>
  <button type="Submit" class="btn btn-default">Submit</button>
 </form>
  </div>
</div>
<br>
<?php endforeach; ?>