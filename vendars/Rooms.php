<?php
$vendarID = $_SESSION['VID'];
$query = "SELECT `status` FROM `vendar` WHERE vendarID='$vendarID'";
$result = mysqli_query($con, $query);
$vendarStatus = mysqli_fetch_array($result);
if (!empty($vendarStatus['status'])) {
    if (isset($_POST['capacity'])) {

        $imageArray = array("24UScreenshot (5).png", "24UScreenshot (5).png", "Screenshot (2).png", "Screenshot (3).png", "Screenshot (4).png");
        $RoomID = "";
        $RoomIMG = $imageArray[rand(0, 4)];
        $RoomStatus = "unbook";
        $RoomHolder = "";
        $Capacity = $_POST['capacity'];
        $BookDate = "";
        $EndDate = "";

        $query = "INSERT INTO `rooms`(`vendarID`,`roomIMG`,`roomstatus`, `capacity`) VALUES ('$vendarID','$RoomIMG','$RoomStatus','$Capacity')";
        echo $query;
        $result = mysqli_query($con, $query);
        if ($result) {
            header('Location: Homee.php');
        }
    }
}

if (isset($_GET['delete'])) {
    $deleteRoomID = $_GET['delete'];
    $query = "DELETE FROM `rooms` WHERE roomID='$deleteRoomID' AND vendarID='$vendarID'";
    $result = mysqli_query($con, $query);
    if ($result) {
        header("Location: Homee.php");
    }
}
$query = "SELECT * FROM ROOMS WHERE vendarID='$vendarID'";
$result = mysqli_query($con, $query);
?>
<div class="col-8 mx-auto rooms">
    <div class="heading border-1">
        <h2 style="text-align: center;">Your Rooms</h2>
    </div>
    <div class=" table">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">RoomId</th>
                    <th scope="col">Room Img</th>
                    <th scope="col">Room Status</th>
                    <th scope="col">Room Holder</th>
                    <th scope="col">Persons</th>
                    <th scope="col">Book Date</th>
                    <th scope="col">End Date</th>
                    <th scope="col">DELETE Room</th>
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
                        <td><img style="width: 100px;" src="./RoomIMG/<?= $row['roomIMG'] ?>" alt="Room Img"></td>
                        <td><?= $row['roomstatus'] ?></td>
                        <td><?= $row['roomholder'] ?></td>
                        <td><?= $row['capacity'] ?></td>
                        <td><?= $row['bookdate'] ?></td>
                        <td><?= $row['enddate'] ?></td>
                        <td><a href="Homee.php?delete=<?= $row['roomID'] ?>">Delete Room</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php if (!empty($vendarStatus['status'])) { ?>
        <form method="POST">
            <select name="capacity" id="">
                <option value="2" selected>2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="more">more...</option>
            </select>
            <button class="btn btn-primary addroom">Add Rooms</button>
        </form>
    <?php } ?>
</div>