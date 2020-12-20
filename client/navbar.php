<nav class="navbar navbar-expand-lg navbar-light bg-light" style="position: fixed;width: 80%;">
    <a class="navbar-brand px-5" href="#">BookMyRoom</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav m-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#1">Wellcome</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#2">Rooms</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#3">Holls</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="MyRoomsHolls.php">My Rooms And Holls</a>
            </li>
            <?php if (isset($_SESSION['username'])) { ?>
                <li class="nav-item active">
                    <a class="nav-link" href="Logout.php">Log Out</a>
                </li>
            <?php } else { ?>
                <li class="nav-item active">
                    <a class="nav-link" href="Login.php">Log In</a>
                </li>
            <?php } ?>
        </ul>
    </div>
</nav>