<?php
session_start();

if (!isset($_SESSION['id']) || !isset($_GET['idCorso'])) {
    header("location: ./accessoNegato.php");
    exit();
}

if ($_SESSION['tipo'] !== 'cliente') {
    echo "Non sei un cliente";
    exit();
}

include_once "utils.php";

$idUtente = $_SESSION['id'];
$idCorso = $_GET['idCorso'];

$conn = createConnection();

$stmt = mysqli_prepare($conn, "SELECT postiliberi FROM postiliberipercorso WHERE idCorso = ?");
mysqli_stmt_bind_param($stmt, "s", $idCorso);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
if ($row['postiliberi'] == 0) {
    echo 'Corso Pieno!';
    exit();
}

$stmt = mysqli_prepare($conn, "INSERT INTO prenotazione VALUES (?, ?)");

mysqli_stmt_bind_param($stmt, "ss", $idUtente, $idCorso);
mysqli_stmt_execute($stmt);

mysqli_close($conn);

header("location: ./profilo.php");
// exit();
