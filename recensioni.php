<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Recensioni</title>
    <?php include "./templates/head.html" ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        html, body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: black;
        }

        .navbar-nav2 .nav-item {
            margin-right: 0.01px; 
            margin-left: 0.01px;
        }
        .container {
            width: 100%;
            max-width: 100%;
            padding: 0;
        }

        .card {
            background-color: #333;
            border-radius: 10px;
            max-width: 100%;
            height: auto;
            padding: 45px;
            color: white;
        }

        .carousel {
            margin-top: 20px;
            border-radius: 15px;
            border: 5px solid #FFBF00;
            position: relative;
            width: 600px;
            height: 300px;
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
            height: 5px;
            width: calc(100% - 800px);
            background-color: #FFBF00;
            z-index: -1;
        }

        #imageCarousel {
            border-radius: 15px;
            width: 600px;
            height: 290px;
            margin-left: auto;
            margin-right: auto;
        }

        .carousel-item img {
            max-width: 590px;
            height: auto;
            border-radius: 10px;
            max-height: 280px;
        }

        #cardCarousel .card {
            border-radius: 10px;
        }

        .user-type {
            color: #FFBF00;
            text-transform: uppercase;
            font-weight: bold;
        }

        .fas.fa-star {
            color: #FFBF00;
        }

        .btn-yellow {
            background-color: #FFBF00;
            color: black;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            display: block;
            margin: 20px auto;
            max-width: 200px; 
            text-align: center;
            border-radius: 15px;
            font-family: 'Poppins', sans-serif;
            font-weight: bold;
            width: 100%;
        }

        @media (min-width: 768px) {
            .carousel-control-prev,
            .carousel-control-next {
                font-size: 10px;
            }
        }
    </style>
</head>

<body>

    <?php include "./templates/navbar.php" ?>
    <div class="title">
        <h1>Recensioni</h1>
    </div>
    <div class="container">
        <div id="cardCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php
                include_once "utils.php";
                $conn = createConnection();

                $sql = "SELECT nome, cognome, dataRecensione, tipo, titolo, testo, numeroStelle FROM recensione INNER JOIN utente ON utente.idUtente = recensione.idUtente";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $active = true;
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="carousel-item ' . ($active ? 'active' : '') . '">';
                        echo '<div class="card">';
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title">' . $row["nome"] . ' ' . $row["cognome"] . '</h5>';
                        echo '<p class="user-type">' . strtoupper($row["tipo"]) . '</p>';
                        echo '<div>';
                        for ($i = 0; $i < $row["numeroStelle"]; $i++) {
                            echo '<i class="fas fa-star"></i>';
                        }
                        echo '</div>';
                        echo '<h6 class="card-title">' . $row["titolo"] . '</h6>';
                        echo '<p class="card-text">' . $row["testo"] . '</p>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        $active = false;
                    }
                } else {
                    echo "0 risultati";
                }
                $conn->close();
                ?>
            </div>
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
    <a href="aggiungiRecensione.php" class="btn-yellow">Scrivi recensione</a>
</body>
   <?php include "./templates/footer.html" ?>

</html>
