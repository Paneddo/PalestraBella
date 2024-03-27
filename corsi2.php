

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>I nostri corsi </title>
    <style>
        /* Stili CSS per la formattazione della pagina */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
        }
        h2 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Palestra Bella</h2>
        <table>
            <tr>
                <th>Nome Corso</th>
                <th>Descrizione</th>
                <th>Orario</th>
            </tr>
            <?php
            // Array di esempio contenente i corsi della palestra
            $corsi = array(
                array("Yoga", "Corso di yoga per il benessere mentale e fisico.", "Lunedì e Mercoledì 18:00 - 19:30"),
                array("Pilates", "Corso per migliorare la flessibilità e la forza muscolare.", "Mercoledì e Venerdì 10:00 - 11:00"),
                array("Spinning", "Corso di ciclismo indoor ad alta intensità.", "Sabato 9:00 - 10:00")
            );

            // Iterazione attraverso l'array dei corsi per stampar
