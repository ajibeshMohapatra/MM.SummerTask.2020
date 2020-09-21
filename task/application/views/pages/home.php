 <div class="col-md-6">
    <h1>Popular Posts</h1>
    <?php foreach ($articles as $article) : ?>
    <h3><?php echo $article['title']; ?></h3>
    <div class="row">
        <div class="col-md-3">
            <img class="post-thumb" src="<?php echo site_url(); ?>assets/images/articles/<?php echo $article['post_image'] ?>">
        </div>
        <div class="col-md-9">
            <small class="post-date">Posted on <?php echo $article['created_at']; ?></small><br>
            <?php echo word_limiter($article['body'], 60); ?>
            <p><a href="<?php echo site_url('/articles/'.$article['slug']); ?>">Read More</a>
            </p>
        </div>
    </div>
<?php endforeach; ?>
</div>


























<style>
    /* vote */
    .box-poll {
        background: #fafafa;
        -webkit-box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.18);
        -moz-box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.18);
        box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.18);
        border-radius: 3px;
        float: right;
        width: 100%;
    }

    .box-poll-head {
        background: #922c39;
        font-size: 20px;
        color: #ffffff;
        float: right;
        padding: 20px;
        font-family: 'Droid Arabic Kufi', sans-serif;
        width: 100%;
    }

    .box-poll-content {
        float: right;
        padding: 20px;
        width: 100%;
    }

    .box-poll-content label {
        font-family: 'Droid Arabic Kufi', sans-serif;
        font-size: 20px;
        color: #5e5e5e;
        font-weight: bold;
    }

    .box-poll-content .radio input[type=radio] {
        margin-top: 10px;
    }

    /* footer */
</style>
<script type="text/javascript">

    $(document).ready(function () {
        $("#polling_categories").submit(function () {

            var Id = $("#poll_id").val();
            var poll_option = $('input[name="poll_option"]:checked').val();
            var poll_data = $('input[name="poll_data"]').val();
            var sendData = {"poll_option": poll_option,"poll_data": poll_data};

            $.ajax({
                url: "<?= base_url(); ?>polls/poll_given/" + Id,
                type: "post",
                data: sendData,
                success: function (data) {
                    $("#box-poll").fadeOut(1000, function(){
                         $("#poll-results").html(data).delay(1000).fadeIn(1000);
                    });
                }
            });

            return false;

        })

    })

</script>
<div id="poll-results" style="display:none;"></div>
<!-- Vote Start -->
        <?php if($columns !=null){?>
        <?= form_open_multipart('polls/poll_given/'.$poll->poll_id, array('id' => 'polling_categories'))?>

        <div  class="col-md-4 col-md-push-2 margin-top-30">
            <div id="box-poll" class="box-poll">

                <div class="box-poll-head"><?= $poll->poll_title?></div>
                <div class="box-poll-content">
                    <input type="hidden" id="poll_id" value="<?= $poll->poll_id; ?>"/>
            <?php foreach($columns as $key=>$value):  ?>
            <div class="radio">
                <label class="polling_blog">
                <input name="poll_option" type="radio" value="<?= $key ?>,<?= $value ?>" checked="checked" >
                <?= $value ?>
                </label>
            </div>
              <?php  endforeach;  ?>
              <?php if($this->session->userdata('logged_in')){?>
              <button type="submit" class="btn btn-custom btn-block">Vote Now!</button>
              <?php }else{?> <a class="btn btn-primary" href="<?php echo base_url(); ?>users/login">Log in to give poll</a><?php } ?>
                </div>

            </div>
        </div>
        </form>
    <?php }else{?> <p class="notice error">sorry,there no polls</p>  <?php } ?>
<!-- Vote End -->

<div id="poll-results" style="display:none;"></div>



