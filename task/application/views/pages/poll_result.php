<?php if (isset($result) && $result != NULL) { ?>
    <!-- Vote Result Start -->
<div class="col-md-6 margin-top-30">
    <div class="box-poll">

        <div class="box-poll-head">Result of : <?php echo $result['poll_title'] ?></div>
        <div class="box-poll-content">
                <div class="span6">
                   <h5>Poll Counter: <?php  ?></h5>
                    <?php foreach($rows as $row): ?>
                    <label class="label"><?= $row['prec']; ?>% (<?= $row['poll_data']; ?>)</label>
                    <div class="progress">
                        <div class="progress-bar progress-striped progress-success" role="progressbar"
                             aria-valuemin ="0" aria-valuemax="100" aria-valuenow="<?= $row['prec']; ?>">
                        </div>
                    </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
        <!-- Vote Result End -->


<?php }else{ ?>
<?php } ?>