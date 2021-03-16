<?php
require_once 'myclass.php';
$ob = new myclass();
$id = $_REQUEST['id'];
include_once 'parts/header.php';
if (!isset($_SESSION['name'])) {
    header("Location:login.php");

}

$a = $ob->complain($id);
foreach ($a as $as) {
    ?>
    <script src="jquery.js"></script>
    <script type="text/javascript">

        function getreply_comment(comment_id){
            //let comment_id = $(this).data('comment-id');
            $.ajax({ //
                type: "GET",
                url: "get_commentReplay_ajax.php",
                data: {comment_id: comment_id},
                dataType: "html",
                success: function (response) {
                    $("#reply_data").val("");
                    $("#comment_reply-post").prepend(response);
                }
            });
        }


        $(document).ready(function () {
            $(".send").click(function () {
                let comment_id = $(this).data('comment-id');
                let blog_id = $(this).data('blog-id');
                let reply = $('#view_' + comment_id).find('input').val();

                $.ajax({ //
                    type: "POST",
                    url: "reply_comment.php",
                    data: {comment_id: comment_id,c_id: blog_id,comm: reply},
                    dataType: "html",
                    success: function (response) {
                        $("#comment_reply-post").empty();
                        getreply_comment(comment_id);
                    }
                });
            });
        });

        $(document).ready(function () {
            <?php $c = $ob->getcomment($id); foreach ($c as $com) {?>
            $('#view_<?php echo $com['comment_id']; ?>').hide();
            <?php } ?>
        });
        $(document).ready(function () {
            <?php $c = $ob->getcomment($id); foreach ($c as $com) { ?>
            $('#show_<?php echo $com['comment_id']; ?>').click(function () {

                $('#view_<?php echo $com['comment_id']; ?>').toggle("");

            });
            <?php } ?>
        });
    </script>
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-6">
                <h3><?php echo $as['title']; ?></h3>
                <hr>
                <div class="row">
                    <div class="col-lg-7">
                        <small class="text-muted">Owner : <?php echo $as['name'] ?></small><br>
                        <small class="text-muted">Flat Number : <?php echo $as['wing'] ?>
                            /<?php echo $as['flat'] ?></small>
                    </div>
                    <div class="col-lg-5">
                        <small class="text-muted">Mobile Number : <?php echo $as['number'] ?></small><br>
                    </div>
                </div>
                <hr>
                <p><?php echo $as['description'] ?></p>
            </div>
            <div class="col-sm-6">
                <?php
                $c = $ob->getcomment($id);
                foreach ($c as $val) { ?>

                    <div class="row">
                        <div class="col-lg-1">
                            <img src="image/user.png" height="50" width="50"">
                        </div>
                        <div class="col-lg-9">
                            <a style="padding-left: 10px;padding-top: 2px;">Admin</a><br>
                            <div id="comment-post">
                                <small style="padding-left: 10px;"
                                       class="text-muted"><?php echo $val['comment'] ?></small>
                            </div>

                            <div id="comment_reply-post">
                                <?php
                                $c = $ob->getcomment_reply($val['comment_id']);
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
                                <?php }?>
                            </div>

                        </div>
                        <div class="col-sm-2">
                            <i class="fa fa-reply-all" aria-hidden="true"><small class="text-muted" id="show_<?php echo $val['comment_id']; ?>">Reply</small></i>
                        </div>
                        <div class="container-fluid">
                            <div class="input-group mb-3" id="view_<?php echo $val['comment_id']; ?>">
                                <input type="text" class="form-control" id="reply_data" placeholder="Enter Your Reply"
                                       aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary send"
                                            data-blog-id="<?php echo $_REQUEST['id']; ?>"
                                            data-comment-id="<?php echo $val['comment_id']; ?>">Send
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>

