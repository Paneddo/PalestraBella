<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "templates/header.html" ?>
    <title>Palestra Bella</title>
</head>

<body>
    <?php include "templates/navbar.php" ?>
    <div style="width: 50%">
        <iframe width="100%" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=stadio%20maradona%20napoli+(Palestra%20Bella)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
        </iframe>
    </div>
    <?php include "templates/footer.html" ?>
</body>

</html>
