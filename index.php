<?php
session_start();
include "utils.php";
$conn = getConnection();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "templates/head.html" ?>
  <link rel="stylesheet" href="styles/corsi.css">
  <title>PeppeGym</title>
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
  <?php include "templates/corsi.php" ?>
  <?php include "templates/aboutUs.html" ?>
  <?php include "templates/footer.html" ?>
</body>

</html>
