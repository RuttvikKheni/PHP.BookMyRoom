<?php
session_start();
include "./../connectDB.php";

if (empty($_GET['roomID']) || empty($_SESSION['username'])) {
    header('Location: index.php');
}
$roomNo = $_GET['roomID'];
$query = "SELECT * FROM rooms WHERE roomID='$roomNo' AND roomstatus='booked'";
$result = mysqli_query($con, $query);
if (mysqli_num_rows($result) > 0) {
    header("Location: index.php");
}

$query = "SELECT * FROM rooms INNER JOIN vendar ON rooms.vendarID=vendar.vendarID WHERE roomstatus='unbook'";

$result = mysqli_query($con, $query);
$array = mysqli_fetch_assoc($result);

$status = "";
$RoomNO = $array['roomID'];
$roomIMG = $array['roomIMG'];
$capacity = $array['capacity'];
$hotalname = $array['hotalname'];
$hotallocation = $array['hotallocation'];
$hotallogo = $array['hotallogo'];
$vendarname = $array['vendarname'];
$vendarmobileno = $array['vendarmobileno'];

$e_roomholder = "";
$e_holdernumber = "";
$e_bookdate = "";
$e_enddate = "";
$e_persons = "";
$persons = "";
$roomholder = "";
$holdernumber = "";
$bookdate = "";
$enddate = "";

if (isset($_POST['booknow'])) {
    $roomholder = $_POST['roomholder'];
    $holdernumber = $_POST['holdernumber'];
    $bookdate = $_POST['bookdate'];
    $enddate = $_POST['enddate'];
    $persons = $_POST['persons'];
    $flag = "true";

    if ($roomholder == "") {
        $e_roomholder = "*Required!";
        $flag = "roomholder";
    }
    if ($holdernumber == "" || strlen($holdernumber) > 10) {
        $e_holdernumber = "*Required! and Under 10 charactor";
        $flag = "holdernumber";
    }
    $todayDate = date('Y-m-d');
    if ($todayDate >= $bookdate || $bookdate == "") {
        $e_bookdate = "*Pls Enter valid Date";
        $flag = "bookdate";
    }
    if ($bookdate > $enddate || $enddate == "") {
        $e_enddate = "*Pls Enter valid Date";
        $flag = "bookdate";
    }
    if ($persons > '6' || $persons < '1') {
        $e_persons = "*Persons Must Under 1 and 6";
        $flag = "persons";
    }
    if ($flag === "true") {
        $query = "SELECT * FROM rooms";
        $query = "UPDATE `rooms` SET `roomstatus`='booked',`roomholder`='$roomholder',`holdernumber`='$holdernumber',`persons`='$persons',`bookdate`='$bookdate',`enddate`='$enddate' WHERE roomID='$RoomNO'";
        $result = mysqli_query($con, $query);
        if ($result) {
            header("Location: index.php");
        } else {
            $status = "";
        }
        echo $query;
    }
}

?>


<!DOCTYPE html>
<html lang="en">


<head>
    <?php include "../public/Head.php" ?>
    <title>Room Details</title>
</head>

<body>
    <div class="col-8 mx-auto">
        <div class="m-5 heading">
            <h1 style="text-align: center;">-: Room Details :-</h1>
        </div>
        <div class="mx-auto card" style="width: 60rem;">
            <img class="w-100 card-img-top" src="./../vendars/RoomIMG/<?= $roomIMG ?>" alt="Card image cap">
            <div class="card-body">
                <h5 class="m-3 card-title" style="font-size: xxx-large;">Hotal <?= $hotalname ?></h5>
                <p class="card-text">Location : - <b><?= $hotallocation ?></b> <br> HotalLogo :- <img style="width: 100px;" src="./../vendars/img/<?= $hotallogo ?>" alt="" srcset=""></p>
                <p>Room Capacity :- <b><?= $capacity ?></b> </p>
                <p class="card-text">For More Info Contact Our <b>Mr.<?= $vendarname ?></b>. Contact Number <b><?= $vendarmobileno ?></b></p>
                <form class="mx-auto" method="POST" enctype="multipart/form-data">
                    <div class="col-11 mx-auto row border-1">
                        <div class="col-4 form-group">
                            <label for="no">Vendar Id :- </label>
                            <input readonly type="text" class="form-control" value="<?= $RoomNO ?>" name="no" id="no" />
                            <small class="">*Auto generated</small>
                        </div>
                        <div class="col-4 form-group">
                            <label for="Name">Customer Name :- </label>
                            <input type="text" class="form-control" value="<?= $roomholder ?>" name="roomholder" id="Name" />
                            <small class="required"><?= $e_roomholder ?></small>
                        </div>
                        <div class="col-4 form-group">
                            <label for="MobileNumber">Customer Mobile Number :- </label>
                            <input type="number" class="form-control" value="<?= $holdernumber ?>" name="holdernumber" id="MobileNumber" />
                            <small class="required"><?= $e_holdernumber ?></small>
                        </div>
                    </div>
                    <div class="col-11 mx-auto row border-1">
                        <div class="col-4 form-group">
                            <label for="MobileNumber">Join Date :- </label>
                            <input type="date" class="form-control" value="<?= $bookdate ?>" name="bookdate" id="MobileNumber" />
                            <small class="required"><?= $e_bookdate ?></small>
                        </div>
                        <div class="col-4 form-group">
                            <label for="emailAddress">Check Out Date :- </label>
                            <input type="date" class="form-control" name="enddate" value="<?= $enddate ?>" id="emailAddress" />
                            <small class="required"><?= $e_enddate ?></small>
                        </div>
                        <div class="col-4 custom-file">
                            <label for="emailAddress">Persons :- </label>
                            <input type="text" class="form-control" name="persons" value="<?= $persons ?>" id="emailAddress" />
                            <small class="required"><?= $e_persons ?></small>
                        </div>
                    </div>

                    <button type="submit" name="booknow" class="m-5 btn btn-primary">Book Now</button>
                    <a class="m-5 btn btn-primary" href="./index.php">Home Page</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>