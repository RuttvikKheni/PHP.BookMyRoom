<?php
session_start();
include "./../connectDB.php";

if (empty($_GET['hollID']) || empty($_SESSION['username'])) {
    header('Location: index.php');
}
$hollNo = $_GET['hollID'];
$query = "SELECT * FROM holls WHERE hollID='$hollNo' AND hollstatus='booked'";
$result = mysqli_query($con, $query);
if (mysqli_num_rows($result) > 0) {
    header("Location: index.php");
}

$query = "SELECT * FROM holls INNER JOIN vendar ON holls.vendarID=vendar.vendarID WHERE hollstatus='unbook'";

$result = mysqli_query($con, $query);
$array = mysqli_fetch_assoc($result);

$status = "";
$hollNO = $array['hollID'];
$hollIMG = $array['hollIMG'];
$persons = $array['persons'];
$hotalname = $array['hotalname'];
$hotallocation = $array['hotallocation'];
$hotallogo = $array['hotallogo'];
$vendarname = $array['vendarname'];
$vendarmobileno = $array['vendarmobileno'];

$e_hollholder = "";
$e_holdernumber = "";
$e_bookdate = "";
$e_enddate = "";
$e_persons = "";
$hollholder = "";
$holdernumber = "";
$bookdate = "";

if (isset($_POST['booknow'])) {
    print_r($_POST);
    $hollholder = $_POST['hollholder'];
    $holdernumber = $_POST['holdernumber'];
    $bookdate = $_POST['bookdate'];
    $flag = "true";

    if ($hollholder == "") {
        $e_hollholder = "*Required!";
        $flag = "hollholder";
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
    if ($persons === '') {
        $e_persons = "*Persons Must Under 1 and 6";
        $flag = "persons";
    }
    if ($flag === "true") {
        $query = "SELECT * FROM holls";
        $query = "UPDATE `holls` SET `hollstatus`='booked',`hollholder`='$hollholder',`holdernumber`='$holdernumber',`persons`='$persons',`bookdate`='$bookdate',`enddate`='$enddate' WHERE hollID='$hollNO'";
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
    <title>holl Details</title>
</head>

<body>
    <div class="col-8 mx-auto">
        <div class="m-5 heading">
            <h1 style="text-align: center;">-: holl Details :-</h1>
        </div>
        <div class="mx-auto card" style="width: 60rem;">
            <img class="w-100 card-img-top" src="./../vendars/roomIMG/<?= $hollIMG ?>" alt="Card image cap">
            <div class="card-body">
                <h5 class="m-3 card-title" style="font-size: xxx-large;">Hotal <?= $hotalname ?></h5>
                <p class="card-text">Location : - <b><?= $hotallocation ?></b> <br> HotalLogo :- <img style="width: 100px;" src="./../vendars/img/<?= $hotallogo ?>" alt="" srcset=""></p>
                <p>holl Capacity :- <b><?= $persons ?></b> </p>
                <p class="card-text">For More Info Contact Our <b>Mr.<?= $vendarname ?></b>. Contact Number <b><?= $vendarmobileno ?></b></p>
                <form class="mx-auto" method="POST" enctype="multipart/form-data">
                    <div class="col-11 mx-auto row border-1">
                        <div class="col-4 form-group">
                            <label for="no">Vendar Id :- </label>
                            <input readonly type="text" class="form-control" value="<?= $hollNO ?>" name="no" id="no" />
                            <small class="">*Auto generated</small>
                        </div>
                        <div class="col-4 form-group">
                            <label for="Name">Customer Name :- </label>
                            <input type="text" class="form-control" value="<?= $hollholder ?>" name="hollholder" id="Name" />
                            <small class="required"><?= $e_hollholder ?></small>
                        </div>
                        <div class="col-4 form-group">
                            <label for="MobileNumber">Customer Mobile Number :- </label>
                            <input type="number" class="form-control" value="<?= $holdernumber ?>" name="holdernumber" id="MobileNumber" />
                            <small class="required"><?= $e_holdernumber ?></small>
                        </div>
                    </div>
                    <div class="col-11 mx-auto row border-1">
                        <div class="col-6 form-group">
                            <label for="MobileNumber">Join Date :- </label>
                            <input type="date" class="form-control" value="<?= $bookdate ?>" name="bookdate" id="MobileNumber" />
                            <small class="required"><?= $e_bookdate ?></small>
                        </div>
                        <div class="col-6 custom-file">
                            <label for="emailAddress">Persons :- </label>
                            <input readonly type="text" class="form-control" name="persons" value="<?= $persons ?>" id="emailAddress" />
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