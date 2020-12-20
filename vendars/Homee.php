<?php
session_start();

if ((empty($_SESSION['vendar']) && (empty($_SESSION['VID'])))) {
    header("Location: Login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once "./../public/Head.php"; ?>
    <title>Vendar Home Page</title>
</head>

<body>
    <div class="col-8 col-lg-10 col-md-10 col-sm-12 m-auto">
        <?php include_once "navbar.php"; ?>
        <h3><br><br><br>
            hello Mr.<?= $_SESSION['vendar'] ?>
        </h3>
        <div id="2" class="rooms">
            <?php include_once "Rooms.php"; ?>
        </div>
        <div id="3" class="holls">
            <?php include_once "Holls.php"; ?>
        </div>
        <div id="4" class="profile">
            <?php include_once "Profile.php"; ?>
        </div>
    </div>
</body>

</html>