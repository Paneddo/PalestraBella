<?php
session_start();
if ($_SESSION['tipo'] !== 'segretaria') {
    header("location: ./accessoNegato.php");
    exit();
}
include "utils.php";
$conn = getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titolo = test_input($_POST['titolo']);
    $descrizione = test_input($_POST['descrizione']);
    $idTipologia = test_input($_POST['tipologia']);
    $idIstruttore = test_input($_POST['istruttore']);
    $numeroPosti = test_input($_POST['posti']);

    $stmt = mysqli_prepare($conn, "INSERT INTO corso (numeroPosti, descrizioneCorso, nomeCorso, idTipologia, idIstruttore) VALUES (?, ?, ?, ?, ?)");

    mysqli_stmt_bind_param($stmt, "sssss", $numeroPosti, $descrizione, $titolo, $idTipologia, $idIstruttore);
    mysqli_stmt_execute($stmt);
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $istruttori = array();
    $query = "SELECT idUtente as id, nome, cognome FROM utente WHERE tipo = \"istruttore\"";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $istruttori[] = $row;
    }

    $tipologie = array();
    $query = "SELECT idTipologia as id, nomeTipologia as nome FROM tipologia";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $tipologie[] = $row;
    }
}
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Aggiungi Corso</title>
    <?php include "templates/head.html" ?>
    <link rel="stylesheet" href="styles/form.css">
</head>

<body>
    <?php include "templates/navbar.php" ?>
    <h1>AGGIUNGI UN CORSO</h1>
    <?php if (!empty($message)) : ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="titolo">Titolo del corso:</label><br>
        <input type="text" id="titolo" name="titolo" placeholder="Titolo..." required><br><br>

        <label for="descrizione">Descrizione:</label><br>
        <textarea id="descrizione" name="descrizione" rows="4" cols="50" placeholder="Descrizione..." required></textarea><br><br>

        <label for="posti">Numero Posti:</label><br>
        <input id="posti" name="posti" type="number" placeholder="Posti..." required></input><br><br>

        <label for="tipologia">Tipologia:</label><br>
        <select id="tipologia" name="tipologia" required>
            <option value="" disabled selected hidden>Seleziona una tipologia</option>
            <?php foreach ($tipologie as $tipologia) : ?>
                <option value="<?= $tipologia['id'] ?>"><?= $tipologia['nome'] ?></option>
            <?php endforeach ?>
        </select><br><br>

        <label for="istruttore">Istruttore:</label><br>
        <select id="istruttore" name="istruttore" required>
            <option value="" disabled selected hidden>Seleziona un istruttore</option>
            <?php foreach ($istruttori as $istruttore) : ?>
                <option value="<?= $istruttore['id'] ?>"><?= $istruttore['nome'] . " " . $istruttore['cognome'] ?></option>
            <?php endforeach ?>
        </select><br><br>

        <button type="submit">Aggiungi Corso</button>
    </form>
    <?php include "templates/footer.html" ?>
</body>

</html>
