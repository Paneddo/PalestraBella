<?php
session_start();
include_once "utils.php";

if (!isset($_SESSION["id"]) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("HTTP/1.1 401 Unauthorized");
    exit();
}

$idUtente = $_SESSION['id'];


$nome = $_POST['nome'] ?? '';
$cognome = $_POST['cognome'] ?? '';
$email = $_POST['email'] ?? '';
$gender = $_POST['gender'] ?? '';

$conn = getConnection();

$stmt = mysqli_prepare($conn, "UPDATE utente SET nome = ?, cognome = ?, email = ? WHERE idUtente = ?");
mysqli_stmt_bind_param($stmt, "ssss", $nome, $cognome, $email, $idUtente);

mysqli_stmt_execute($stmt);
mysqli_close($conn);
