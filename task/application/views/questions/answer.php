<script type="text/javascript">
    $(document).ready(function () {
        $("button").click(function () {
            var Id = $("#question_id").val();
            var answer = $('input[name="answer"]').val();
            var sendData = {"answer": answer,};

            $.ajax({
                url: "<?= base_url(); ?>questions/add/" + Id ,
                type: "post",
                data: sendData,
                success: function (data) {
                    location.reload();
                 }
            });
            return false;
        });
    })

</script>

<h3>Give Answer</h3>

<br>
<br>
<br>
<?php if($questions) : ?>
<?php foreach($questions as $question) : ?>
<?php echo validation_errors(); ?>
<input type="hidden" id="question_id" value="<?php echo $question['id']; ?>">
<div class="form-group">
    <label><?php echo $question['question']; ?></label>
    <input type="text" class="form-control" name="answer" placeholder="Reply">
  </div>
  <div style="text-align: center;">
   <button type="Submit" class="btn btn-default">Answer</button>
</div>
<?php endforeach ; ?>
<?php else : ?>
    <p>No Questions to Answer</p>
<?php endif; ?>