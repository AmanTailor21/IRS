<?php

class myClass
{
    private $con;
    function __construct()
    {
        $this->con = new PDO('mysql:host=localhost;dbname=irs', 'root', '');
    }
    function insert($name, $email, $password)
    {
        $query = "insert into users(name,email,password) values(:V1,:V2,:V3)";
        $register = $this->con->prepare($query);
        $register->bindParam(":V1", $name);
        $register->bindParam(":V2", $email);
        $register->bindParam(":V3", $password);
        $f = $register->execute();
        return $f;
    }
    function login($email, $password)
    {
        if ($email=='admin@gmail.com' && $password=='admin')
        {
            $_SESSION['admin'] = $email;
            header('Location:index.php');
        }
        else{
            $q = "select * from users where email=:V3 and password=:V4";
            $login = $this->con->prepare($q);
            $login->bindParam(':V3', $email);
            $login->bindParam(':V4', $password);
            $f = $login->execute();
            $val = $login->fetch();
            return $val;
        }
    }
    function addcomplain($name,$number,$wing,$flat,$title,$description,$image,$status)
    {

        $query = "insert into complain_box(name,number,wing,flat,title,description,image,user_id,status) values(:V1,:V2,:V3,:V4,:V5,:V6,:V7,:V8,:V9)";
        $register = $this->con->prepare($query);
        $register->bindParam(":V1", $name);
        $register->bindParam(":V2", $number);
        $register->bindParam(":V3", $wing);
        $register->bindParam(":V4", $flat);
        $register->bindParam(":V5", $title);
        $register->bindParam(":V6", $description);
        $register->bindParam(":V7", $image);
        $register->bindParam(":V8", $_SESSION['id']);
        $register->bindParam(":V9", $status);
        $f = $register->execute();
        return $f;
    }
    function showcomplain()
    {
        $query = "select * from complain_box";
        $book = $this->con->prepare($query);
        $book->execute();
        $all = $book->fetchAll();
        return $all;
    }
    function showmycomplain($id)
    {
        $query = "select * from complain_box where user_id=$id";
        $book = $this->con->prepare($query);
        $book->execute();
        $all = $book->fetchAll();
        return $all;
    }
    function complain($id)
    {
        $query = "select * from complain_box where c_id='$id'";
        $book = $this->con->prepare($query);
        $book->execute();
        $all = $book->fetchAll();
        return $all;
    }
    function comment($c_id,$comment)
    {
        $query = "insert into comment(complain_id,comment) values(:V1,:V2)";
        $register = $this->con->prepare($query);
        $register->bindParam(":V1", $c_id);
        $register->bindParam(":V2", $comment);
        $comment = $register->execute();
        return $comment;
    }
    function getcomment($id)
    {
        $query = "select * from comment where complain_id=:V1 ORDER BY comment_id DESC ";
        $book = $this->con->prepare($query);
        $book->bindParam(":V1", $id);
        $book->execute();
        $all = $book->fetchAll();
        return $all;
    }
    function status($id,$status)
    {
        $query = "update complain_box set status=:V2 where c_id=:V1";
        $book = $this->con->prepare($query);
        $book->bindParam(":V1", $id);
        $book->bindParam(":V2", $status);
        $f = $book->execute();
        return $f;
    }
    function reply_comment($comment_id,$c_id,$reply,$user_id)
    {
        $query = "insert into comment_reply(comment_id,complain_id,reply,user_id) values(:V1,:V2,:V3,:V4)";
        $register = $this->con->prepare($query);
        $register->bindParam(":V1", $comment_id);
        $register->bindParam(":V2", $c_id);
        $register->bindParam(":V3", $reply);
        $register->bindParam(":V4", $user_id);
        $comment = $register->execute();
        return $comment;
    }
    function getcomment_reply($i)
    {
        $query = "select * from  comment_reply where comment_id=:V1";
        $book = $this->con->prepare($query);
        $book->bindParam(":V1", $i);
        $book->execute();
        $all = $book->fetchAll();
        return $all;
    }
}