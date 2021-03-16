<?php
require_once 'myclass.php';
$ob = new myclass();
include_once 'parts/header.php';
if (!isset($_SESSION['admin'])) {
    header("Location:login.php");
}
$c_id = $_REQUEST['id'];

?>
    <head>
        <script src="jquery.js"></script>
        <script type="text/javascript">

            function getComment(){
                $.ajax({ //
                    type: "GET",
                    url: "getcomment_ajax.php",
                    data: {id: <?php echo $c_id; ?>},
                    dataType: "html", //expect html to be returned
                    success: function (response) {
                        $("#comment").val("");
                        $("#comment-post").html(response);
                    }
                });
            }
            window.onload = getComment();

            $(document).ready(function () {
                $("#submit").click(function () {
                    $.ajax({ //
                        type: "POST",
                        url: "comment_ajax.php",
                        data: {c_id:<?php echo $c_id ?>,comment: $("#comment").val()},
                        dataType: "html", //expect html to be returned
                        success: function (response) {
                            $("#comment-post").empty();
                            getComment();
                        }
                    });
                });


                $("#status").click(function () {
                    $.ajax({ //
                        type: "POST",
                        url: "updatestatus_ajax.php",
                        data: {c_id:<?php echo $c_id ?>,status: $("#dropdown").val()},
                        dataType: "html", //expect html to be returned
                        success: function (response) {
                            console.log(response);
                            window.alert("Status Change Success");
                        }
                    });
                });
            });
        </script>
    </head>
<?php $a = $ob->complain($c_id);
foreach ($a as $as)
{ ?>
    <!--<img src="<?php /*echo $as['image']; */?>">-->
    <div class="container mt-4">
    <div class="row">
        <div class="col-sm-6">
            <h3><?php  echo $as['title']; ?></h3>
            <hr>
            <div class="row">
                <div class="col-lg-7">
                    <small class="text-muted">Owner : <?php echo $as['name']?></small><br>
                    <small class="text-muted">Flat Number : <?php echo $as['wing']?>/<?php echo $as['flat']?></small>
                </div>
                <div class="col-lg-5">
                    <small class="text-muted">Mobile Number : <?php echo $as['number']?></small><br>
                </div>
            </div>
            <hr>
            <p><?php echo $as['description']?></p>
        </div>
        <div class="col-sm-6">

            <div class="row">
            <div class="col-sm-9 form-group">
                    <select class="form-control" id="dropdown">
                        <option value="open">Open</option>
                        <option value="in progress">in progress</option>
                        <option value="resolved">resolved</option>
                    </select>
            </div>
            <div class="col-sm-3">
                    <input class="btn btn-info" type="button" value="submit" id="status">
            </div>

            </div>


            <div id="comment-post">
            </div>

        </div>
    </div>
</div>
<?php }?>
<div class="container mt-5" style="padding-bottom: 60px;">
    <h2>Leave a Reply</h2>
    <form method="post">
        <div class="form-group">
            <textarea class="form-control" style="height: 20%" name="comment" id="comment" placeholder="Enter Your Comment"></textarea><br>
            <input class="btn btn-info" type="button" id="submit"
                   value="Submit" name="Submit">
        </div>
        
    </form>
</div>
