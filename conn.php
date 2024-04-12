<?php
// Dati di connessione  
$servername = "localhost";
$username_db = "root";
$password_db = "";
$db = "palestra";

// Creazione della connessione 
$conn = mysqli_connect($servername, $username_db, $password_db, $db);

// Test della connessione 
if (!$conn) {
     die("Connection failed: " . mysqli_connect_error());
}
