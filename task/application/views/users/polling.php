<br>
<br>

<?php if (isset($result) && $result != NULL) { ?>
    <!-- Vote Result Start -->
<h4>The total number of votes given is <?php echo $total ?></h4>
<br>
<div class="col-md-5">
    <div class="box-poll">

        <div class="box-poll-head"><h3>Result of : <?php echo $result->poll_title ?></h3></div>
        <br>
        <div class="box-poll-content">
                <div class="span6">
                   <h5>Poll Counter: <?php  ?></h5>
                    <?php foreach($rows as $row): ?>
                    <label class="label"><?= $row['prec']; ?>% (<?= $row['poll_data']; ?>)</label>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar"
                               style="width: <?= $row['prec']; ?>% "
                               aria-valuemin="0" aria-valuemax="100" aria-valuenow="<?= $row['prec']; ?>">
                        </div>
                    </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
        <!-- Vote Result End -->


<?php }else{ ?>
    <div class="alert alert-warning">
  <strong>No votes so far !!</strong> 
</div>
<?php } ?>