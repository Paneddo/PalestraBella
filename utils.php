<?php


function getConnection()
{
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
     return implode($pass); //turn the array into a string
}

use PHPMailer\PHPMailer\PHPMailer;

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
     // $mail->IsHTML(true);

     $mail->Username = "wetsos.5b@gmail.com";
     $mail->Password = "vcap gnbe ioyu doxa";

     //Set Params
     $mail->SetFrom("wetsos.5b@gmail.com");
     $mail->AddAddress($recipient);
     $mail->Subject = $subject;
     $mail->Body = $message;


     if (!$mail->Send()) {
          echo "Mailer Error: " . $mail->ErrorInfo;
     } else {
          echo "Message has been sent";
     }
}