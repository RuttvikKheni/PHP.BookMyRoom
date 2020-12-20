<?php
session_start();
include_once "./../connectDB.php";
if (!empty($_SESSION['username'])) {
    header("Location: index.php");
}
$userid = "";
$name = "";
$mobileno = "";
$gender = "M";
$username = "";
$password = "";
$cpassword = "";
$userstatus = "lock";
$e_userid = "";
$e_name = "";
$e_mobileno = "";
$e_gender = "";
$e_username = "";
$e_password = "";
$e_cpassword = "";
$e_checkpassword = "";

// userid	name	mobileno	gender username	email	password	status
if (isset($_POST['submit'])) {

    $userid = $_POST['userno'];
    $name = $_POST['name'];
    $mobileno = $_POST['mobileno'];
    $gender = $_POST['gender'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $flag = "true";

    if ($name == "") {
        $e_name = "*required";
        $flag = "name";
    }
    if ($mobileno == "") {
        $e_mobileno = "*required";
        $flag = "mobileno";
    }
    if ($gender == "") {
        $e_gender = "*required";
        $flag = "gender";
    }
    if ($username == "") {
        $e_username = "*required";
        $flag = "username";
    }
    if ($password == "") {
        $e_password = "*required";
        $flag = "password";
    }
    if ($cpassword == "") {
        $e_cpassword = "*required";
        $flag = "cpassword";
    }
    if (!$password === $cpassword) {
        $e_checkpassword = "*Passwords Can't Same";
        $flag = "Passwords Can't Same";
    }
    if ($flag === "true") {
        $query = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($con, $query);
        if (mysqli_fetch_row($result) > 0) {
            $status = "Username Used, try Anathor username!";
            $flag = "Username Used, try Anathor username!";
        } else {
            $query = "INSERT INTO `users`(`userid`, `name`, `mobileno`, `gender`, `username`, `password`, `status`)
         VALUES ('$userid','$name','$mobileno','$gender','$username',$password,'lock')";
            echo $query;
            $result = mysqli_query($con, $query);
            if ($result) {
                $_SESSION['username'] = $username;
                $_SESSION['status'] = $userstatus;
                header("location: index.php");
            } else {
                echo "can't Inserted!";
            }
        }
    } else {
        echo $flag;
    }
}



$query = "SELECT * FROM users";
$result = mysqli_query($con, $query);
$userid = mysqli_num_rows($result);
?>

<html>

<head>
    <?php include_once "./../public/Head.php"; ?>
    <title>Ragistration Here</title>
</head>

<body>
    <div class="col-8 col-lg-10 col-md-10 col-sm-12 m-auto">
        <div class="heading p-5">
            <h1 style="text-align: center;">User Registartion Here</h1>
        </div>
        <div class="display col-6 mx-auto <?php if ($status == "") {
                                                echo "d-none";
                                            } ?> alert alert-warning" role="alert">
            <?= $status ?>
        </div>
        <form class="col-8 mx-auto" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="no">User d :- </label>
                <input readonly type="text" class="form-control" value="<?= ++$userid ?>" name="userno" id="no" />
                <small class="">*Auto generated</small>
            </div>
            <div class="form-group">
                <label for="Name">Customer Name :- </label>
                <input type="text" class="form-control" value="<?= $name ?>" name="name" id="Name" />
                <small class="required"><?= $e_name ?></small>
            </div>
            <div class="form-group">
                <label for="MobileNumber">user Mobile Number :- </label>
                <input type="number" class="form-control" value="<?= $mobileno ?>" name="mobileno" id="MobileNumber" />
                <small class="required"><?= $e_mobileno ?></small>
            </div>
            <div class="m-4 form-group">
                <label for="MobileNumber">Gender :- </label>
                Male <input type="radio" value="M" name="gender" <?php if ($gender == "M") {
                                                                        echo "checked";
                                                                    }; ?> id="MobileNumber" />
                Female <input type="radio" value="F" name="gender" <?php if ($gender == "F") {
                                                                        echo "checked";
                                                                    }; ?> id="MobileNumber" />
                <small class="required"><?= $e_gender ?></small>
            </div>
            <div class="form-group">
                <label for="emailAddress">UserName :- </label>
                <input type="text" class="form-control" name="username" value="<?= $username ?>" id="emailAddress" />
                <small class="required"><?= $e_username ?></small>
            </div>
            <div class="row">
                <div class="col-6 form-group">
                    <label for="Password">Passwprd :- </label>
                    <input type="text" class="form-control" value="<?= $password ?>" name="password" id="Password" />
                    <small class="required"><?= $e_password ?></small>
                </div>
                <div class="col-6 form-group">
                    <label for="Password">Conform Passwprd :- </label>
                    <input type="text" class="form-control" value="<?= $cpassword ?>" name="cpassword" id="Password" />
                    <small class="required"><?= $e_cpassword ?></small>
                </div>
            </div>
            <button type="submit" name="submit" value="Submit" class="m-5 btn btn-primary">Sign Up</button>
            <a class="m-5 btn btn-primary" href="./login.php">Log In</a>
            <a class="m-5 btn btn-primary" href="./index.php">Home Page</a>
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