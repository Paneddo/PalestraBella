<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['tipo'] !== 'segretaria') {
    header('Location: ./accessoNegato.php');
    exit();
}

$idCorso = $_GET['idcorso'];
echo $idCorso;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Modifica Corso</title>
    <?php include "templates/head.html" ?>
</head>

<body>

</body>

</html>
