<?php
session_start();


$titolo = '';
$testo = '';
$rating = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include "utils.php";
    $conn = getConnection();

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
    <?php include "templates/head.html" ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        .checked {
            color: gold;
        }

        .ratings_stars {
            cursor: pointer;
        }
    </style>
    <script src="./js/recensioni.js" defer></script>
</head>

<body>
    <h2>Crea Recensione</h2>

    <form action="<?php echo ($_SERVER['PHP_SELF']); ?>" method="post">
        <div>
            <label for="titolo">Titolo:</label>
            <input type="text" name="titolo" placeholder="Titolo..." id="titolo" value="<?php echo ($titolo); ?>">
        </div>
        <div>
            <label for="testo">Testo:</label>
            <textarea name="testo" placeholder="Testo..." id="testo"></textarea>
        </div>
        <div class="rating" id="r">
            <i class="ratings_stars fa fa-star" data-rating="1"></i>
            <i class="ratings_stars fa fa-star" data-rating="2"></i>
            <i class="ratings_stars fa fa-star" data-rating="3"></i>
            <i class="ratings_stars fa fa-star" data-rating="4"></i>
            <i class="ratings_stars fa fa-star" data-rating="5"></i>
        </div>
        <input type="hidden" id="rating" name="rating" value="-1">
        <div>
            <button type="submit">Crea Recensione</button>
        </div>
        <?php
        if (!empty($login_error)) {
            echo '<div style="color: red;">' . $login_error . '</div>';
        }
        ?>
    </form>
</body>

</html>
