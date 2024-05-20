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
$sql = "SELECT corso.idCorso, corso.nomeCorso, corso.descrizioneCorso, corso.idIstruttore, utente.nome AS nomeIstruttore, utente.cognome AS cognomeIstruttore, utente.foto, email, cellulare, lezione.giorno, lezione.oraInizio, lezione.oraFine
        FROM corso
        LEFT JOIN lezione ON corso.idCorso = lezione.idCorso
        LEFT JOIN utente ON corso.idIstruttore = utente.idUtente
        LEFT JOIN prenotazione ON prenotazione.idCorso = corso.idCorso
        WHERE prenotazione.idUtente = " . $idUtente;

$result = mysqli_query($conn, $sql);

$corsi = array();

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $idCorso = $row['idCorso'];

        if (!isset($corsi[$idCorso])) {
            $corsi[$idCorso] = array(
                'id' => $idCorso,
                'nome' => $row['nomeCorso'],
                'descrizione' => $row['descrizioneCorso'],
                'istruttore' => array(
                    'id' => $row['idIstruttore'],
                    'nome' => $row['nomeIstruttore'],
                    'cognome' => $row['cognomeIstruttore'],
                    'foto' => $row['foto'],
                    'email' => $row['email'],
                    'cellulare' => $row['cellulare'],
                ),
                'lezioni' => array(),
            );
        }

        if ($row['giorno'] !== null) {
            $corsi[$idCorso]['lezioni'][] = array(
                'giorno' => $row['giorno'],
                'oraInizio' => $row['oraInizio'],
                'oraFine' => $row['oraFine']
            );
        }
    }
}

mysqli_close($conn);

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
        <button type="button" class="round-btn" id="editButton">Edit</button>
        <button class="round-btn" type="submit" id="saveButton" style="display: none;">Save</button>
        <br><br>
        <button type="button" class="round-btn danger" id="cancelButton" style="display: none;">Cancel</button>
    </form>
    <?php if ($_SESSION['tipo'] !== 'segretaria' && count($corsi) > 0) : ?>
        <h1>I tuoi Corsi</h1>
        <div class="courses">
            <?php foreach ($corsi as $corso) : ?>
                <div class="course">
                    <div class="circular-square">
                        <img src="./uploads/<?= htmlspecialchars($corso['istruttore']['foto']) ?>" alt="Immagine" class="clickable" data-istruttore='<?= htmlspecialchars(json_encode(['nome' => $corso['istruttore']['nome'], 'cognome' => $corso['istruttore']['cognome'], 'email' => $corso['istruttore']['email'], 'cellulare' => $corso['istruttore']['cellulare']])) ?>'>
                    </div>

                    <h2><?= $corso['nome'] ?></h2>

                    <p><?= $corso['descrizione'] ?></p>
                    <?php if (!empty($corso['lezioni'])) : ?>
                        <div class="lessons">
                            <h3>Lezioni:</h3>
                            <?php foreach ($corso['lezioni'] as $lezione) : ?>
                                <p><?= $lezione['giorno'] ?> <?= $lezione['oraInizio'] ?> - <?= $lezione['oraFine'] ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        <p>Nessuna lezione disponibile per questo corso.</p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>


    <?php endif; ?>
    <div id="popup" class="popup">
        <div class="popup-content">
            <span class="close">&times;</span>
            <h2>Dettagli dell'istruttore</h2>
            <img id="istruttoreFoto">
            <p id="istruttoreNome">.</p>
            <p id="istruttoreEmail">.</p>
            <p id="istruttoreCellulare">.</p>
        </div>
    </div>
    <?php include_once "templates/footer.html" ?>
    <script src="./js/popup.js"></script>
    <script src="./js/modificaProfilo.js"></script>
</body>

</html>
