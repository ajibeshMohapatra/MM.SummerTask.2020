<script type="text/javascript">
    $(document).ready(function(){
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div><input type="text" name="fields[]" value=""/><a href="javascript:void(0);" class="remove_button" title="Remove field">' +
            '<i class="fa fa-minus btn btn-danger " aria-hidden="true"></i> </a></div>'; //New input field html
        var x = 1; //Initial field counter is 1
        $(addButton).click(function(){ //Once add button is clicked
            if(x < maxField){ //Check maximum number of input fields
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); // Add field html
            }
        });
        $(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });
</script>
<div class="col-sm-9 col-sm-offset-3 col-md-6 col-md-offset-2 main">
        <h1 class="page-header">Add Poll</h1>

        <?php echo form_open_multipart('polls/create/', array('class' => 'form-horizontal')) ?>

            <div class="form-group">
                <input id="poll_title" class="form-control" name="poll_title" placeholder="Poll title" value="<?= set_value('poll_title') ?>"/>
                <?php echo form_error('poll_title'); ?>
            </div>
            <div class="field_wrapper">
                <div>
                    <input type="text" name="fields[]" value=""/>
                    <a href="javascript:void(0);" class="add_button" title="Add field">
                        <i class="fa fa-plus btn btn-success" aria-hidden="true"></i>
                    </a>
                </div>
            </div>

            <input class="btn btn-primary" type="submit" name="save" value="Create Vote"/>

            <?php echo form_close(); ?>
        </div>
    </div>