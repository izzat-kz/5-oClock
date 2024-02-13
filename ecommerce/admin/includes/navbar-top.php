<nav class="sb-topnav navbar navbar-expand bg-light" style="border-bottom:2px solid grey;">
            <!-- Brand-->
            <a class="navbar-brand mt-1" href="dashboard.php"><img src="../images/logo.png" width="80px"></a>
            <!-- Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

            <!-- Navbar-->
            <ul class="navbar-nav ms-auto me-0 me-md-3 my-2 my-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li>
                        <form action="all-check.php" method="post">           
                        <button type="submit" name="logout_btn" class="dropdown-item">Logout</button>
                        </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>