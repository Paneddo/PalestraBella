<?php

// Quindi viene richiesta questa pagina direttamente
if (strcasecmp(str_replace('\\', '/', __FILE__), $_SERVER['SCRIPT_FILENAME']) == 0) {
     header('Location: ./index.php');
     exit();
}

use PHPMailer\PHPMailer\PHPMailer;

function test_input($data)
{
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
}

function createConnection()
{
     $servername = "localhost";
     $username_db = "root";
     $password_db = "";
     $db = "palestra";

     $conn = mysqli_connect($servername, $username_db, $password_db, $db);

     if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
     }

     return $conn;
}

function randomPassword($length)
{
     $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
     $pass = array();
     $alphaLength = strlen($alphabet) - 1;
     for ($i = 0; $i < $length; $i++) {
          $n = rand(0, $alphaLength);
          $pass[] = $alphabet[$n];
     }
     return implode($pass);
}


function sendMail($recipient, $subject, $message)
{
     require './vendor/phpmailer/phpmailer/src/PHPMailer.php';
     require './vendor/phpmailer/phpmailer/src/SMTP.php';
     require './vendor/phpmailer/phpmailer/src/Exception.php';

     $mail = new PHPMailer();
     $mail->IsSMTP();

     $mail->SMTPDebug = 0;
     $mail->CharSet = "UTF-8";
     $mail->Host = "smtp.gmail.com";
     $mail->Port = 465;

     $mail->SMTPSecure = 'ssl';
     $mail->SMTPAuth = true;

     $mail->Username = "peppegym5b@gmail.com";
     $mail->Password = $_ENV['gmail_token'];

     $mail->SetFrom("peppegym5b@gmail.com");
     $mail->AddAddress($recipient);
     $mail->Subject = $subject;
     $mail->Body = $message;

     return $mail->send();
}
