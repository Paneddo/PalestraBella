<?php
session_start();
include_once "utils.php";

if (!isset($_SESSION["id"])) {
    header("Location: ./index.php");
    exit();
}

$idUtente = $_SESSION['id'];
$corsi = array();

$conn = getConnection();
$stmt = mysqli_prepare($conn, "SELECT nome, cognome, email FROM utente WHERE idUtente = ?");

mysqli_stmt_bind_param($stmt, "s", $idUtente);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$utente = mysqli_fetch_assoc($result);

$stmt = mysqli_prepare($conn, "SELECT foto, nomeCorso as nome FROM corso INNER JOIN utente ON utente.idUtente = corso.idIstruttore INNER JOIN prenotazione ON prenotazione.idCorso = corso.idCorso WHERE prenotazione.idUtente = ?");

mysqli_stmt_bind_param($stmt, "s", $idUtente);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
mysqli_close($conn);
while ($row = mysqli_fetch_assoc($result)) {
    $corsi[] = $row;
}
?>

<!DOCTYPE html>
<html>

<head>
    <?php include_once "templates/head.html" ?>
    <title>Profilo</title>
    <link rel="stylesheet" href="styles/form.css">
    <link rel="stylesheet" href="styles/corsi.css">
</head>

<body>
    <?php include_once 'templates/navbar.php'; ?>

    <form>
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" value="<?php echo $utente['nome'] ?>" class="form-control" id="nome" disabled>
        </div>
        <div class="form-group">
            <label for="cognome">Cognome</label>
            <input type="text" value="<?php echo $utente['cognome'] ?>" class="form-control" id="cognome" disabled>
        </div>

        <label for="sesso">Sesso</label>
        <input type="radio" name="gender" <?php if (isset($gender) && $utente['gender'] == "female") echo "checked"; ?> value="female"> <span style="color: orange;">Female</span>
        <input type="radio" name="gender" <?php if (isset($gender) && $utente['gender'] == "male") echo "checked"; ?> value="male"> <span style="color: orange;">Male</span>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" value="<?php echo $utente['email'] ?>" class="form-control" id="email" disabled>
        </div>
        <button type="button" id="editButton">Edit</button>
        <button type="button" id="saveButton" style="display: none;">Save</button>
        <button type="button" id="cancelButton" style="display: none;">Cancel</button>
    </form>
    <?php if ($_SESSION['tipo'] !== 'segretaria' && count($corsi) > 0) : ?>
        <h1>I tuoi Corsi</h1>
        <div class="courses">
            <?php foreach ($corsi as $corso) : ?>
                <div class="course">
                    <div class="circular-square">
                        <img src="./uploads/<?= $corso['foto'] ?>" alt="Immagine">
                    </div>

                    <h2><?= $corso['nome'] ?></h2>

                    <p class="days">Lunedì 10.00-12.00</p>
                    <p class="days"> Mercoledì 10.00-12.00</p>
                </div>
            <?php endforeach; ?>
        </div>


    <?php endif; ?>
    <?php include_once "templates/footer.html" ?>
    <script src="./js/modificaProfilo.js"></script>
</body>

</html>
