<?php
$corsi = array();
$stmt = mysqli_prepare($conn, "SELECT corso.idCorso, foto, nomeCorso as nome, prezzoOrario as prezzo, postiliberi FROM corso INNER JOIN utente ON utente.idUtente = corso.idIstruttore INNER JOIN tipologia ON tipologia.idTipologia = corso.idTipologia INNER JOIN postiliberipercorso ON corso.idCorso = postiliberipercorso.idCorso");
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
            <div class="circular-square">
                <img src="./uploads/<?= $corso['foto'] ?>" alt="Immagine">
            </div>

            <h2><?= $corso['nome'] ?></h2>

            <p class="days">Lunedì 10.00-12.00</p>
            <p class="days"> Mercoledì 10.00-12.00</p>
            <p class="price">€<strong><?= $corso['prezzo'] ?></strong>/ora</p>
            <p class="price">Posti Liberi: <strong><?= $corso['postiliberi'] ?></strong></p>
            <a href="./.php?idCorso=<?= $corso['idCorso'] ?>" class="btn">Prenota</a>
            <?php if ($_SESSION['tipo'] === 'segretaria') : ?>
                <a href="./modificaCorso.php?idcorso=<?= $corso['idCorso'] ?>">Modifica</a>
            <?php endif ?>
        </div>
    <?php endforeach; ?>
</div>
