<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> 
<link rel="stylesheet" href="recensioni.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
 
<body>
 
<div class="container">
    <div class="title">
        <h2>RECENSIONI</h2>
    </div>
 
    <div id="cardCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "palestra";
 
            $conn = new mysqli($servername, $username, $password, $dbname);
 
            if ($conn->connect_error) {
                die("Connessione fallita: " . $conn->connect_error);
            }
 
            $sql = "SELECT recensione.titolo, recensione.testo, recensione.stelle, recensione.dataRecensione, utente.nome, utente.cognome, utente.tipo
                    FROM recensione
                    JOIN utente ON recensione.Utente_idUtente = utente.idUtente";
            $result = $conn->query($sql);
 
            if ($result->num_rows > 0) {
                $active = true;
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="carousel-item ' . ($active ? 'active' : '') . '">';
                    echo '<div class="cardRecensioni">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $row["nome"] . ' ' . $row["cognome"] . '</h5>'; 
                    echo '<p class="user-type">' . strtoupper($row["tipo"]) . '</p>';
                    echo '<div>'; 
                    for ($i = 0; $i < $row["stelle"]; $i++) {
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
 
    <div class="title">
        <h2>GALLERIA</h2>
    </div>    <div id="imageCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/1.jpg" class="d-block w-100" style="max-height: 280px;" alt="...">
            </div>
            <div class="carousel-item">
                <img src="images/2.jpg" class="d-block w-100" style="max-height: 280px;" alt="...">
            </div>
            <div class="carousel-item">
                <img src="images/3.jpg" class="d-block w-100" style="max-height: 280px;" alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="#imageCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Precedente</span>
        </a>
        <a class="carousel-control-next" href="#imageCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Successivo</span>
        </a>
    </div>
</div> 
</body>
