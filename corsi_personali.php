
<?php
session_start();
include "conn.php";

if (!isset($_SESSION["id"])) {
    header("location: ./index.php");
    exit();
}

$idUtente = $_SESSION['id'];
$nomeCorso = '';
$descrizioneCorso = '';

$stmt = mysqli_prepare($conn, "SELECT nomeCorso, descrizioneCorso FROM corso INNER JOIN prenotazione ON idCorso=Corso_idCorso INNERJOIN utente ON Utente_idUtente=idUtente WHERE idUtente=?");

mysqli_stmt_bind_param($stmt, "s", $idUtente);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
mysqli_close($conn);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $nomeCorso = $row['nomeCorso'];
    $descrizioneCorso = $row['descrizioneCorso'];

}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Form</title>
    <meta name="description" content="">
    <?php include "templates/head.html" ?>
</head>

<body>

    <?php include 'templates/navbar.php'; ?>
    <form>
        <div class="form-group">
            <label for="corso">nomeCorso</label>
            <input type="text" value="<?php echo $nomeCorso ?>" class="form-control" id="nomeCorso" disabled>
        </div>
        <div class="form-group">
            <label for="corso">descrizioneCorso</label>
            <input type="text" value="<?php echo $descrizioneCorso ?>" class="form-control" id="nomeCorso" disabled>
        </div>
    </form>
</body>

</html>
