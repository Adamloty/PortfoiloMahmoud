<?php

require_once "PHPMailer/vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$response = array();
$Name = $_POST["name"];
$Email = $_POST["email"];
$Phone = $_POST["phone"];
$Subject = $_POST["subject"];
$Message = $_POST["message"];

/* Email to Admin */
$to = 'jojomahmoud012@gmail.com';
$subject = $Subject;
$ishtml = true;
$text = "";

$text .= "<strong>Name</strong>: " . htmlspecialchars($Name) . "<br>";
$text .= "<strong>Email</strong>: " . htmlspecialchars($Email) . "<br>";
$text .= "<strong>Phone</strong>: " . htmlspecialchars($Phone) . "<br>";
$text .= "<strong>Subject</strong>: " . htmlspecialchars($Subject) . "<br>";
$text .= "<strong>Message</strong>: " . nl2br(htmlspecialchars($Message)) . "<br>";

$mail = new PHPMailer(true);
$mail->IsSMTP();
$mail->SMTPDebug = 0;
$mail->SMTPAuth = true;

// Gmail SMTP
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;

$mail->Username = 'jojomahmoud012@gmail.com'; 
$mail->Password = 'khij qkoz meuo fswk';   

// Email ID which will be displayed in the "From" attribute
$mail->setFrom($Email, $Name); // يتم تعيين البريد الإلكتروني الذي كتبه المستخدم في الفورم
$mail->AddAddress($to);
$mail->Subject = $subject;
$mail->isHTML($ishtml);
$mail->Body = $text;

try {
    $mail->send();
    $response["success"] = '<p class="alert alert-success w-100 m-0 mt-4">Thank you for your message. It has been sent.</p>';
} catch (Exception $e) {
    $response["error"] = '<p class="alert alert-danger w-100 m-0 mt-4">There was an error trying to send your message. Please try again later. Mailer Error: ' . $mail->ErrorInfo . '</p>';
}

echo json_encode($response);
die;
?>
