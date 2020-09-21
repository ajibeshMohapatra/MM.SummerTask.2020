<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
        $(document).ready(function(){
        	var cache = {};
            $( "#question" ).autocomplete({
              source: function(request , response){
              	var term = request.term;
              	if (term in cache) {
              		response(cache[term]);
              		return ;
              	}
              	$.getJSON("<?php echo base_url();?>questions/autocomplete",request,function(data,ststus,xhr){
              		cache[term] = data;
              		response (data);
              	});
              },
              select: 
                function(event, ui) {
                  window.location = "<?php echo base_url();?>ask-a-question/"+ui.item.value;                
               }    
            });
        });
</script>


<?php echo validation_errors(); ?>
<?php echo form_open('questions/ask'); ?>
 <div class="form-group">
    <label>Question</label>
    <input type="text" class="form-control" name="question" id="question" placeholder="Ask Question">
</div>
  <div style="text-align: center;">
   <button type="Submit" class="btn btn-default">Ask</button>
</div>
</form>


<br>
<br>
<br>
<h3>All Answers</h3>

<?php foreach($questions as $question) : ?>
<script type="text/javascript">
		$(document).ready(function () {
			$("#<?php echo $question['id']; ?>s").click(function(){
				$("#<?php echo $question['id']; ?>w").fadeToggle();
			});
		})	
</script>
		<div class="well">
		<h5><?php echo $question['question']; ?><span id="<?php echo $question['id']; ?>s" style="float: right;"><strong>&#43;</strong></span></h5>
		<h7 id="<?php echo $question['id']; ?>w" style="display: none;"><?php echo $question['answer']; ?></h7>
		</div>	
	<?php endforeach ; ?>
