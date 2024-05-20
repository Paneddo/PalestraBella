<?php
session_start();
include_once 'utils.php';

if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'segretaria') {
    header('Location: ./accessoNegato.php');
    exit();
}

$conn = createConnection();

if (isset($_GET['elimina']) && isset($_GET['idCorso'])) {
    $stmt = mysqli_prepare($conn, "DELETE FROM corso WHERE idCorso = ?");
    mysqli_stmt_bind_param($stmt, "s", $_GET['idCorso']);
    mysqli_stmt_execute($stmt);

    mysqli_close($conn);
    header('Location: ./index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Fetch course details
    $idCorso = test_input($_GET['idcorso']);
    $stmt = mysqli_prepare($conn, "SELECT * FROM corso WHERE idCorso = ?");
    mysqli_stmt_bind_param($stmt, "s", $idCorso);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $corso = mysqli_fetch_assoc($result);

    $query = "SELECT idUtente as id, nome, cognome FROM utente WHERE tipo = \"istruttore\"";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $istruttori[] = $row;
    }

    $query = "SELECT * FROM lezione WHERE idCorso = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $idCorso);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($result)) {
        $lezioni[] = $row;
    }

    mysqli_close($conn);
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idCorso = test_input($_POST['idCorso']);
    $titolo = test_input($_POST['titolo']);
    $descrizione = test_input($_POST['descrizione']);
    $istruttoreId = test_input($_POST['istruttore']);

    $stmt = mysqli_prepare($conn, "UPDATE corso SET nomeCorso = ?, descrizioneCorso = ?, idIstruttore = ? WHERE idCorso = ?");
    mysqli_stmt_bind_param($stmt, "ssss", $titolo, $descrizione, $istruttoreId, $idCorso);
    mysqli_stmt_execute($stmt);

    if (isset($_POST['day'])) {
        $stmt = mysqli_prepare($conn, "DELETE FROM lezione WHERE idCorso = ?");
        mysqli_stmt_bind_param($stmt, "s", $idCorso);
        mysqli_stmt_execute($stmt);

        $days = $_POST['day'];
        $startTimes = $_POST['start_time'];
        $endTimes = $_POST['end_time'];
        $stmt = mysqli_prepare($conn, "INSERT INTO lezione (idLezione, idCorso, giorno, oraInizio, oraFine) VALUES (?, ?, ?, ?, ?)");
        for ($i = 0; $i < count($days); $i++) {
            $day = test_input($days[$i]);
            $startTime = test_input($startTimes[$i]);
            $endTime = test_input($endTimes[$i]);
            mysqli_stmt_bind_param($stmt, "sssss", $i, $idCorso, $day, $startTime, $endTime);
            mysqli_stmt_execute($stmt);
        }
    }
    mysqli_close($conn);
    header('Location: ./index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Modifica Corso</title>
    <link rel="stylesheet" href="styles/form.css">
    <?php include "templates/head.html"; ?>
</head>

<body>
    <h1>MODIFICA IL CORSO</h1>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="titolo">Titolo del corso:</label><br>
        <input value="<?= $corso['nomeCorso'] ?>" type="text" id="titolo" name="titolo" required><br><br>

        <label for="descrizione">Descrizione:</label><br>
        <textarea id="descrizione" name="descrizione" rows="4" cols="50" required><?= $corso['descrizioneCorso'] ?></textarea><br><br>

        <label for="istruttore">Istruttore:</label><br>
        <select id="istruttore" name="istruttore" required>
            <?php foreach ($istruttori as $istruttore) : ?>
                <option value="<?= $istruttore['id'] ?>" <?php if ($istruttore['id'] == $corso['idIstruttore']) echo 'selected' ?>><?= $istruttore['nome'] . " " . $istruttore['cognome'] ?></option>
            <?php endforeach ?>
        </select><br><br>

        <label>Lezioni:</label><br>
        <div id="lezioni">
            <?php if (!empty($lezioni)) : ?>
                <?php foreach ($lezioni as $lezione) : ?>
                    <div class="lezione">
                        <select name="day[]" required>
                            <option value="Lunedì" <?php if ($lezione['giorno'] === 'Lunedì') echo 'selected' ?>>Lunedì</option>
                            <option value="Martedì" <?php if ($lezione['giorno'] === 'Martedì') echo 'selected' ?>>Martedì</option>
                            <option value="Mercoledì" <?php if ($lezione['giorno'] === 'Mercoledì') echo 'selected' ?>>Mercoledì</option>
                            <option value="Giovedì" <?php if ($lezione['giorno'] === 'Giovedì') echo 'selected' ?>>Giovedì</option>
                            <option value="Venerdì" <?php if ($lezione['giorno'] === 'Venerdì') echo 'selected' ?>>Venerdì</option>
                            <option value="Sabato" <?php if ($lezione['giorno'] === 'Sabato') echo 'selected' ?>>Sabato</option>
                            <option value="Domenica" <?php if ($lezione['giorno'] === 'Domenica') echo 'selected' ?>>Domenica</option>
                        </select>
                        <input type="time" name="start_time[]" value="<?= $lezione['oraInizio'] ?>" required>
                        <input type="time" name="end_time[]" value="<?= $lezione['oraFine'] ?>" required>
                        <button type="button" onclick="removeLesson(this)">Rimuovi</button>
                    </div>
                <?php endforeach ?>
            <?php endif ?>
        </div>
        <button type="button" onclick="addLesson()">Aggiungi lezione</button><br><br>

        <input type="hidden" name="idCorso" value="<?= $idCorso ?>" />
        <button class="round-btn" type="submit">Applica</button>
        <a href="<?= $_SERVER['PHP_SELF'] ?>?idCorso=<?= $idCorso ?>&elimina=true"><button type="button" class="round-btn" id="elimina">Elimina</button></a>
    </form>

    <div id="lessonTemplate" style="display: none;">
        <div class="lezione">
            <select name="day[]" required>
                <option value="Lunedì">Lunedì</option>
                <option value="Martedì">Martedì</option>
                <option value="Mercoledì">Mercoledì</option>
                <option value="Giovedì">Giovedì</option>
                <option value="Venerdì">Venerdì</option>
                <option value="Sabato">Sabato</option>
                <option value="Domenica">Domenica</option>
            </select>
            <input type="time" name="start_time[]" required>
            <input type="time" name="end_time[]" required>
            <button type="button" onclick="removeLesson(this)">Rimuovi</button>
        </div>
    </div>

    <script src="./js/modificaCorso.js"></script>
    <?php include 'templates/footer.html' ?>

</html>
