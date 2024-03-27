<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiungi Corso</title>
</head>
<body>
    <h1>Aggiungi un nuovo corso</h1>
    <form action="aggiungi_corso.php" method="post">
        <label for="titolo">Titolo del corso:</label><br>
        <input type="text" id="titolo" name="titolo" required><br><br>
        
        <label for="descrizione">Descrizione:</label><br>
        <textarea id="descrizione" name="descrizione" rows="4" cols="50" required></textarea><br><br>
        
        <label for="categoria">Categoria:</label><br>
        <input type="text" id="categoria" name="categoria" required><br><br>
        
        <label for="istruttore">Istruttore:</label><br>
        <input type="text" id="istruttore" name="istruttore" required><br><br>
        
        <input type="submit" value="Aggiungi Corso">
    </form>
</body>
</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titolo = $_POST["titolo"];
    $descrizione = $_POST["descrizione"];
    $categoria = $_POST["categoria"];
    $istruttore = $_POST["istruttore"];

    $stmt = $pdo->prepare("INSERT INTO corsi (titolo, descrizione, categoria, istruttore) VALUES (?, ?, ?, ?)");
    $stmt->execute([$titolo, $descrizione, $categoria, $istruttore]);
    
    if ($stmt) {
        echo "Corso aggiunto con successo!";
    } else {
        echo "Si è verificato un errore durante l'aggiunta del corso.";
    }
}
?>
