<div class="m-5 welcome">
    <div class="heading">
        <h1 style="text-align: center;">Holls</h1>
    </div>
    <div class="table">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Index</th>
                    <th scope="col">Hotal Logo</th>
                    <th scope="col">Room Img</th>
                    <th scope="col">Hotal Name</th>
                    <th scope="col">Holl Capacity</th>
                    <th scope="col">Hotal Name</th>
                    <th scope="col">Book Now</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once "./../connectDB.php";
                // $query = "SELECT * FROM rooms WHERE roomstatus='unbook'";
                $query = "SELECT * FROM holls INNER JOIN vendar ON holls.vendarID=vendar.vendarID WHERE hollstatus='unbook'";

                $result = mysqli_query($con, $query);
                $i = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <th scope="row"><?= ++$i ?></th>
                        <td><img style="width: 100px;" src="./../vendars/img/<?= $row['hotallogo'] ?>" alt=""></td>
                        <td><img style="width: 100px;" src="./../vendars/RoomIMG/<?= $row['hollIMG'] ?>" alt=""></td>
                        <td><?= $row['hotalname'] ?></td>
                        <td><?= $row['persons'] ?></td>
                        <td><?= $row['hotallocation'] ?></td>
                        <td><a class="btn btn-danger" href="BookHoll.php?hollID=<?= $row['hollID'] ?>">Book Now</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>