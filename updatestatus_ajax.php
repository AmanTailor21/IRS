<?php
session_start();
require_once 'myclass.php';
$ob = new myClass();
if (!isset($_SESSION['admin'])) {
    header("Location:login.php");
}

$comment = $ob->status($_POST['c_id'],$_POST['status']);
if ($comment) {
    echo "Comment Success";
} else {
    echo "upsss";
}
