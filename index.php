<?php
session_start();
include_once "utils.php";
$conn = getConnection();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include_once "templates/head.html" ?>
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
  <?php include_once "templates/navbar.php" ?>
  <div class="container" style="padding-left: 0px; padding-right: 0px;">
    <img src="./images/homepage.png" alt="Immagine" class="img-responsive">
  </div>
  <?php include_once "templates/corsi.php" ?>
  <?php include_once "templates/aboutUs.html" ?>
  <?php include_once "templates/footer.html" ?>
</body>

</html>
