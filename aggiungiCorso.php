<?php
session_start();
if ($_SESSION['tipo'] !== 'segretaria') {
    header("location: ./accessoNegato.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Aggiungi Corso</title>
    <?php include "templates/header.html" ?>
    <link rel="stylesheet" href="styles/form.css">
</head>

<body>
    <?php include "templates/navbar.php" ?>
    <h1>AGGIUNGI UN CORSO</h1>
    <?php if (!empty($message)) : ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    <form action="<php echo $_SERVER['PHP_SELF'] ?"> method="post">
        <label for="titolo">Titolo del corso:</label><br>
        <input type="text" id="titolo" name="titolo" placeholder="Titolo..." required><br><br>

        <label for="descrizione">Descrizione:</label><br>
        <textarea id="descrizione" name="descrizione" rows="4" cols="50" placeholder="Descrizione..." required></textarea><br><br>

        <label for="categoria">Categoria:</label><br>
        <select id="categoria" name="categoria" required>
            <option value="" disabled selected hidden>Seleziona una categoria</option>
            <option value="Cardio">Cardio</option>
            <option value="Sollevamento pesi">Sollevamento pesi</option>
            <option value="Yoga">Yoga</option>
            <option value="Pilates">Pilates</option>
            <option value="Zumba">Zumba</option>
            <option value="Boxe">Boxe</option>
        </select><br><br>

        <label for="istruttore">Istruttore:</label><br>
        <select id="istruttore" name="istruttore" required>
            <option value="" disabled selected hidden>Seleziona un istruttore</option>
            <option value="istruttore1">Istruttore 1</option>
            <option value="istruttore2">Istruttore 2</option>
        </select><br><br>

        <button type="submit">Aggiungi Corso</button>
    </form>
</body>

</html>
