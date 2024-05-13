<?php
include "utils.php";

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
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/corsi.css" />
    <title>I NOSTRI SERVIZI</title>
</head>

<body>
    <h1 style="text-align: center;">I nostri corsi</h1>
    <div class="space"></div>
    <div class="courses">
        <?php foreach ($corsi as $corso) : ?>
            <div class="course">
                <div class="circular-square">
                    <img src="./uploads/" <?= $corso['foto'] ?> alt="Immagine">
                </div>

                <h2><?= $corso['nome'] ?></h2>

                <p class="days">Lunedì 10.00-12.00</p>
                <p class="days"> Mercoledì 10.00-12.00</p>
                <p class="price">€<strong><?= $corsi['prezzo'] ?></strong>/ora</p>
                <a href="#" class="btn">Prenota</a>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>
