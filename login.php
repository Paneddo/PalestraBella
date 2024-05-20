<?php
session_start();

$login_error = '';
$username = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once "utils.php";
    $username = test_input($_POST['email']);
    $password = test_input($_POST['password']);

    $conn = createConnection();
    $stmt = mysqli_prepare($conn, "SELECT idUtente, password, tipo FROM utente WHERE email = ?");

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    mysqli_close($conn);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['id'] = $row['idUtente'];
            $_SESSION['tipo'] = $row['tipo'];
            header("location: ./index.php");
            exit();
        }
    }
    $login_error = "Accesso Negato";
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <?php include_once "templates/head.html" ?>
    <link rel="stylesheet" href="styles/login.css">
    <title>Login</title>
</head>

<body>
    <?php include_once "templates/navbar.php" ?>

    <h1>LOGIN</h1>

    <form action="<?php echo ($_SERVER['PHP_SELF']); ?>" method="post">
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="Email..." id="email" value="<?php echo ($email); ?>"><br><br>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" placeholder="Password" id="password"><br><br>
        </div>
        <div>
            <button class="round-btn" type="submit">Accedi</button>
        </div>
        <?php
        if (!empty($login_error)) {
            echo '<div style="color: red;">' . $login_error . '</div>';
        }
        ?>
    </form>
    <?php include_once "templates/footer.html" ?>
</body>

</html>
