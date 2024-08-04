<?php

error_reporting(E_ALL);


// require_once "../controllers/mail.controller.php";

require "../vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/phpmailer/phpmailer/src/Exception.php';
require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';

class SendMail {
    public static function contactEmail() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Create a new PHPMailer instance
            $mail = new PHPMailer();

            // Set up SMTP server settings (replace with your own)
            $mail->isSMTP();
            $mail->Host       = ''; // Your SMTP server host (remove the space at the end)
            $mail->SMTPAuth   = true;
            $mail->Username   = ''; // Your SMTP username
            $mail->Password   = ''; // Your SMTP password

            // You should use tls or ssl, not both. Choose the appropriate one based on your server's configuration.
            $mail->SMTPSecure = 'ssl'; // Use 'tls' or 'ssl', but not both
            $mail->Port       = 465; // Use port 465 for SSL or 587 for TLS

            // Retrieve form data
            $name = $_POST["name"];
            $email = $_POST["email"];
            $company = $_POST["company"];
            $subject = $_POST["subject"];
            $message = $_POST["message"];

            // Recipient's email address
            $to = ""; // Replace with your recipient's email address

            // Subject of the email
            $email_subject = "Contact Form Submission: $subject";

            // Compose the email message
            $email_message = "Name: $name\n";
            $email_message .= "Email: $email\n";
            $email_message .= "Company: $company\n";
            $email_message .= "Message:\n$message";

            // Set email addresses and subject
            $mail->setFrom($email, $name);
            $mail->addAddress($to);
            $mail->Subject = $email_subject;

            // Email message body
            $mail->Body = $email_message;

            // Send email using PHPMailer
            try {
                if ($mail->send()) {
                    // Email sent successfully
                    echo json_encode("ok");
                } else {
                    // Email sending failed
                    echo json_encode("error");
                }
            } catch (Exception $e) {
                // Exception occurred
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }
}
sendMail::contactEmail();
