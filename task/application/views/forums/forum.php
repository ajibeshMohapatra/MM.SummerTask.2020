<?php if($this->session->userdata('logged_in')){?>
              <a class="btn btn-primary" href="<?php echo base_url(); ?>forums/create">Start a new thread </a>
              <?php }else{?> <a class="btn btn-primary" href="<?php echo base_url(); ?>users/login">Log in to start a new thread </a><?php } ?>

<br>
<br>
<br>
<h3>Discussion Forum</h3>
<br>
<div class="table-responsive table-bordered" >
	<table class="table table-striped" cellspacing="0" cellpadding="0" border="0">
                        <thead>
                        <tr>
                            <th>Sl No.</th>
                            <th >Title</th>
                            <th>Body</th>
                            <th >Started By</th>
                        </tr>
                        </thead>
                        <tbody>
                        	<?php
                        foreach ($forums as $forum) :
                            ?>
                            <tr <?php
                            if ($forum['id'] % 2 == 1) {
                                echo "class='odd'";
                            }
                            ?>>
                                <td class="align-center"><?php echo $forum['id']; ?></td>
                                <td>
                                    <a href="<?php echo base_url('forums/view/'.$forum['id']); ?>"><?php echo $forum['forum_title'] ?></a>
                                </td>
                                <td><?php echo word_limiter($forum['forum_body'], 30); ?></td>
                                 <td><?php echo $forum['forum_created_at'] ?> by <?php echo $forum['username']; ?> </td>
                            </tr>
                            <?php
                        endforeach;
                        ?>
                        </tbody>
                    </table>
                </div>