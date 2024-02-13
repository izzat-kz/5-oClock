<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a class="navbar-item" href="home.php"><img src="../images/logo.png" width="90px"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

        
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <form class="d-flex" role="search" method="GET" action="products.php" autocomplete="off" >
                <input class="form-control me-2" type="search" name="query" placeholder="Search" aria-label="Search">
                <!-- <button class="btn btn-outline-success" type="submit">Search</button> -->
            </form>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="products.php">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>

                <?php if(isset($_SESSION['auth_user'])) : ?> <!-- When users login, shows dropdown -->
                <li class="nav-item dropdown" style="border-right: 1px solid #808080;">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= $_SESSION['auth_user']['user_name']; ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="profile.php">My Profile</a></li>
                        <li><a class="dropdown-item" href="past-order.php">View Past Order</a></li>
                        <li>
                            <form action="../index/all-check.php" method="post">
                                <button type="submit" name="logout_btn" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="navbar-item" href="cart.php"><img src="images/cart.png" width="32px" style="margin-left: 10px; margin-right: 10px;"></a>
                </li>
                <?php else : ?>  <!-- default view -->
                <a href="../index/login.php"><button class="btn btn-secondary" type="submit">Log In / Sign Up</button></a>
                <?php endif; ?>
            </ul>


        </div>
    </div>
</nav>
