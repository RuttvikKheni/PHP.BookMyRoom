<?php
session_start();
if ((empty($_SESSION['vendar']) && (empty($_SESSION['VID'])))) {
    header("Location: Login.php");
}
$RoomID = "";
$RoomIMG = "";
$RoomStatus = "Unbook";
$RoomHolder = "";
$Capacity = "5";
$BookDate = "";
$EndDate = "";



















?>










































<!-- 
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once "./../public/Head.php"; ?>
    <title>Add Rooms</title>
</head>

<body>
    <div class="col-8 mx-auto">
        <div class="p-5 heading">
            <h1 style="text-align: center;">-: Add Rooms :-</h1>
        </div>
        <div>
            <form method="POST">
                <div class="form-group">
                    <label for="roomid">RoomID :-</label>
                    <input type="text" readonly class="form-control" value="1" name="roomid" id="roomid" aria-describedby="emailHelp">
                    <small style="required"></small>
                </div>
                <div class="form-group">
                    <label for="roomid">Capacity :-</label>
                    <input type="text" readonly class="form-control" value="1" name="roomid" id="roomid" aria-describedby="emailHelp">
                    <small style="required"></small>
                </div>
                <div class="form-group">
                    <label for="roomid">RoomID :-</label>
                    <input type="text" readonly class="form-control" value="1" name="roomid" id="roomid" aria-describedby="emailHelp">
                    <small style="required"></small>
                </div>
                <div class="form-group">
                    <label for="roomid">RoomID :-</label>
                    <input type="text" readonly class="form-control" value="1" name="roomid" id="roomid" aria-describedby="emailHelp">
                    <small style="required"></small>
                </div>
                <div class="form-group">
                    <label for="roomid">RoomID :-</label>
                    <input type="text" readonly class="form-control" value="1" name="roomid" id="roomid" aria-describedby="emailHelp">
                    <small style="required"></small>
                </div>
                <div class="form-group">
                    <label for="roomid">RoomID :-</label>
                    <input type="text" readonly class="form-control" value="1" name="roomid" id="roomid" aria-describedby="emailHelp">
                    <small style="required"></small>
                </div>
                <button type="submit" class="m-4 btn btn-primary">Submit</button>
                <a class="m-4 btn btn-primary" href="homee.php">Home page</a>
            </form>
        </div>
    </div>
</body>

</html> -->