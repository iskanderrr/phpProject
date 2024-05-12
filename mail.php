<?php  
use phpmailer\PHPMailer\PHPMailer;
use phpmailer\PHPMailer\Exception;

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
function mailTo($to,$name,$body){

    $mail = new PHPMailer();

    // SMTP configuration
    $mail->isSMTP();
    $mail->Host = 'smtp-mail.outlook.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'deedupdate@outlook.com';
    $mail->Password = 'upworkBernard69*';
    $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587; // TCP port to connect to
    
    // Email content
    $mail->setFrom('deedupdate@outlook.com', 'Your Name');
    $mail->addAddress($to, $name);
    $mail->Subject = 'Subject Here';
    $mail->Body = 'Email body here';
    
    // Send email
    if ($mail->send()) {
        echo 'Email sent successfully.';
    } else {
        echo 'Error sending email: ' . $mail->ErrorInfo;
    }
}

?>