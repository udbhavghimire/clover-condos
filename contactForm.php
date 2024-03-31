<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

$mail = new PHPMailer;

$mail->isSMTP(); // Set mailer to use SMTP
$mail->Host = 'mail.clovercondo.ca'; // Specify main and backup SMTP servers
$mail->SMTPAuth = true; // Enable SMTP authentication
$mail->Username = 'info@clovercondo.ca'; // SMTP username
$mail->Password = 'mail@clovercondo'; // SMTP password
$mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587; // TCP port to connect to

$mail->setFrom('info@clovercondo.ca', $_POST['name']);
$mail->addAddress('hello@dolphy.ca');
$mail->addAddress('milan@homebaba.ca');

$mail->addReplyTo($_POST['email']);
$mail->isHTML(true);

$mail->Subject = "Clover Condo - Landing Page Inquiry";
$message = '<html>

<body>';
    $message .= '';
        $message .= "
            Name:
            " . strip_tags($_POST['name']) . "
        <br/>";
        $message .= "
            Phone:
            " . strip_tags($_POST['phone']) . "
       <br/> ";
        $message .= "
            Email:
            " . strip_tags($_POST['email']) . "
       <br/> ";
        $message .= "
        Realtor or working with one?:
        " . strip_tags($_POST['realtor']) . "
    <br/>";
        $message .= "
            Message : 
            " . strip_tags($_POST['message']) . "
       <br/> ";
        $message .= "
            Source : 
            clovercondo.ca
        ";
        $message .= "";
    $message .= "</body>

</html>";

$mail->Body = $message;
$mail->AltBody = $_POST['message'].$_POST['email'].$_POST['name'].$_POST['phone'];

if(!$mail->send()) {
    $_SESSION["error"] = "Application not submitted!";
    
        header("Location: index.php");
        exit();   
    
} else {
    $_SESSION["success"] = "Application submitted.";
    header("Location: ./thankyou/"); 
    exit(); 
    
}

?>