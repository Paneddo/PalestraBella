<?php
session_start();


$titolo = '';
$testo = '';
$rating = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once "utils.php";
    $conn = createConnection();

    $titolo = test_input($_POST['titolo']);
    $testo = test_input($_POST['testo']);
    $rating = test_input($_POST['rating']);
    $idUtente = $_SESSION['id'];

    $stmt = mysqli_prepare($conn, "INSERT INTO recensione (titolo, testo, numeroStelle, idUtente, dataRecensione) VALUES (?, ?, ?, ?, NOW())");

    mysqli_stmt_bind_param($stmt, "ssss", $titolo, $testo, $rating, $idUtente);
    mysqli_stmt_execute($stmt);

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <?php include_once "templates/head.html" ?>
    <link rel="stylesheet" href="styles/form.css">
    <title>Recensione</title>
    <style>
        .rating {
            text-align: center;
            font-size: 2.5rem;
        }

        .ratings_stars {
            cursor: pointer;
            color: white;
        }

        .checked {
            color: gold;
        }
    </style>
    <script src="./js/recensioni.js" defer></script>
</head>

<body>
    <h1>Lascia Una Recensione</h1>

    <form action="<?php echo ($_SERVER['PHP_SELF']); ?>" method="post">
        <div>
            <label for="titolo">Titolo:</label>
            <input type="text" name="titolo" placeholder="Titolo..." id="titolo">
        </div><br>
        <div>
            <label for="testo">Testo:</label>
            <textarea name="testo" placeholder="Testo..." id="testo"></textarea>
        </div><br>
        <div class="rating" id="r">
            <i class="ratings_stars fa fa-star" data-rating="1"></i>
            <i class="ratings_stars fa fa-star" data-rating="2"></i>
            <i class="ratings_stars fa fa-star" data-rating="3"></i>
            <i class="ratings_stars fa fa-star" data-rating="4"></i>
            <i class="ratings_stars fa fa-star" data-rating="5"></i>
        </div><br>
        <input type="hidden" id="rating" name="rating" value="-1">
        <div>
            <button type="submit">Invia</button>
        </div>
    </form>
</body>

</html>
