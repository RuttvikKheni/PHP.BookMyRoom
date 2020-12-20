<?php
$vendarID = $_SESSION['VID'];
$query = "SELECT `status` FROM `vendar` WHERE vendarID='$vendarID'";
$result = mysqli_query($con, $query);
$vendarStatus = mysqli_fetch_array($result);
if (!empty($vendarStatus['status'])) {
    if (isset($_POST['capacity'])) {

        $imageArray = array("24UScreenshot (5).png", "24UScreenshot (5).png", "Screenshot (2).png", "Screenshot (3).png", "Screenshot (4).png");
        $HollID = "";
        $HollIMG = $imageArray[rand(0, 4)];
        $HollStatus = "Unbook";
        $Capacity = $_POST['capacity'];
        $BookDate = "";

        $query = "INSERT INTO `holls`(`vendarID`, `hollIMG`, `hollstatus`, `persons`) VALUES ('$vendarID','$HollIMG','$HollStatus','$Capacity')";
        echo $query;
        $result = mysqli_query($con, $query);
        if ($result) {
            header('Location: Homee.php');
        }
    }
}

if (isset($_GET['delete'])) {
    $deleteHollID = $_GET['delete'];
    $query = "DELETE FROM `holls` WHERE hollID='$deleteRoomID' AND vendarID='$vendarID'";
    $result = mysqli_query($con, $query);
    if ($result) {
        header("Location: Homee.php");
    }
}
$query = "SELECT * FROM holls WHERE vendarID='$vendarID'";
$result = mysqli_query($con, $query);
?>
<div class="col-8 mx-auto rooms">
    <div class="heading border-1">
        <h2 style="text-align: center;">Your holls</h2>
    </div>
    <div class=" table">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">HollId</th>
                    <th scope="col">Holl Img</th>
                    <th scope="col">Holl Status</th>
                    <th scope="col">Holl Holder</th>
                    <th scope="col">Holl Holder Number</th>
                    <th scope="col">Persons</th>
                    <th scope="col">Book Date</th>
                    <th scope="col">DELETE Holl</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $i = 0;
                while ($row = mysqli_fetch_array($result)) {
                    $i++;
                ?>
                    <tr>
                        <th scope="row"><?= $i ?></th>
                        <td><img style="width: 100px;" src="./RoomIMG/<?= $row['hollIMG'] ?>" alt="Room Img"></td>
                        <td><?= $row['hollstatus'] ?></td>
                        <td><?= $row['hollholdername'] ?></td>
                        <td><?= $row['hollholdernumber'] ?></td>
                        <td><?= $row['persons'] ?></td>
                        <td><?= $row['bookdate'] ?></td>
                        <td><a href="Homee.php?delete=<?= $row['hollID'] ?>">Delete Room</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php if (!empty($vendarStatus['status'])) { ?>
        <form method="POST">
            <select name="capacity" id="">
                <option value="Less then 100" selected>Less then 100</option>
                <option value="Lass then 200">Lass then 200</option>
                <option value="Lass then 300">Lass then 300</option>
                <option value="More Then 300">More Then 300</option>
            </select>
            <button class="btn btn-primary addroom">Add Holl</button>
        </form>
    <?php } ?>
</div>