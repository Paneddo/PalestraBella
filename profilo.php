<?php
session_start();
include "utils.php";

if (!isset($_SESSION["id"])) {
    header("location: ./index.php");
    exit();
}

$idUtente = $_SESSION['id'];
$nome = '';
$cognome = '';
$email = '';

$conn = getConnection();
$stmt = mysqli_prepare($conn, "SELECT nome, cognome, email FROM utente WHERE idUtente = ?");

mysqli_stmt_bind_param($stmt, "s", $idUtente);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
mysqli_close($conn);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $nome = $row['nome'];
    $cognome = $row['cognome'];
    $email = $row['email'];
}
?>

<!DOCTYPE html>
<html>
<style>
    body {
        background-color: white;
    }
</style>

<head>
<link rel="stylesheet" href="styles/profilo.css">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Form</title>
    <meta name="description" content="">
    
</head>

<body>

    <?php include 'templates/navbar.php'; ?>

    <form>
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" value="<?php echo $nome ?>" class="form-control" id="nome" disabled>
        </div>
        <div class="form-group">
            <label for="cognome">Cognome</label>
            <input type="text" value="<?php echo $cognome ?>" class="form-control" id="cognome" disabled>
        </div>
        <div class="form-group">
            <label for="datadinascita">Data di nascita</label>
            <input type="text" class="form-control" id="datadinascita" disabled>
        </div>
        <label for="sesso">Sesso</label>
        <input type="radio" name="gender"
        <?php if (isset($gender) && $gender=="female") echo "checked";?>
        value="female"> <span style="color: orange;">Female</span>
        <input type="radio" name="gender"
        <?php if (isset($gender) && $gender=="male") echo "checked";?>
        value="male"> <span style="color: orange;">Male</span>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" value="<?php echo $email ?>" class="form-control" id="email" disabled>
        </div>
    </form>
    <?php if ($_SESSION['tipo'] !== 'segretaria') : ?>
        <a href="./corsi_personali.php">I miei Corsi</a>
    <?php endif; ?>
    <?php include "templates/footer.html" ?>
</body>

</html>
