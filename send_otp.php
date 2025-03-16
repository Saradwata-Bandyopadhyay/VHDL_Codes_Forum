<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function generateOTP($length = 6)
{
    return rand(pow(10, $length - 1), pow(10, $length) - 1);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    $email = $_POST['email'];
    $otp = generateOTP();

    include 'connect.php';

    $checkUserSql = "SELECT * FROM `users` WHERE `emailid` LIKE '$email'";
    $checkUserResult = mysqli_query($conn, $checkUserSql);

    if (mysqli_num_rows($checkUserResult) > 0) {
        echo json_encode(['success' => false, 'error' => 'User already exists']);
    } else {
        $createUserSql = "INSERT INTO users (emailid, otp, ts) VALUES ('$email','$otp',current_timestamp())";
        $createUserResult = mysqli_query($conn, $createUserSql);

        if ($createUserResult) {
            $mail = new PHPMailer(true);

            try {

                // Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.example.com'; // Set your SMTP server
                $mail->SMTPAuth = true;
                $mail->Username = 'your_email@example.com'; // SMTP username
                $mail->Password = 'your_password'; // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
                $mail->Port = 587; // TCP port to connect to

                // Sender info
                $mail->setFrom('email_id', 'Email Subject'); // Update email_id and Email Subject

                $mail->addAddress($email, 'User');

                $mail->isHTML(true);
                $mail->Subject = 'Your OTP for Signup';
                $mail->Body = 'Your OTP is: ' . $otp;

                $mail->send();

                echo json_encode(['success' => true]);
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'error' => $mail->ErrorInfo]);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'Error saving OTP to database']);
        }
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request']);
}
?>