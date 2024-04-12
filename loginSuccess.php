<!DOCTYPE html>

<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("location: ./login.php");  
    exit();
}

$username = $_SESSION['username'];

?>

<html lang="it">
    <link rel="stylesheet" href="stile.css">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
<h2>Ciao <?php echo "$username" ?></h2>
    
<a href="./logout.php">
    <button>Logout</button>
</a>
    
</body>
</html>
