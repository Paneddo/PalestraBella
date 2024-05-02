<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "templates/head.html" ?>
    <title>Palestra XYZ</title>
</head>
<style>
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
    <?php include "corsi.php" ?>
    <?php include "templates/footer.html" ?>
</body>

</html>
