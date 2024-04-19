<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "templates/head.html" ?>
    <title>Palestra Bella</title>
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
    <?php include "templates/footer.html" ?>
</body>

</html>
