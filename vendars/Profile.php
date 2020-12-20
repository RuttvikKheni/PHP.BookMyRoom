<?php
include_once "./../connectDB.php";
$e_vendarName = "";
$e_vendarNumber = "";
$e_hotalName = "";
$e_hotalLocation = "";
$GLOBALS['filename'] = "";
$no = $_SESSION['VID'];
$vendarUsername = $_SESSION['vendar'];

$query = "SELECT * FROM vendar where vusername='$vendarUsername'";
$result = mysqli_query($con, $query);
$array = mysqli_fetch_array($result);
$status = "";
$vendarName = $array['vendarname'];
$vendarNumber = $array['vendarmobileno'];
$hotalName = $array['hotalname'];
$hotalLocation = $array['hotallocation'];
$GLOBALS['oldlogo'] = $array['hotallogo'];
if (isset($_POST['update'])) {

    $vendarName = $_POST['vendarname'];
    $vendarNumber = $_POST['vendarnumber'];
    $hotalName = $_POST['hotalname'];
    $hotalLocation = $_POST['hotallocation'];
    $hotallogo = $_FILES['hotallogo']['name'];
    $falg = true;
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
    if ($_FILES['hotallogo']['error'] == 0) {
        if ($falg === true) {
            if (imgUpload($_FILES['hotallogo'])) {
                unlink('./img/' . $GLOBALS['oldlogo']);
                $fileName = $GLOBALS['filename'];
                $query = "UPDATE `vendar` SET `hotalname`= '$hotalName',`hotallocation`='$hotalLocation',`hotallogo`='$fileName',`vendarname`='$vendarName',`vendarmobileno`=$vendarNumber WHERE vusername='$vendarUsername'";
                $result = mysqli_query($con, $query);
                if ($result) {
                    header('Location: Homee.php');
                }
            } else {
                echo "img Not Uploaded!";
            }
        } else {
            echo $falg;
        }
    } else {
        if ($falg === true) {
            $query = "UPDATE `vendar` SET `hotalname`= '$hotalName',`hotallocation`='$hotalLocation',`vendarname`='$vendarName',`vendarmobileno`=$vendarNumber WHERE vusername='$vendarUsername'";
            echo $query;
            $result = mysqli_query($con, $query);
            if ($result) {
                header('Location: Homee.php');
            }
        }
    }
}

?>
<div>
    <div class="heading">
        <h1 style="text-align: center;">-: Your Profile :-</h1>
    </div>
    <div class="form">
        <div class="m-5 img" style="text-align: center;">
            <img style="width: 300px;" src="./img/<?= $GLOBALS['oldlogo'] ?>" alt="">
            <p><?= $GLOBALS['oldlogo'] ?></p>
        </div>
        <div class="col-4 mx-auto">
            <h2>Hello MR.<?= $vendarName ?>(<?= $vendarUsername ?>)</h2>
        </div>
        <form class="col-8 mx-auto" method="POST" enctype="multipart/form-data">
            <div style="background-color: #e2d0d0;" class="col-11 row border-1">
                <p>-: About Vendar :-</p>
                <div class="col-4 form-group">
                    <label for="no">Vendar Id :- </label>
                    <input readonly type="text" class="form-control" value="<?= $no ?>" name="no" id="no" />
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
                <p>-: About Hotal :-</p>
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
                </div>
            </div>

            <button type="submit" name="update" value="Update" class="m-5 btn btn-primary">Update</button>
            <a class="m-5 btn btn-primary" href="./login.php">Sign In</a>
        </form>
    </div>
</div>


<?php

function imgUpload($img)
{
    include_once "./../connectDB.php";
    $errors = array();
    $extensions = array("jpeg", "jpg", "png");
    $file_size = $img['size'];
    $file_name = $img['name'];
    $GLOBALS['filename'] = rand(1, 100) . chr(rand(65, 90)) . $file_name;
    $file_tmp = $img['tmp_name'];
    $file_ext = explode('.', $img['name']);
    if (in_array($file_ext[1], $extensions) === false) {
        $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
    }
    if ($file_size > 2097152) {
        $errors[] = 'File size must be excately 2 MB';
    }
    if (empty($errors)) {
        move_uploaded_file($file_tmp, "img/" . $GLOBALS['filename']);
        return true;
    } else {
        print_r($errors);
        return true;
    }
}
?>