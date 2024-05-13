<?php
include_once "utils.php";

$corsi = array();
$conn = getConnection();
$stmt = mysqli_prepare($conn, "SELECT foto, nomeCorso as nome, prezzoOrario as prezzo FROM corso INNER JOIN utente ON utente.idUtente = corso.idIstruttore INNER JOIN tipologia ON tipologia.idTipologia = corso.idTipologia");
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
mysqli_close($conn);

while ($row = mysqli_fetch_assoc($result)) {
    $corsi[] = $row;
}
?>
<div class="courses">
    <?php foreach ($corsi as $corso) : ?>
        <div class="course">
            <div class="circular-square">
                <img src="./uploads/<?= $corso['foto'] ?>" alt="Immagine">
            </div>

            <h2><?= $corso['nome'] ?></h2>

            <p class="days">Lunedì 10.00-12.00</p>
            <p class="days"> Mercoledì 10.00-12.00</p>
            <p class="price">€<strong><?= $corsi['prezzo'] ?></strong>/ora</p>
            <a href="#" class="btn">Prenota</a>
        </div>
    <?php endforeach; ?>
</div>
