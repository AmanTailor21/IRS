<?php
session_start();
require_once 'myclass.php';
$ob = new myClass();
if (!isset($_SESSION['name'])) {
    header("Location:login.php");
}
$uploadDir = 'image/';
if(isset($_POST['name']) && isset($_POST['number']) && isset($_POST['wing']) && isset($_POST['flat']) && isset($_POST['title']) && isset($_POST['description']) && isset($_POST['image']))
{
    $name = $_POST['name'];
    $number = $_POST['number'];
    $wing= $_POST['wing'];
    $flat=$_POST['flat'];
    $title =$_POST['title'];
    $description = $_POST['description'];

    $uploadStatus = 1;
    $uploadedFile = '';


        $fileName = basename($_FILES["image"]["name"]);
        $targetFilePath = $uploadDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath);
        $uploadedFile = $fileName;
        $status='open';
        $f=$ob->addcomplain($name,$number,$wing,$flat,$title,$description,$targetFilePath,$status);
}


