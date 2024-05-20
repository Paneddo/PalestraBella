<?php
session_start();
if ($_SESSION['tipo'] !== 'segretaria') {
    header("location: ./accessoNegato.php");
    exit();
}
include_once "utils.php";
$conn = createConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titolo = test_input($_POST['titolo']);
    $descrizione = test_input($_POST['descrizione']);
    $numeroPosti = test_input($_POST['posti']);
    $idIstruttore = test_input($_POST['istruttore']);

    // Check if a new category is added
    if (!empty($_POST['newTipologia'])) {
        $newTipologia = test_input($_POST['newTipologia']);
        $prezzoOrario = test_input($_POST['prezzoOrario']);
        // Insert new category into the tipologia table
        $stmt = mysqli_prepare($conn, "INSERT INTO tipologia (nomeTipologia, prezzoOrario) VALUES (?, ?)");
        mysqli_stmt_bind_param($stmt, "ss", $newTipologia, $prezzoOrario);
        mysqli_stmt_execute($stmt);
        // Get the id of the newly inserted category
        $idTipologia = mysqli_insert_id($conn);
    } else {
        $idTipologia = test_input($_POST['tipologia']);
    }

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
    <?php include_once "templates/head.html" ?>
    <link rel="stylesheet" href="styles/form.css">
    <script src="./js/aggiungiCorso.js" defer></script>
</head>

<body>
    <?php include_once "templates/navbar.php" ?>
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
        <select id="tipologia" name="tipologia" onchange="toggleNewTipologia()" required>
            <option value="" disabled selected hidden>Seleziona una tipologia</option>
            <?php foreach ($tipologie as $tipologia) : ?>
                <option value="<?= $tipologia['id'] ?>"><?= $tipologia['nome'] ?></option>
            <?php endforeach ?>
            <option value="new">Aggiungi nuova tipologia</option>
        </select><br><br>

        <div id="newTipologiaInput" style="display:none;">
            <label for="newTipologia">Nuova Tipologia:</label><br>
            <input type="text" id="newTipologia" name="newTipologia" placeholder="Nuova tipologia..."><br><br>

            <label for="prezzoOrario">Prezzo Orario:</label><br>
            <input type="number" id="prezzoOrario" name="prezzoOrario" placeholder="Prezzo Orario (€)" step="0.1"><br><br>
        </div>

        <label for="istruttore">Istruttore:</label><br>
        <select id="istruttore" name="istruttore" required>
            <option value="" disabled selected hidden>Seleziona un istruttore</option>
            <?php foreach ($istruttori as $istruttore) : ?>
                <option value="<?= $istruttore['id'] ?>"><?= $istruttore['nome'] . " " . $istruttore['cognome'] ?></option>
            <?php endforeach ?>
        </select><br><br>

        <button class="round-btn" type="submit">Aggiungi Corso</button>
    </form>
    <?php include_once "templates/footer.html" ?>
</body>

</html>
