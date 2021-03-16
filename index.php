<?php
require_once 'myclass.php';
$ob = new myclass();
include_once 'parts/header.php';
if (!isset($_SESSION['admin'])) {
    header("Location:login.php");
}
$a = $ob->showcomplain();
?>
<html>
<body>
<div class="container mt-5">
    <div class="row">
        <?php foreach ($a as $rs) { ?>

        <div class="col-lg-6 mt-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $rs['title'] ?></h5>
                    <a class="card-text">Owner : <?php echo $rs['name'] ?></a>
                    <p class="card-text">Flat Number : <?php echo $rs['wing'] ?>/ <?php echo $rs['flat'] ?></p>
                    <a href="view_complain.php?id=<?php echo $rs['c_id']; ?>" class="btn btn-primary">View Complain</a>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
</body>
</html>
