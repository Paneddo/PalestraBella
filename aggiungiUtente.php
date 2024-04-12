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
$errore = '';
$email = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = test_input($_POST['nome']);
    $password = test_input($_POST['password']);
    $conferma_password = $_POST['conferma-password'];
    if (empty($password) || empty($conferma_password)) {
        $errore = 'Compila tutti i Campi';
    } else if (strcmp($password, $conferma_password) !== 0) {
        $errore = 'Le Password non Corrispondono';
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO utente (nome, password) VALUES ('$nome', '$hash')";


        mysqli_query($conn, $query);
        mysqli_close($conn);
        header("location: ./login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Registrazione</title>
    <link rel="stylesheet" href="./styles/style.css">
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
                <option value="istruttore">Istruttore</option>
                <option value="segretaria">Segretaria</option>
                <option value="cliente">Cliente</option>
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
