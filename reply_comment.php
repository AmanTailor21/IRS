<?php
session_start();
require_once 'myclass.php';
$ob = new myClass();
if (!isset($_SESSION['name'])) {
    header("Location:login.php");
}

$comment_r = $ob->reply_comment($_POST['comment_id'],$_POST['c_id'],$_POST['comm'],$_SESSION['id']);
if ($comment_r) {
    echo "Comment Success";
} else {
    echo "upsss";
}
