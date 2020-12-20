<?php
session_start();
if (empty($_SESSION['admin'])) {
    header("Location: Login.php");
}

$admin = $_SESSION['admin'];

?>
<html>

<head>
    <?php include "../public/Head.php" ?>
    <title>Admin Page</title>
</head>

<body>
    <div class="col-8 col-lg-10 col-md-10 col-sm-12 m-auto">
        <?php include_once "navbar.php"; ?>
        <div class="homee" id="1">
            <?php include_once "Homee.php"; ?>
        </div>
        <div class="vender" id="2">
            <?php include_once "Vender.php"; ?>
        </div>
        <div class="hotaldetail" id="3">
            <?php include_once "HotalDetails.php"; ?>
        </div>
        <div class="admindetail" id="4">
            <?php include_once "AdminDetails.php"; ?>
        </div>
        <div class="footer">
            <?php include_once "Footer.php"; ?>
        </div>
    </div>
    </div>
    <script>
        $(document).ready(function() {
            setTimeout(() => {
                $(".display").addClass('d-none');
            }, 3000);
        });
    </script>
</body>

</html>