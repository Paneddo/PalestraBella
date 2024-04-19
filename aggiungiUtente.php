<?php
session_start();
if ($_SESSION['tipo'] !== 'segretaria') {
    header("location: ./accessoNegato.php");
    exit();
}

include "conn.php";

if ($_FILES['filename']['error'] === UPLOAD_ERR_OK) {
    $tmp_name = $_FILES['filename']['tmp_name'];
    $name = $_FILES['filename']['name'];

    $upload_dir = 'uploads/';

    if (move_uploaded_file($tmp_name, $upload_dir . $name)) {
        echo "File uploaded successfully.";
    } else {
        echo "Failed to upload file.";
    }
} else {
    echo "Error uploading file. Error code: " . $_FILES['filename']['error'];
}


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
    $email = test_input($_POST['email']);
    $cellulare = test_input($_POST['cellulare']);
    $tipo = test_input($_POST['tipo']);

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = mysqli_prepare($conn, "INSERT INTO utente (nome, email, cellulare, tipo) VALUES (?, ?, ?, ?, ?)");

    mysqli_stmt_bind_param($stmt, "sssss", $nome, $cognome, $password, $email, $cellulare, $tipo);
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
    <?php include "templates/head.html" ?>
    <link rel="stylesheet" href="styles/form.css">
    <script src="js/utente.js" defer></script>
</head>

<body>
    <?php include "templates/navbar.php" ?>
    <h1>AGGIUNGI UN UTENTE</h1>
    <div>
        <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post" enctype="multipart/form-data">
            <label for="nome">Nome:</label><br>
            <input type="text" id="nome" value="<?php echo $nome ?>" name="nome" placeholder="Nome...">
            <br><br>

            <label for="cognome">Cognome:</label><br>
            <input type="text" id="cognome" value="<?php echo $cognome ?>" name="cognome" placeholder="Cognome...">
            <br><br>

            <label for="email">Email:</label><br>
            <input type="email" id="email" value="<?php echo $email ?>" name="email" placeholder="Email...">
            <br><br>

            <label for="cellulare">Cellulare:</label><br>
            <input type="text" id="cellulare" value="<?php echo $cellulare ?>" name="cellulare" placeholder="Cellulare...">
            <br><br>

            <label for="tipo">Tipo:</label><br>
            <select name="tipo" id="tipo">
                <option value="cliente">Cliente</option>
                <option value="istruttore">Istruttore</option>
                <option value="segretaria">Segretaria</option>
            </select>
            <br><br>

            <input id="img-upload" name="filename">
            <br>
            <button type="submit">Aggiungi Utente</button>
        </form>

        <div id="errore">
            <?php
            echo $errore;
            ?>
        </div>
    </div>

</body>

</html>
