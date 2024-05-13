<?php
session_start();

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$login_error = '';
$username = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include "utils.php";
    $username = test_input($_POST['email']);
    $password = test_input($_POST['password']);

    $conn = getConnection();
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
    <?php include "templates/head.html" ?>
    <title>Login</title>
</head>

<body>
    <?php include "templates/navbar.php" ?>

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
            <button type="submit">Accedi</button>
        </div>
        <?php
        if (!empty($login_error)) {
            echo '<div style="color: red;">' . $login_error . '</div>';
        }
        ?>
    </form>
    <?php include "templates/footer.html" ?>
</body>

</html>