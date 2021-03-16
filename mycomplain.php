<?php
include_once 'parts/header.php';
if (!isset($_SESSION['name'])) {
    unset($_SESSION['admin']);
    header("Location:login.php");
}
require_once 'myclass.php';
$ob = new myclass();
$id = $_SESSION['id'];
$a = $ob->showmycomplain($id);
?>
<html>
<body>
<?php
foreach ($a as $as) {
    ?>
    <div class="container mt-3">
        <div class="card">
            <h5 class="card-header" style="color: red">Status : <?php echo $as['status'] ?></h5>
            <h5></h5>
            <div class="card-body">
                <h5 class="card-title"><?php echo $as['title'] ?></h5>
                <p class="card-title text-muted">Name: <?php echo $as['name'] ?></p>
                <p class="card-text text-muted">Flat Number: <?php echo $as['wing'] ?>/ <?php echo $as['flat'] ?> </p>
                <div class="row">
                    <div class="col-sm-10">
                        <a href="view_mycomplain.php?id=<?php echo $as['c_id']; ?>" class="btn btn-info">View Details</a>
                    </div>
                    <div class="col-sm-1">
                        <a href="#"><i class="fa fa-pencil-square-o" style="color: #ff9800; font-size: 30px;" aria-hidden="true"></i></a>
                    </div>
                    <div class="col-sm-1">
                        <a href="#"><i class="fa fa-trash" style="color: red;font-size: 30px;" aria-hidden="true"></i></a>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php } ?>
</body>
</html>