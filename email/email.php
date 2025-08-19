<?php
// email/email.php - Send contact form using PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/PHPMailer/src/Exception.php';
require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';

$response = ["success" => false, "message" => ""];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname = trim($_POST['fname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $website = trim($_POST['website'] ?? '');
    $message = trim($_POST['message'] ?? '');
    if ($fname && $email && $message) {
        $mail = new PHPMailer(true);
        try {
            // SMTP config (update with your SMTP details)
            $mail->isSMTP();
            $mail->Host = 'smtp.example.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'your@email.com';
            $mail->Password = 'yourpassword';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom($email, $fname);
            $mail->addAddress('info@company.com', 'Webon Contact');
            $mail->Subject = 'New Contact Form Submission';
            $mail->isHTML(true);
            $mail->Body = "<strong>Name:</strong> $fname<br><strong>Email:</strong> $email<br><strong>Phone:</strong> $phone<br><strong>Website:</strong> $website<br><strong>Message:</strong> $message";
            $mail->AltBody = "Name: $fname\nEmail: $email\nPhone: $phone\nWebsite: $website\nMessage: $message";
            $mail->send();
            $response["success"] = true;
            $response["message"] = "Thank you for contacting us! We will get back to you soon.";
        } catch (Exception $e) {
            $response["message"] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        $response["message"] = "Please fill in your name, email, and message.";
    }
}
header('Content-Type: application/json');
echo json_encode($response);
