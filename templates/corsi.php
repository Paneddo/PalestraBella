<?php
include "conn.php";
$corsi = array();
$stmt = mysqli_prepare($conn, "SELECT * FROM corso");

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
mysqli_close($conn);

while ($row = mysqli_fetch_assoc($result)) {
    $corsi[] = $row;
}

?>
<link rel="stylesheet" href="styles/corsi.css" />

<div>
    <h1 style="text-align: center;">I nostri corsi</h1>
    <div class="space"></div>
    <div class="courses">
        <?php foreach ($corsi as $corso) : ?>
            <div class="course">
                <div class="circular-square">
                    <img src="images/icon.png" alt="Immagine">
                </div>

                <h2><?= $corso['TitoloCorso'] ?></h2>
                <p>tipologia</p>
                <p>numero posti</p>
                <p>descrizione</p>
                <p>lezione</p>
                <p>prezzo</p>
                <a href="#" class="btn">Prenota</a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
