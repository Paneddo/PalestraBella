<?php
session_start();
include_once "utils.php";

if (!isset($_SESSION["id"])) {
    header("Location: ./index.php");
    exit();
}

$idUtente = $_SESSION['id'];
$conn = createConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $cognome = $_POST['cognome'] ?? '';
    $genere = $_POST['genere'] ?? '';


    $stmt = mysqli_prepare($conn, "UPDATE utente SET nome = ?, cognome = ?, genere = ? WHERE idUtente = ?");
    mysqli_stmt_bind_param($stmt, "ssss", $nome, $cognome, $genere, $idUtente);

    mysqli_stmt_execute($stmt);
}

$corsi = array();

$stmt = mysqli_prepare($conn, "SELECT nome, cognome, email, genere FROM utente WHERE idUtente = ?");

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
    <h1>PROFILO PERSONALE</h1>
    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
            <label for="nome">Nome</label>
            <input name="nome" type="text" value="<?= $utente['nome'] ?>" class="form-control" id="nome" disabled>
        </div>
        <div class="form-group">
            <label for="cognome">Cognome</label>
            <input name="cognome" type="text" value="<?= $utente['cognome'] ?>" class="form-control" id="cognome" disabled>
        </div>

        <label for="genere">Sesso</label>
        <input class="genere-radio" type="radio" name="genere" <?php if ($utente['genere'] === "f") echo "checked"; ?> value="f" disabled> <span style="color: orange;">Female</span>
        <input class="genere-radio" type="radio" name="genere" <?php if ($utente['genere'] === "m") echo "checked"; ?> value="m" disabled> <span style="color: orange;">Male</span>

        <div class="form-group">
            <label for="email">Email</label>
            <input name="email" type="email" value="<?php echo $utente['email'] ?>" class="form-control" id="email" disabled>
        </div>
        <br><br>
        <button type="button" id="editButton">Edit</button>
        <button class="round-btn" type="submit" id="saveButton" style="display: none;">Save</button>
        <br><br>
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
