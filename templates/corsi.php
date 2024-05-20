<?php
$corsi = array();
$stmt = mysqli_prepare($conn, "SELECT corso.idCorso, foto, nomeCorso, descrizioneCorso, prezzoOrario as prezzo, postiliberi, nome, cognome, email, cellulare FROM corso INNER JOIN utente ON utente.idUtente = corso.idIstruttore INNER JOIN tipologia ON tipologia.idTipologia = corso.idTipologia INNER JOIN postiliberipercorso ON corso.idCorso = postiliberipercorso.idCorso");
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
mysqli_close($conn);

while ($row = mysqli_fetch_assoc($result)) {
    $corsi[] = $row;
}
?>
<h1>I Nostri Corsi</h1>
<div class="courses">
    <?php foreach ($corsi as $corso) : ?>
        <div class="course">
            <?php if (isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'segretaria') : ?>
                <a href="./modificaCorso.php?idcorso=<?= $corso['idCorso'] ?>" class="edit-btn"><i class="fas fa-pen"></i></a>
            <?php endif ?>
            <div class="circular-square">
                <img src="./uploads/<?= htmlspecialchars($corso['foto']) ?>" alt="Immagine" class="clickable" data-istruttore='<?= htmlspecialchars(json_encode(['nome' => $corso['nome'], 'cognome' => $corso['cognome'], 'email' => $corso['email'], 'cellulare' => $corso['cellulare']])) ?>'>
            </div>

            <h2><?= $corso['nomeCorso'] ?></h2>

            <p><?= $corso['descrizioneCorso'] ?></p>
            <p class="days">Lunedì 10.00-12.00</p>
            <p class="days">Mercoledì 10.00-12.00</p>
            <p class="price">€<strong><?= $corso['prezzo'] ?></strong>/ora</p>
            <p class="price">Posti Liberi: <strong><?= $corso['postiliberi'] ?></strong></p>
            <a href="./.php?idCorso=<?= $corso['idCorso'] ?>" class="btn">Prenota</a>
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
<script src="./js/corsi.js"></script>
