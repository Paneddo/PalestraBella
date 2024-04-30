<?php
include "conn.php";


$recensioni = array();

include "conn.php";

$query = "SELECT nome, cognome, dataRecensione, titolo, testo, numeroStelle FROM recensione INNER JOIN utente ON utente.idUtente = recensione.idUtente";

$result = mysqli_query($conn, $query);
mysqli_close($conn);

while ($row = mysqli_fetch_assoc($result)) {
    $recensioni[] = $row;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Recensioni</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Aggiunto FontAwesome -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        /* Stile per la card */
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            margin: 0;
            /* Rimuove lo spazio tra la card e il contorno giallo */
            width: 600px;
            height: 300px;
        }

        /* Stile per il carousel */
        .carousel {
            margin-top: 35px;
            border-radius: 25px;
            border: 5px solid #FFBF00;
            /* Contorni gialli */
            position: relative;
            /* Per posizionare la striscia sotto il carousel */
            width: 600px;
            height: 300px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Stile per l'immagine piccola */
        .small-img {
            width: 100px;
            height: 100px;
            border-radius: 10px;
            margin-top: 10px;
        }

        .small-img2 {
            width: auto;
            height: auto;
            border-radius: 10px;
            margin-top: 10px;
            margin-left: 500px;
        }

        .title {
            color: gray;
            text-align: center;
            position: relative;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .title::after {
            content: '';
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            bottom: -10px;
            /* Più in basso */
            height: 5px;
            /* Più spessa */
            width: calc(100% - 800px);
            /* Estende la striscia fino al testo */
            background-color: #FFBF00;
            /* Sottolineatura gialla */
            z-index: -1;
            /* Sposta sotto il testo */
        }

        /* Stile per lo sfondo nero */
        body {
            background-color: black;
        }

        #imageCarousel {
            border-radius: 20px;
            width: 600px;
            height: 300px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Stile per i bordi arrotondati dell'immagine nel secondo carousel */
        .carousel-item img {
            border-radius: 20px;
        }

        /* Stile per i bordi arrotondati della card nel primo carousel */
        #cardCarousel .card {
            border-radius: 20px;
        }
    </style>
</head>

<body>
    <?php
    var_dump($recensioni);
    ?>
    <div class="container">
        <div class="title">
            <h2>Recensioni</h2>
        </div>

        <div id="cardCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php

                // Output dei dati delle recensioni nel carousel
                $active = true;
                // Generazione della slide del carousel
                echo '<div class="carousel-item ' . ($active ? 'active' : '') . '">';
                echo '<div class="card">';
                echo '<div class="card-header">' . "Andrea" . ' ' . "Crivella" . '</div>';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . "Titolo" . '</h5>';
                echo '<p class="card-text">' . "Testo" . '</p>';
                echo '<div>';
                for ($i = 0; $i < 3; $i++) {
                    echo '<i class="fas fa-star"></i>';
                }
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                $active = false; // Imposta le prossime recensioni come non attive
                ?>
            </div>
            <!-- Pulsanti di navigazione -->
            <a class="carousel-control-prev" href="#cardCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Precedente</span>
            </a>
            <a class="carousel-control-next" href="#cardCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Successivo</span>
            </a>
        </div>


</body>

</html>
