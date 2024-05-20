<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Recensioni</title>
    <?php include "./templates/head.html" ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        /* Stile per la card */
        .card {
            background-color: #333;
            /* Grigio scuro */
            border-radius: 15px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            margin: 0;
            /* Rimuove lo spazio tra la card e il contorno giallo */
            max-width: 590px;
            /* Imposta una larghezza massima leggermente inferiore alla larghezza del carousel */
            height: 290px;
            color: white;
            /* Colore del testo bianco */
        }

        /* Stile per il carousel */
        .carousel {
            margin-top: 35px;
            border-radius: 15px;
            border: 5px solid #FFBF00;
            /* Aggiungi il bordo giallo */
            position: relative;
            /* Per posizionare la striscia sotto il carousel */
            width: 600px;
            height: 300px;
            /* Altezza modificata */
            margin-left: auto;
            margin-right: auto;
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
            border-radius: 15px;
            width: 600px;
            height: 290px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Stile per i bordi arrotondati dell'immagine nel secondo carousel */
        .carousel-item img {
            max-width: 590px;
            /* Imposta una larghezza massima leggermente inferiore alla larghezza del carousel */
            height: auto;
            /* Per mantenere l'aspetto proporzionato */
            border-radius: 10px;
            /* Aggiunge bordi arrotondati */
            max-height: 280px;
            /* Altezza massima dell'immagine */
        }

        /* Stile per i bordi arrotondati della card nel primo carousel */
        #cardCarousel .card {
            border-radius: 10px;
        }

        /* Stile per il testo del tipo di utente in giallo, maiuscolo e grassetto */
        .user-type {
            color: #FFBF00;
            /* Giallo */
            text-transform: uppercase;
            /* Maiuscolo */
            font-weight: bold;
            /* Grassetto */
        }

        /* Stile per il colore delle stelle in giallo */
        .fas.fa-star {
            color: #FFBF00;
            /* Giallo */
        }

        /* Nascondi le frecce di navigazione solo su dispositivi di grandi dimensioni */
        @media (min-width: 768px) {

            .carousel-control-prev,
            .carousel-control-next {
                font-size: 10px;
                /* Riduci la dimensione dell'icona */
            }
        }
    </style>
</head>

<body>
    <?php include "./templates/navbar.php" ?>
    <div class="container">
        <div class="title">
            <h2>Recensioni</h2>
        </div>

        <div id="cardCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <!-- PHP per ottenere recensioni dal database -->
                <?php
                include_once "utils.php";
                $conn = getConnection();

                // Query per recuperare le recensioni dal database con i dati dell'utente
                $sql = "SELECT nome, cognome, dataRecensione, tipo, titolo, testo, numeroStelle FROM recensione INNER JOIN utente ON utente.idUtente = recensione.idUtente";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output dei dati delle recensioni nel carousel
                    $active = true; // Per impostare la prima recensione come attiva
                    while ($row = $result->fetch_assoc()) {
                        // Generazione della slide del carousel
                        echo '<div class="carousel-item ' . ($active ? 'active' : '') . '">';
                        echo '<div class="card">';
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title">' . $row["nome"] . ' ' . $row["cognome"] . '</h5>'; // Nome e cognome dell'utente
                        echo '<p class="user-type">' . strtoupper($row["tipo"]) . '</p>'; // Tipo di utente (tutto in maiuscolo)
                        echo '<div>'; // Stelle
                        for ($i = 0; $i < $row["numeroStelle"]; $i++) {
                            echo '<i class="fas fa-star"></i>';
                        }
                        echo '</div>';
                        echo '<h6 class="card-title">' . $row["titolo"] . '</h6>'; // Titolo della recensione
                        echo '<p class="card-text">' . $row["testo"] . '</p>'; // Testo della recensione
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        $active = false; // Imposta le prossime recensioni come non attive
                    }
                } else {
                    echo "0 risultati";
                }
                $conn->close();
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
    </div>
</body>

</html>
