<?php
$corsi = array();
$stmt = mysqli_prepare($conn, "SELECT * FROM corso");

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
mysqli_close($conn);

while ($row = mysqli_fetch_assoc($result)) {
    $corsi[] = $row;
}

?>
<div>
    <h1 style="text-align: center;">I nostri corsi</h1>
    <div class="space"></div>
    <div class="courses">
        <?php foreach ($corsi as $corso): ?>
            <div class="course">
                <div class="circular-square">
                    <img src="../istruttore3.jpg" alt="Immagine">
                </div>

                <h2><?= $corso['nomeCorso'] ?></h2>

                <p class="days">Lunedì 10.00-12.00</p>
                <p class="days"> Mercoledì 10.00-12.00</p>
                <p class="price">€<strong>10</strong>/ora</p>
                <a href="#" class="btn">Prenota</a>
            </div>
        <?php endforeach; ?>
    </div>
</div>