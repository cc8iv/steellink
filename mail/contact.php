<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Validate form
if (empty($_POST['name']) || empty($_POST['subject']) || empty($_POST['message']) || 
    !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    http_response_code(500);
    exit("Invalid form submission");
}

$name     = strip_tags($_POST['name']);
$email    = strip_tags($_POST['email']);
$m_subject= strip_tags($_POST['subject']);
$message  = strip_tags($_POST['message']);

$to = "nofacefinder@gmail.com"; 
$subject = "$m_subject: $name";
$body = "
    <h2>New Contact Form Submission</h2>
    <p><strong>Name:</strong> {$name}</p>
    <p><strong>Email:</strong> {$email}</p>
    <p><strong>Subject:</strong> {$m_subject}</p>
    <p><strong>Message:</strong><br>{$message}</p>
";

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'crownedx.creativ@gmail.com';
    $mail->Password   = 'piem zoex uuzw efef'; // <- use Gmail App Password here
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    $mail->setFrom('nofacefinder@gmail.com', 'Website Contact');
    $mail->addAddress($to, 'Website Admin');
    $mail->addReplyTo($email, $name);

    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = $body;

    $mail->SMTPDebug = 2;
    $mail->Debugoutput = 'html';

    $mail->send();
    echo "Message sent successfully!";
} catch (Exception $e) {
    http_response_code(500);
    echo "Mailer Error: {$mail->ErrorInfo}";
}
