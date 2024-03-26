<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">Palestra Bella</a>
    <div class="collapse navbar-collapse flex-row-reverse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'index.php') echo 'active' ?>" aria-current="page" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'corsi.php') echo 'active' ?>" href="/corsi.php">Corsi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'login.php') echo 'active' ?>" href="/login.php">Accedi</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
