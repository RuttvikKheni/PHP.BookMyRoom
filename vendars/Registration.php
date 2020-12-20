<?php
session_start();

if ((!empty($_SESSION['vendar']) && (!empty($_SESSION['VID'])))) {
    header("Location: Login.php");
}

$e_vendarName = "";
$e_vendarNumber = "";
$e_hotalName = "";
$e_hotalLocation = "";
$e_hotalLogo = "";
$e_vendarUsername = "";
$e_vendarPassword = "";
$e_vendarCpassWord = "";
$e_checkPassword = "";

$no = "";
$status = "";
$vendarName = "";
$vendarNumber = "";
$hotalName = "";
$hotalLocation = "";
$hotalLogo = "";
$GLOBALS['fileName'] = "";
$vendarUsername = "";
$vendarPassword = "";
$vendarCpassword = "";
$checkPassword = "";
include_once "./../connectDB.php";
if (isset($_POST['submit'])) {
    $no = $_POST['no'];
    $falg = true;
    $vendarName = $_POST['vendarname'];
    $vendarNumber = $_POST['vendarnumber'];
    $hotalName = $_POST['hotalname'];
    $hotalLocation = $_POST['hotallocation'];
    $hotalLogo = $_FILES['hotallogo'];
    $vendarUsername = $_POST['vendarusername'];
    $vendarPassword = $_POST['password'];
    $vendarCpassword = $_POST['cpassword'];

    if ($vendarName == "") {
        $e_vendarName = "*required";
        $falg = "vendarName";
    }
    if ($vendarNumber == "") {
        $e_vendarNumber = "*required";
        $falg = "vendarNumber";
    }
    if ($hotalName == "") {
        $e_hotalName = "*required";
        $falg = "hotalName";
    }
    if ($hotalLocation == "") {
        $e_hotalLocation = "*required";
        $falg = "hotalLocation";
    }
    if ($hotalLogo['error'] != 0) {
        $e_hotalLogo = "*required";
        $falg = "hotalLogo";
    }
    if ($vendarUsername == "") {
        $e_vendarUsername = "*required";
        $falg = "vendarUsername";
    }
    if ($vendarPassword == "") {
        $e_vendarPassword = "*required";
        $falg = "vendarpassword";
    }
    if ($vendarCpassword == "") {
        $e_vendarPassword = "*required";
        $falg = "vendarCpassword";
    }
    if (!$vendarPassword === $vendarCpassword) {
        $e_vendarCpassWord = "# Both Password Can't Same";
        $falg = "checkPassword";
    }
    $query = "SELECT * FROM `vendar` WHERE vusername='$vendarUsername'";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) > 0) {
        $status = "Username Allredy Create, Pls Enter Anthor Username!";
        $falg = "UserId Same!";
    }

    if ($falg === true) {
        if (imgUpload($_FILES['hotallogo'])) {
            $hash = password_hash($vendarPassword, PASSWORD_BCRYPT);
            $fileName = $GLOBALS['fileName'];
            $query = "INSERT INTO `vendar` (`vendarID`, `hotalname`, `hotallocation`, `hotallogo`, `vusername`, `vpassword`) VALUES ('$no','$hotalName','$hotalLocation','$fileName','$vendarUsername','$hash');";
            echo $query;
            $result = mysqli_query($con, $query);
            if ($result) {
                echo "record inserted!";
                $_SESSION['VID'] = $no;
                $_SESSION['vendar'] = $vendarUsername;
                header('Location: Homee.php');
            } else {
                echo "Can't insert!";
            }
        } else {
            $e_hotalLogo = "*It's Not Img Or Img Must Be under 2MB";
        }
    } else {
        echo $falg;
    }
}

$query = "SELECT * FROM vendar";
$result = mysqli_query($con, $query);
$no = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once "./../public/Head.php"; ?>
    <title>Registration Page</title>
</head>

