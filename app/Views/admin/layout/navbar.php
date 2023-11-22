<nav class="main-header navbar navbar-expand dropdown-legacy navbar-dark bg-blue border-bottom-0">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item">
      <h4>Selamat Datang
        <?= $_SESSION['fullname'] ?> di Admin Panel
      </h4>
    </li>

  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">


    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?= base_url('Login/Admin/Destroy') ;?>" role="button">
        <i class="fas fa-arrow-left"></i> &nbsp; Log Out
      </a>
    </li>
  </ul>
</nav>