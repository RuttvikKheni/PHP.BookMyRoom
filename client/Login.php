<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: index.php");
}
include_once "./../connectDB.php";
$status = "";
$e_username = "";
$e_password = "";
$username = "";
$password = "";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $falg = 'true';
    if (empty($username)) {
        $e_username = "*Require";
        $falg = false;
    }
    if (empty($password)) {
        $e_password = "*Require";
        $falg = false;
    }
    // userid	name	mobileno	gender username	email	password	status
    if ($falg === "true") {
        $query = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($con, $query);
        $count = mysqli_fetch_row($result);
        if ($count > 0) {
            $array = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $username;
            $_SESSION['status'] = $array['status'];
            header("location: index.php");
        } else {
            $status = "Incorrect Detail!";
        }
    } else {
        echo $falg;
    }
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../public/Head.php" ?>
    <title>Login Here</title>
</head>

<body>
    <div class="col-8 mx-auto">
        <div class="m-5 heading">
            <h1 style="text-align: center;">Login Here</h1>
        </div>
        <div class="loginform">
            <form method="post">
                <div class="display alert alert-warning <?php if ($status == "") {
                                                            echo 'd-none';
                                                        } ?>" role="alert"><?= $status ?></div>
                <div class="mb-3">
                    <label for="email" class="form-label">Username :- </label>
                    <input type="text" class="form-control" value="<?= $username ?>" name="username" id="email" placeholder="Enter Username...">
                    <p style="color: red;"><?= $e_username ?></p>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password :- </label>
                    <input type="password" class="form-control" value="<?= $password ?>" name=" password" id="password" placeholder="Atlest 8 chars...">
                    <p style="color: red;"><?= $e_password ?></p>
                </div>
                <div class="buttons">
                    <input class="btn btn-primary" type="submit" name="login" />
                    <a class="btn btn-primary" href="./index.php">Main Page</a>
                    <a class="btn btn-primary" href="./ragisration.php">Sign Up</a>
                </div>
            </form>
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