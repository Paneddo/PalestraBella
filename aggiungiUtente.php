<?php
session_start();
if ($_SESSION['tipo'] !== 'segretaria') {
    header("location: ./accessoNegato.php");
    exit();
}

include_once "utils.php";

$nome = '';
$cognome = '';
$email = '';
$cellulare = '';
$errore = '';
$filename = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = test_input($_POST['nome']);
    $cognome = test_input($_POST['cognome']);
    $email = test_input($_POST['email']);
    $cellulare = test_input($_POST['cellulare']);
    $tipo = test_input($_POST['tipo']);

    if ($tipo === 'istruttore') {
        if ($_FILES['filename']['error'] === UPLOAD_ERR_OK) {
            $tmp_name = $_FILES['filename']['tmp_name'];
            $name = $_FILES['filename']['name'];
            $ext = pathinfo($name, PATHINFO_EXTENSION);
            $filename = uniqid() . '.' . $ext;

            $upload_dir = './uploads/';
            if (move_uploaded_file($tmp_name, $upload_dir . $filename)) {
                echo "File uploaded successfully.";
            } else {
                echo "Failed to upload file.";
            }
        } else {
            echo "Error uploading file. Error code: " . $_FILES['filename']['error'];
        }
    }

    $password = randomPassword(8);
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $conn = getConnection();
    $stmt = mysqli_prepare($conn, "INSERT INTO utente (nome, cognome, password, email, cellulare, tipo, foto) VALUES (?, ?, ?, ?, ?, ?, ?)");

    mysqli_stmt_bind_param($stmt, "sssssss", $nome, $cognome, $hash, $email, $cellulare, $tipo, $filename);
    mysqli_stmt_execute($stmt);

    mysqli_close($conn);

    $msg = 'Grazie per la registrazione ' . $nome . '. Usa questa password per accedere: ' . $password;
    sendMail($email, 'Registrazione PalestraBella', $msg);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Aggiungi un Utente</title>
    <?php include_once "templates/head.html" ?>
    <link rel="stylesheet" href="styles/form.css">
</head>

<body>
    <?php include_once "templates/navbar.php" ?>
    <h1>AGGIUNGI UN UTENTE</h1>
    <div>
        <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post" enctype="multipart/form-data">
            <label for="nome">Nome:</label><br>
            <input type="text" id="nome" name="nome" placeholder="Nome...">
            <br><br>

            <label for="cognome">Cognome:</label><br>
            <input type="text" id="cognome" name="cognome" placeholder="Cognome...">
            <br><br>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" placeholder="Email...">
            <br><br>

            <label for="cellulare">Cellulare:</label><br>
            <input type="text" id="cellulare" name="cellulare" placeholder="Cellulare...">
            <br><br>

            <label for="tipo">Tipo:</label><br>
            <select name="tipo" id="tipo">
                <option value="cliente">Cliente</option>
                <option value="istruttore">Istruttore</option>
                <option value="segretaria">Segretaria</option>
            </select>
            <br><br>

            <input type="file" id="img-upload" name="filename">
            <br>

            <button type="submit">Aggiungi Utente</button>
        </form>

        <div id="errore">
            <?php
            echo $errore;
            ?>
        </div>
    </div>
    <?php include_once "templates/footer.html" ?>
    <script src="js/utente.js"></script>
</body>

</html>