<body>
    <div class="col-8 col-lg-10 col-md-10 col-sm-12 m-auto">
        <div class="heading p-5">
            <h1 style="text-align: center;">Registrasion Page</h1>
        </div>
        <div class="display col-6 mx-auto <?php if ($status == "") {
                                                echo "d-none";
                                            } ?> alert alert-warning" role="alert">
            <?= $status ?>
        </div>
        <form class="col-8 mx-auto" method="POST" enctype="multipart/form-data">
            <div style="background-color: #e2d0d0;" class="col-11 row border-1">
                <p>-: About Vendar :-</p>
                <div class="col-4 form-group">
                    <label for="no">Vendar Id :- </label>
                    <input readonly type="text" class="form-control" value="<?= ++$no ?>" name="no" id="no" />
                    <small class="">*Auto generated</small>
                </div>
                <div class="col-4 form-group">
                    <label for="Name">Vendar Name :- </label>
                    <input type="text" class="form-control" value="<?= $vendarName ?>" name="vendarname" id="Name" />
                    <small class="required"><?= $e_vendarName ?></small>
                </div>
                <div class="col-4 form-group">
                    <label for="MobileNumber">Vendar Mobile Number :- </label>
                    <input type="number" class="form-control" value="<?= $vendarNumber ?>" name="vendarnumber" id="MobileNumber" />
                    <small class="required"><?= $e_vendarNumber ?></small>
                </div>
            </div>
            <div style="background-color: #f9ecec;" class="col-11 row border-1">
                <p>-: About Vendar :-</p>
                <div class="col-4 form-group">
                    <label for="MobileNumber">Hotal Name :- </label>
                    <input type="text" class="form-control" value="<?= $hotalName ?>" name="hotalname" id="MobileNumber" />
                    <small class="required"><?= $e_hotalName ?></small>
                </div>
                <div class="col-4 form-group">
                    <label for="emailAddress">Hotal Location :- </label>
                    <input type="text" class="form-control" name="hotallocation" value="<?= $hotalLocation ?>" id="emailAddress" />
                    <small class="required"><?= $e_hotalLocation ?></small>
                </div>
                <div class="col-4 custom-file">
                    <label class="custom-file-label" for="customFile">Hotal Logo :- </label><br>
                    <input type="file" class="custom-file-input" name="hotallogo" value="<?= $hotalLogo['name'] ?>" id="customFile"><br>Notes :- File must be Image(.jpg, .jpeg,. png) and under 2MB.
                    <small class="required"><?= $e_hotalLogo ?></small>
                </div>
            </div>
            <div style="background-color: #f7e4e4;" class="col-11 row border-1">
                <p>-: Vendar Registration :-</p>
                <div class="col-4 form-group">
                    <label for="Password">Vendar UserName :- </label>
                    <input type="text" class="form-control" value="<?= $vendarUsername ?>" name="vendarusername" id="Password" />
                    <small class="required"><?= $e_vendarUsername ?></small>
                </div>
                <div class="col-4 form-group">
                    <label for="Password">Password :- </label>
                    <input type="password" class="form-control" value="<?= $vendarPassword ?>" id="vendarpassword" name="password" />
                    <small class="required"><?= $e_vendarPassword ?></small>
                </div>
                <div class="col-4 form-group">
                    <label for="conformPassword">Conform Password :- </label>
                    <input type="password" class="form-control" value="<?= $vendarCpassword ?>" id="vendarcpassword" name="cpassword" />
                    <small class="required"><?= $e_vendarCpassWord . " " . $e_checkPassword ?></small>
                </div>
            </div>
            <button type="submit" name="submit" value="Submit" class="m-5 btn btn-primary">Submit</button>
            <a class="m-5 btn btn-primary" href="./login.php">Sign In</a>
        </form>

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



<?php

function imgUpload($img)
{
    include_once "./../connectDB.php";
    $errors = array();
    $extensions = array("jpeg", "jpg", "png");
    $file_size = $img['size'];
    $file_name = $img['name'];
    $GLOBALS['fileName'] = rand(1, 100) . chr(rand(65, 90)) . $file_name;
    $file_tmp = $img['tmp_name'];
    $file_ext = explode('.', $img['name']);
    if (in_array($file_ext[1], $extensions) === false) {
        $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
    }
    if ($file_size > 2097152) {
        $errors[] = 'File size must be excately 2 MB';
    }
    if (empty($errors)) {
        move_uploaded_file($file_tmp, "img/" . $GLOBALS['fileName']);
        return true;
    } else {
        print_r($errors);
        return true;
    }
}
?>