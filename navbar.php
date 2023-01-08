
<nav class="main-header navbar navbar-expand navbar-dark" style="height: 80px;">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-stream"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="#" class="nav-link">Dashboard</a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">

    <!-- Messages Dropdown Menu -->
    <li class="nav-item dropdown mr-2,5" style="margin-top: -45px;">
      <a class="nav-link" data-toggle="dropdown" style="text-transform: capitalize;" href="#">
      <img src="<?= './assets/images/'.$_SESSION['photo']; ?>" alt="User" class="img-size-50 mr-4 img-circle" >
      <p >
      <?= $_SESSION['email'] ?>
      </p>
        <br><br>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

        <div class="dropdown-divider"><?= $_SESSION['email'] ?></div>
        <a href="#" class="dropdown-item">
          <p class="text-sm text-muted m-2"><i class="nav-icon far fa-user mr-2 fa-1.5x"></i>Mon profil</p>
        </a>
        <div class="dropdown-divider"></div>
        <a href="disconnect.php" class="dropdown-item">
          <p class="text-sm text-muted m-2"> <i class="nav-icon fas fa-sign-in-alt mr-2 fa-1.5x"></i>D&eacute;connexion</p>
        </a>
      </div>
    </li>
  </ul>
</nav>