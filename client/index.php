<?php
session_start();
if (empty($_SESSION['username'])) {
    header("Location: login.php");
}
print_r($_SESSION);
?>
<html>

<head>
    <?php include "../public/Head.php" ?>
    <title>BookMyRoom</title>
</head>

<body>
    <div class="col-8 col-lg-10 col-md-10 col-sm-12 m-auto">
        <?php include_once "navbar.php"; ?>
        <div class="homee" id="1">
            <?php include_once "welcome.php"; ?>
        </div>
        <div class="vender" id="2">
            <?php include_once "Rooms.php";
            ?>
        </div>
        <div class="hotaldetail" id="3">
            <?php include_once "Holls.php";
            ?>
        </div>
        <div class="admindetail" id="4">
            <?php include_once "Profile.php";
            ?>
        </div>
        <div class="footer">
            <?php include_once "Footer.php";
            ?>
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