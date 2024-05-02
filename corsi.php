<?php
include "conn.php";


$recensioni = array();

include "conn.php";

$stmt = mysqli_prepare($conn, "SELECT * FROM corso");

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
mysqli_close($conn);

while ($row = mysqli_fetch_assoc($result)) {
    $recensioni[] = $row;
}

?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./corsi.css" />
    <title>I NOSTRI SERVIZI</title>
</head>

<body>    
    <h1 style="text-align: center;">I nostri corsi</h1>
    <div class="space"></div> 
    <div class="courses">
        <?php foreach ($recensioni as $corso) : ?>
            <div class="course">
                <div class="circular-square">
                    <img src="istruttore3.jpg" alt="Immagine">
                </div>

                <h2><?= $corso['nomeCorso'] ?></h2>

                <p class="days">Lunedì 10.00-12.00</p> 
                <p class="days"> Mercoledì 10.00-12.00</p> 
                <p class="price">€<strong>10</strong>/ora</p>
                <a href="#" class="btn">Prenota</a>
            </div>
        <?php endforeach; ?>
    </div></body>

</html>
