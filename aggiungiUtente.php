<?php
session_start();
if ($_SESSION['tipo'] !== 'segretaria') {
    header("location: ./accessoNegato.php");
    exit();
}

include "conn.php";

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$nome = '';
$cognome = '';
$email = '';
$cellulare = '';
$errore = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = test_input($_POST['nome']);
    $cognome = test_input($_POST['cognome']);
    $password = test_input($_POST['password']);
    $email = test_input($_POST['email']);
    $cellulare = test_input($_POST['cellulare']);
    $tipo = test_input($_POST['tipo']);

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = mysqli_prepare($conn, "INSERT INTO utente (nome, password, email, cellulare, tipo) VALUES (?, ?, ?, ?, ?, ?)");

    mysqli_stmt_bind_param($stmt, "ssssss", $nome, $cognome, $password, $email, $cellulare, $tipo);
    mysqli_stmt_execute($stmt);

    mysqli_close($conn);

    header("location: ./login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Registrazione</title>
    <?php include "templates/header.html" ?>
    <link rel="stylesheet" href="styles/form.css">
</head>

<body>

    <div>
        <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
            <label for="nome">Nome</label>
            <input type="text" id="nome" value="<?php echo $nome ?>" name="nome" placeholder="Nome...">
            <br>

            <label for="cognome">Cognome</label>
            <input type="text" id="cognome" value="<?php echo $cognome ?>" name="cognome" placeholder="Cognome...">
            <br>

            <label for="email">Email</label>
            <input type="email" id="email" value="<?php echo $email ?>" name="email" placeholder="Email...">
            <br>

            <label for="cellulare">Cellulare</label>
            <input type="text" id="cellulare" value="<?php echo $cellulare ?>" name="cellulare" placeholder="Cellulare...">
            <br>

            <label for="tipo">Tipo</label>
            <select name="tipo">
                <option value="cliente">Cliente</option>
                <option value="istruttore">Istruttore</option>
                <option value="segretaria">Segretaria</option>
            </select>
            <br>
            <input type="submit" value="Invio" name="submit">
        </form>

        <div id="errore">
            <?php
            echo $errore;
            ?>
        </div>
    </div>

</body>

</html>
