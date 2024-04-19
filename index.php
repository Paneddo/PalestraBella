<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Palestra XYZ</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            overflow: hidden; /* Impedisce lo scrolling della pagina */
        }

        .hero-image {
            background-image: url(./img/palestra2.jpg); /* Inserisci il percorso dell'immagine della palestra */
            background-size: cover; /* Copri l'intera area con l'immagine */
            background-position: center;
            height: 100vh; /* Altezza pari all'altezza della finestra del browser */
            width: 100%; /* Larghezza pari alla larghezza della finestra del browser */
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            text-align: center;
            padding: 20px;
            box-sizing: border-box;
        }

        .hero-content {
            max-width: 800px;
        }

        .hero-content h1 {
            font-size: 3em;
            margin-bottom: 20px;
        }

        .hero-content p {
            font-size: 1.2em;
            margin-bottom: 30px;
        }

        .hero-content a {
            background-color: #ff7f00;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1.2em;
            transition: background-color 0.3s ease;
        }

        .hero-content a:hover {
            background-color: #e66500;
        }
    </style>
</head>
<body>

<div class="hero-image">
    <div class="hero-content">
        <h1 style="color:#FFBF00D1; text-align: left" >S T R O N G</h1>
        <p>Il posto perfetto per raggiungere i tuoi obiettivi di fitness.</p>
       
    </div>
</div>

</body>
</html>
