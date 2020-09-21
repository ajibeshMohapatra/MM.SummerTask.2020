
<h3>Polls</h3>
<br>
<div class="table-responsive table-bordered" >
	<table class="table table-striped" cellspacing="0" cellpadding="0" border="0">
                        <thead>
                        <tr>
                            <th>Order</th>
                            <th >title</th>
                            <th >created</th>
                            <th >Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        	<?php
                        $counter = 1;
                        foreach ($polls as $poll) :
                            ?>
                            <tr <?php
                            if ($counter % 2 == 1) {
                                echo "class='odd'";
                            }
                            ?>>
                                <td class="align-center"><?php echo $counter; ?></td>
                                <td>
                                    <a href="<?= base_url() ?>users/poll/<?= $poll['poll_id']; ?>"><?php echo $poll['poll_title'] ?></a>
                                </td>
                                 <td><?php echo $poll['poll_created'] ?></td>
                                 <td class="align-center">
                                    <a href="<?= base_url() ?>polls/edit/<?= $poll['poll_id']; ?>"><img
                                            src="<?php echo base_url(); ?>/assets/images/polls/edit-icon.png" width="16"
                                            height="16" title="edit" alt="edit"/></a>&nbsp;&nbsp; | &nbsp;&nbsp;
                                    <a href="<?php echo base_url() ?>polls/remove/<?php echo $poll['poll_id']; ?>"
                                       class="tool boxStyle" onclick="return confirm('do you want to delete ?');"><img
                                            src="<?php echo base_url(); ?>/assets/images/polls/delete-icon.png" width="16"
                                            height="16" title="remove" alt="remove"/></a>
                                    &nbsp;&nbsp; | &nbsp;&nbsp;
                                    <?php if ($poll['poll_state'] == 0): ?>
                                        <a href="<?php echo base_url() ?>polls/activate_poll/<?php echo $poll['poll_id']; ?>"><img src="<?php echo base_url() ?>/assets/images/polls/tick-circle.gif" width="16" height="16" alt="Activate" /></a>
                                    <?php else : ?>
                                        <a href="<?php echo base_url() ?>polls/deactivate_poll/<?= $poll['poll_id']; ?>"><img src="<?php echo base_url(); ?>/assets/images/polls/minus-circle.gif" width="16" height="16" alt="Deactivate"/></a>
                                    <?php endif; ?>
                                </td>

                            </tr>
                            <?php
                            $counter++;
                        endforeach;
                        ?>
                        </tbody>
                    </table>
                </div>
<br>
<br>
<br>
<br>
<br>
<div style="text-align: center;">
	<a class="btn btn-primary" href="<?= base_url() ?>users/poll/create">Add Poll</a></li>
</div>


