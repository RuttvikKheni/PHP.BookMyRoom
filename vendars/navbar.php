<?php
include_once "./../connectDB.php";
$vendarID = $_SESSION['VID'];
$vendarUserName = $_SESSION['vendar'];
$query = "SELECT status FROM vendar WHERE vusername='$vendarUserName' AND vendarID='$vendarID'";
$result = mysqli_query($con, $query);
$status = mysqli_fetch_array($result)['status'];
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="position: fixed;width: 80%;">
    <a class="navbar-brand px-5" href="#">BookMyRoom(Vendar)</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav m-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#1">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#2">manage Rooms</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#3">Manage Holls</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#4">Your Profile</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="Logout.php">Log Out</a>
            </li>
        </ul>
        <div class="icons">
            <?php if ($status) { ?>
                <div class="unlock">
                    <i class="fa fa-unlock" aria-hidden="true"></i>
                </div>
            <?php } else { ?>
                <div class="lock">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                </div>
            <?php  } ?>
        </div>
    </div>
</nav>