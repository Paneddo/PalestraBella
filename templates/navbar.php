<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="/images/icon.png" width="30" height="30" class="d-inline-block align-top" alt="">
      PeppeGym
    </a>
    <div class="collapse navbar-collapse flex-row-reverse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'index.php') echo 'active' ?>" aria-current="page" href="./">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'corsi.php') echo 'active' ?>" href="./corsi.php">Corsi</a>
        </li>
        <?php
        if (!isset($_SESSION['id'])) {
        ?>
          <li class="nav-item">
            <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'login.php') echo 'active' ?>" href="./login.php">Accedi</a>
          </li>
        <?php
        } else {
        ?>
          <li class="nav-item">
            <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'profilo.php') echo 'active' ?>" href="./profilo.php">Profilo</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./logout.php?page=<?php echo $_SERVER['PHP_SELF'] ?>">Logout</a>
          </li>
        <?php
        }
        ?>
      </ul>
    </div>
  </div>
</nav>
