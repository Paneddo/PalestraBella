<?php
$conn = createConnection();
$sql = "SELECT corso.idCorso, corso.nomeCorso, corso.descrizioneCorso, corso.idIstruttore, utente.nome AS nomeIstruttore, utente.cognome AS cognomeIstruttore, utente.foto, email, cellulare, tipologia.nomeTipologia, tipologia.prezzoOrario,lezione.giorno, lezione.oraInizio, lezione.oraFine, postiliberi
        FROM corso
        LEFT JOIN lezione ON corso.idCorso = lezione.idCorso
        LEFT JOIN utente ON corso.idIstruttore = utente.idUtente
        LEFT JOIN tipologia ON corso.idTipologia = tipologia.idTipologia
        LEFT JOIN postiliberipercorso ON corso.idCorso = postiliberipercorso.idCorso
        ORDER BY corso.nomeCorso";

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
                'tipologia' => array(
                    'nome' => $row['nomeTipologia'],
                    'prezzo' => $row['prezzoOrario'],
                ),
                'lezioni' => array(),
                'postiliberi' => $row['postiliberi']
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

<h1>I Nostri Corsi</h1>
<div class="courses">
    <?php foreach ($corsi as $corso) : ?>
        <div class="course">
            <?php if (isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'segretaria') : ?>
                <a href="./modificaCorso.php?idcorso=<?= $corso['id'] ?>" class="edit-btn"><i class="fas fa-pen"></i></a>
            <?php endif ?>
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
            <p class="price">€<strong><?= $corso['tipologia']['prezzo'] ?></strong>/ora</p>
            <p class="price">Posti Liberi: <strong><?= $corso['postiliberi'] ?></strong></p>
            <a href="./prenotaCorso.php?idCorso=<?= $corso['id'] ?>" class="btn">Prenota</a>
        </div>
    <?php endforeach; ?>
</div>

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
<script src="./js/popup.js"></script>
