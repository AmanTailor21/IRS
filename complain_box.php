<?php
include_once 'parts/header.php';
if(!isset($_SESSION['name'])){
    unset($_SESSION['admin']);
    header("Location:login.php");
}

?>
<html>
<head>
    <script src="jquery.js"></script>
    <script type="text/javascript">
        $(document).ready(function (e) {
            $("#form").on('submit', (function(e){
                e.preventDefault();
                $.ajax({ //
                    type: "POST",
                    url: "complain_ajax.php",
                    data: new FormData(this),
                    //data: {name: $("#name").val(), number:$("#number").val(),wing:$("#wing").val(),flat:$("#flat").val(),title:$("#title").val(),description:$("#description").val(),image:$("#image").val()},
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function (response) {
                        if (response) {
                            alert("Complain register Successfully");
                            $("input[type=text], textarea").val("");
                        }
                        else {
                            alert("Please Fill All Details");
                        }
                    }
                });
            }));
        });
    </script>
</head>
<body>
<div class="container mt-5">
    <form class="form" id="form"enctype="multipart/form-data" >
        <div class="form-group">
            <label>Enter Name</label>
            <input type="text" class="form-control" name="name" id="name">
        </div>
        <div class="form-group">
            <label>Enter Contact Number</label>
            <input type="text" class="form-control" name="number" id="number">
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Select Your wing</label>
                    <select type="text" class="form-control" name="wing" id="wing">
                        <option>C-1</option>
                        <option>C-2</option>
                        <option>C-3</option>
                        <option>C-4</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Select Your House No</label>
                    <select type="text" class="form-control" name="flat" id="flat">
                        <option>101</option>
                        <option>102</option>
                        <option>201</option>
                        <option>202</option>
                        <option>301</option>
                        <option>302</option>
                        <option>401</option>
                        <option>402</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>Enter Issue Title</label>
            <input type="text" class="form-control" name="title" id="title">
        </div>
        <div class="form-group">
            <label>Enter Description of the issue</label>
            <textarea class="form-control" style="height: 40%" name="description" id="description"></textarea>
        </div>
        <div class="form-group">
            <label>Upload Image</label>
            <input type="file" class="form-control" name="image" id="image">
        </div>
        <div class="form-group">
            <input type="submit" id="submit" class="btn btn-info" value="submit">
        </div>
    </form>
</div>
</body>
</html>