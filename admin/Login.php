<?php

include_once "../connectDB.php";
$e_username = "";
$e_password = "";

$status = "";
$username = "";
$password = "";
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $falg = true;
    if (empty($username)) {
        $e_username = "*Require";
        $falg = false;
    }
    if (empty($password)) {
        $e_password = "*Require";
        $falg = false;
    }

    if ($falg) {
        $query = "SELECT * FROM admin WHERE username='$username' and password='$password'";
        $result = mysqli_query($con, $query);
        $record = mysqli_num_rows($result);
        if ($record > 0) {
            session_start();
            $_SESSION['admin'] = $username;
            header("Location: Admin.php");
        } else {
            $password = "";
            $status = "Record Not Found!";
        }
    }
}




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../public/style.css">

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Login Frist</title>
</head>

<body>
    <div class="col-8 m-auto center">
        <h1 class="m-5">Login Here</h1>
        <div>
            <form action="" method="post">
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
                    <a class="btn btn-primary" href="./admin.php">Admin</a>
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