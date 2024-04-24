<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "templates/head.html" ?>
    <title>Palestra XYZ</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            overflow: hidden;
            /* Impedisce lo scrolling della pagina */
        }

        .hero-image {
            background-image: url(./img/palestra2.jpg);
            /* Inserisci il percorso dell'immagine della palestra */
            background-size: cover;
            /* Copri l'intera area con l'immagine */
            background-position: center;
            height: 100vh;
            /* Altezza pari all'altezza della finestra del browser */
            width: 100%;
            /* Larghezza pari alla larghezza della finestra del browser */
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
<style>.container {
    min-width: 100%;
    max-width: 100%;
   
    width: 100%;
    height: 100%;
   
    margin-left: 0px;
    margin-right: 0px;
  }
 
body {
    background-color: black;
}
  .img-responsive {
    width: 100%;
    height: 100%;
    object-fit: cover;
   
    top: 0;
    left: 0;
  }
  </style>
<body>
    <?php include "templates/navbar.php" ?>
    <div class="container" style="padding-left: 0px; padding-right: 0px;">
    <img src="./images/homepage.png" alt="Immagine" class="img-responsive">
    </div>
    </div>
    <div style="width: 50%">
        <iframe width="100%" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=stadio%20maradona%20napoli+(Palestra%20Bella)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
        </iframe>
    </div>

</body>

</html>
