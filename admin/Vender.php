<?php
include_once "../connectDB.php";
if ((isset($_GET['vusername'])) && (isset($_GET['status']))) {
    $vusername = $_GET['vusername'];
    $status = $_GET['status'];
    $query = "UPDATE `vendar` SET `status`='$status' WHERE vusername='$vusername'";
    $result = mysqli_query($con, $query);
    if ($result) {
        header('Location: admin.php');
    } else {
        $status = "Can't Change!";
    }
}

?>
<div class="admins" id="vendorsss">

    <div class="heading m-5 border-1">
        <h1 style="text-align: center;">its Vendar Details</h1>
    </div>
    <div class="display alert alert-warning <?php if ($status == "") {
                                                echo 'd-none';
                                            } ?>" role="alert"><?= $status ?></div>
    <div class="venders col-10 mx-auto">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">VendarID</th>
                    <th scope="col">HotalName</th>
                    <th scope="col">HotalLocation</th>
                    <th scope="col">HotalLogo</th>
                    <th scope="col">V Username</th>
                    <th scope="col">V Password</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $query = "SELECT * FROM vendar";
                $result = mysqli_query($con, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <th scope="row"><?= $row["vendarID"] ?></th>
                        <td><?= $row["hotalname"] ?></td>
                        <td><?= $row["hotallocation"] ?></td>
                        <td><?= $row["hotallogo"] ?></td>
                        <td><?= $row["vusername"] ?></td>
                        <td><?= $row["vpassword"] ?></td>
                        <td><a href="admin.php?vusername=<?= $row['vusername'] ?>&status=<?php if (!$row['status']) {
                                                                                                echo true;
                                                                                            } else {
                                                                                                echo false;
                                                                                            } ?>"><?= $row["status"] ? 'active' : 'inactive'   ?></a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</div>