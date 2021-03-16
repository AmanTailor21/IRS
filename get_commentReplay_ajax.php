<?php
session_start();
require_once 'myclass.php';
$ob=new myClass();

$c = $ob->getcomment_reply($_REQUEST['comment_id']);
foreach ($c as $val) { ?>
    <div class="container-fluid">
    <div class="row">
        <div class="col-sm-1">
            <img src="image/user.png" width="25px" height="25px">
        </div>
        <div class="col-sm-11">
            <a><b><?php echo $val['user_id']; ?></b></a>
            <p><?php echo $val['reply']; ?></p>
        </div>
    </div>
    </div>
    <?php
}
?>
