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
            // Load SMTP credentials from includes/secrets.php if present (kept out of git)
            $smtpDefaults = [
                'smtp_host' => 'smtp.gmail.com',
                'smtp_user' => 'webontechhub@gmail.com',
                'smtp_pass' => '', // the real password is in secrets.php
                'smtp_port' => 587,
                'smtp_secure' => 'tls',
            ];
            $secretsPath = __DIR__ . '/../includes/secrets.php';
            if (file_exists($secretsPath)) {
                $cfg = include $secretsPath;
                if (is_array($cfg)) $smtpDefaults = array_merge($smtpDefaults, $cfg);
            }

            // SMTP config
            $mail->isSMTP();
            $mail->Host = $smtpDefaults['smtp_host'];
            $mail->SMTPAuth = true;
            $mail->Username = $smtpDefaults['smtp_user'];
            $mail->Password = $smtpDefaults['smtp_pass'];
            $mail->SMTPSecure = ($smtpDefaults['smtp_secure'] === 'ssl') ? PHPMailer::ENCRYPTION_SMTPS : PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = (int)$smtpDefaults['smtp_port'];
            $mail->setFrom($smtpDefaults['smtp_user'], $fname);

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
