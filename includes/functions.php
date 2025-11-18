<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/phpmailer/PHPMailer.php';
require __DIR__ . '/phpmailer/SMTP.php';
require __DIR__ . '/phpmailer/Exception.php';

// =====================================
// GANTI DENGAN EMAIL + APP PASSWORD KAMU
// =====================================
define("EMAIL_FROM", "fauzangaming60@gmail.com");
define("EMAIL_PASS", "pflt azav ehia urmy"); 
// =====================================

function send_activation_email($email, $token) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;

        $mail->Username = EMAIL_FROM;
        $mail->Password = EMAIL_PASS;

        $mail->SMTPSecure = "ssl";
        $mail->Port = 465;

        $mail->setFrom(EMAIL_FROM, "Task Manager");
        $mail->addAddress($email);

        $activation_link = "http://localhost/task_manager/activate.php?token=$token";

        $mail->isHTML(true);
        $mail->Subject = "Aktivasi Akun Anda";
        $mail->Body = "
            Klik link berikut untuk aktivasi akun Anda (berlaku 24 jam):<br><br>
            <a href='$activation_link'>$activation_link</a>
        ";

        $mail->send();
        return true;

    } catch (Exception $e) {
        echo "Gagal kirim email aktivasi: " . $mail->ErrorInfo;
        return false;
    }
}

function send_reset_email($email, $token) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;

        $mail->Username = EMAIL_FROM;
        $mail->Password = EMAIL_PASS;

        $mail->SMTPSecure = "ssl";
        $mail->Port = 465;

        $mail->setFrom(EMAIL_FROM, "Task Manager");
        $mail->addAddress($email);

        $reset_link = "http://localhost/task_manager/reset_password.php?token=$token";

        $mail->isHTML(true);
        $mail->Subject = "Reset Password Anda";
        $mail->Body = "
            Klik link berikut untuk reset password Anda:<br><br>
            <a href='$reset_link'>$reset_link</a>
        ";

        $mail->send();
        return true;

    } catch (Exception $e) {
        echo "Gagal kirim email reset: " . $mail->ErrorInfo;
        return false;
    }
}
?>
