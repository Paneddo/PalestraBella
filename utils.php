<?php

function test_input($data)
{
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
}

function getConnection()
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

use PHPMailer\PHPMailer\PHPMailer;

function sendMail($recipient, $subject, $message)
{
     require './vendor/phpmailer/phpmailer/src/PHPMailer.php';
     require './vendor/phpmailer/phpmailer/src/SMTP.php';
     require './vendor/phpmailer/phpmailer/src/Exception.php';


     $mail = new PHPMailer();
     $mail->IsSMTP();

     $mail->SMTPDebug = 1;
     $mail->CharSet = "UTF-8";
     $mail->Host = "smtp.gmail.com";
     $mail->Port = 465;

     $mail->SMTPSecure = 'ssl';
     $mail->SMTPAuth = true;

     $mail->Username = "wetsos.5b@gmail.com";
     $mail->Password = "vcap gnbe ioyu doxa";

     $mail->SetFrom("wetsos.5b@gmail.com");
     $mail->AddAddress($recipient);
     $mail->Subject = $subject;
     $mail->Body = $message;
}
