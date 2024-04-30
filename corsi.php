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
    <title>I NOSTRI SERVIZI</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: rgba(255, 252, 247, 0.4);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: white;
        }

        .courses {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
            gap: 20px;
        }

        .course {
            max-width: 500px;
            /* Limita la larghezza della classe course */
            padding: 20px;
            background-color: black;
            /* Cambiato colore di sfondo */
            border-radius: 30px;
            /* Ingrandito il bordo */
            border: 4px solid white;
            /* Aggiunto bordo bianco */
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            text-align: center;
            display: flex;
            /* Utilizza Flexbox */
            flex-direction: column;
            /* Organizza gli elementi in colonna */
            justify-content: space-between;
            /* Distribuisce uniformemente lo spazio tra gli elementi */
            align-items: center;
            /* Centra orizzontalmente gli elementi */
        }

        .course h2,
        .course p,
        .course .btn {
            color: white;
            /* Cambiato colore del testo */
        }

        .course h2 {
            margin-top: 0;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: yellow;
            color: black;
            text-decoration: none;
            border-radius: 5px;

        }

        .btn:hover {
            background-color: #0056b3;
        }

        .price {
            font-weight: bold;
        }

        .days {
            text-decoration: underline;
            /* Sottolineato il testo */
        }

        body {
            background: black;
            background-attachment: fixed;
            overflow-y: hidden;
            overflow-x: hidden;
            margin: 0;
            padding: 0;
            background-size: cover;
        }

        html {
            overflow-y: scroll;
            overflow-x: hidden;
        }

        .circular-square {
            border-radius: 50%;
            width: 100px;
            /* Ridimensionata la larghezza dell'immagine */
            height: 100px;
            /* Ridimensionata l'altezza dell'immagine */
            overflow: hidden;
            /* Evita che le immagini sforino dai bordi circolari */
        }

        .circular-square img {
            width: 100%;
            /* Imposta la larghezza dell'immagine al 100% del suo contenitore */
            height: auto;
            /* Imposta l'altezza automaticamente per mantenere le proporzioni */
            object-fit: cover;
            /* Scala e taglia l'immagine per adattarla al contenitore */
        }
    </style>
</head>

<body>

    <h1>I nostri corsi</h1>
    <div class="space"></div> <!-- Spazio aggiunto -->
    <div class="courses">
        <?php foreach ($recensioni as $corso) : ?>
            <div class="course">
                <div class="circular-square">
                    <img src="istruttore3.jpg" alt="Immagine">
                </div>

                <h2><?= $corso['nomeCorso'] ?></h2>

                <p class="days">Lunedì 10.00-12.00</p> <!-- Aggiunta la classe "days" per sottolineare -->
                <p class="days"> Mercoledì 10.00-12.00</p> <!-- Aggiunta la classe "days" per sottolineare -->
                <p class="price">€<strong>10</strong>/ora</p>
                <a href="#" class="btn">Prenota</a>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>
