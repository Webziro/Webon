<?php
require_once __DIR__ . '/../includes/db.php';
// email/email.php - Send contact form using PHPMailer
require '../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$response = ["success" => false, "message" => ""];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname = trim($_POST['fname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $website = trim($_POST['website'] ?? '');
    $message = trim($_POST['message'] ?? ''); 
    //print_r($_POST) or die();
    if ($fname && $email && $message) {
        $mail = new PHPMailer(true);
        try {
            // SMTP config (update with your SMTP details)
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'webontechhub@gmail.com';
            $mail->Password = 'gahb occw lbbr kppj';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->setFrom('webontechhub@gmail.com', $fname);

            //$mail->setFrom($email, $fname);
            $mail->addAddress('webontechhub@gmail.com', 'Webon Contact');
            $mail->Subject = 'New Contact Form Submission';
            $mail->isHTML(true);
            $mail->Body = "<strong>Name:</strong> $fname<br><strong>Email:</strong> $email<br><strong>Phone:</strong> $phone<br><strong>Website:</strong> $website<br><strong>Message:</strong> $message";
            $mail->AltBody = "Name: $fname\nEmail: $email\nPhone: $phone\nWebsite: $website\nMessage: $message";
            $mail->send();
            
            // Save to database after sending email
            $stmt = $pdo->prepare("INSERT INTO contact_messages (fname, email, phone, website, message) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$fname, $email, $phone, $website, $message]);
            $response["success"] = true;
            $response["message"] = "Thank you for contacting us! We will get back to you soon.";
        } catch (Exception $e) {
            $response["message"] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        $response["message"] = "Please fill in your name, email, and message.";
    }
}
if (!headers_sent()) {
    header('Content-Type: application/json');
}
echo json_encode($response);
exit;
