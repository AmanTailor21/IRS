<?php

session_start();
require_once 'myclass.php';
$ob=new myClass();
$id=$_REQUEST['id'];
$c = $ob->getcomment($_REQUEST['id']);
foreach ($c as $val) { ?>
<script src="jquery.js"></script>
<script type="text/javascript">

        $(document).ready(function () {
            <?php $c = $ob->getcomment($id); foreach ($c as $com) {?>
            $('#view_<?php echo $com['comment_id']; ?>').hide();
            <?php } ?>
        });
        $(document).ready(function () {
            <?php $c = $ob->getcomment($id); foreach ($c as $com) { ?>
            $('#show_<?php echo $com['comment_id']; ?>').click(function () {

                $('#view_<?php echo $com['comment_id']; ?>').show("");
                $('#show_<?php echo $val['comment_id']; ?>').hide("");
            });
            <?php } ?>
        });

</script>

    <div class="row">
        <div class="col-lg-1">
            <img src="image/user.png" height="50" width="50"">
        </div>
        <div class="col-lg-9">
            <a style="padding-left: 10px;padding-top: 2px;">Admin</a><br>
            <div id="comment-post">
                <small style="padding-left: 10px;" class="text-muted"><?php echo $val['comment']?></small></div>
                        <?php
                            $c = $ob->getcomment_reply($val['comment_id']);
                            foreach ($c as $val) { ?>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-9">

                                    </div>
                                    <div class="col-lg-3">
                                        <small class="text-muted" id="show_<?php echo $val['comment_id']; ?>">View Reply</small>
                                    </div>
                                </div>
                                <div class="row" id="view_<?php echo $val['comment_id']; ?>">
                                    <div class="col-sm-1">
                                        <img src="image/user.png" width="25px" height="25px">
                                    </div>
                                    <div class="col-sm-11">
                                        <a><b><?php echo $val['user_id']; ?></b></a>
                                        <p class="text-muted"><?php echo $val['reply']; ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
        </div>

    </div>
    <hr>
<?php }?>

