

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <a class="navbar-item" href="../customer/home.php"><img src="../images/logo.png" width="90px"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

        
        <?php if(isset($_SESSION['auth_user'])) : ?> <!-- When users login, shows dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?= $_SESSION['auth_user']['user_name']; ?>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">My Profile</a></li>
            <li>
            <form action="all-check.php" method="post">
              <button type="submit" name="logout_btn" class="dropdown-item">Logout</button>
            </form>
          </li>
          </ul>
        </li>       
        <?php else : ?>  <!-- default view -->
        <li class="nav-item" style="border-right: 1px solid #808000;">
          <a class="nav-link" href="login.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="register.php">Register</a>
        </li>
        <?php endif; ?>

      </ul>

    </div>
  </div>
</nav>