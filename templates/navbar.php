<nav class="navbar">
    <div class="container">
        <div class="navbar-left">
            <a class="navbar-brand" href="./">
                <img src="./images/icon.png" alt="PeppeGym Logo">
                <span>PeppeGym</span>
            </a>
        </div>
        <div class="navbar-right">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'index.php') echo 'active' ?>" aria-current="page" href="./">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'corsi.php') echo 'active' ?>" href="./corsi.php">Corsi</a>
                </li>
                <?php if (!isset($_SESSION['id'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'login.php') echo 'active' ?>" href="./login.php">Accedi</a>
                    </li>
                <?php  } else { ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'profilo.php') echo 'active' ?>" href="./profilo.php">Profilo</a>
                    </li>

                    <?php if ($_SESSION['tipo'] === 'segretaria') : ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'aggiungiCorso.php') echo 'active' ?>" href="./aggiungiCorso.php">Aggiungi Corso</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'aggiungiUtente.php') echo 'active' ?>" href="./aggiungiUtente.php">Aggiungi Utente</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="./logout.php">Logout</a>
                    </li>
                <?php  } ?>
            </ul>
        </div>
    </div>
</nav>
