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

$conn = getConnection();
$stmt = mysqli_prepare($conn, "INSERT INTO prenotazione VALUES (?, ?)");

mysqli_stmt_bind_param($stmt, "ss", $idUtente, $idCorso);
mysqli_stmt_execute($stmt);

mysqli_close($conn);