<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

// الـ Secret Key الذي حصلت عليه من reCAPTCHA
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // استلام البيانات المدخلة
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars($_POST['message']);
    
    // مفتاح reCAPTCHA السري
    $secretKey = "6LddHsoqAAAAAOE7CcBmm73FgG9rZJY7vQq-P1DI";
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "secret=$secretKey&response=$recaptchaResponse");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    
    $responseKeys = json_decode($response, true);
    
    if (intval($responseKeys["success"]) !== 1) {
        echo "فشل التحقق من reCAPTCHA. حاول مرة أخرى.";
    } else {
        echo "تم النحقق بنجاح!";
    }
}
    try {
        $mail = new PHPMailer(true);

        // إعداد SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'menuiserie.pro.temara@gmail.com'; // ضع بريدك هنا
        $mail->Password = 'ecox yphp fqgi oypc'; // ضع App Password هنا
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // إعداد البريد
        $mail->setFrom('menuiserie.pro.temara@gmail.com', 'hassan menuiserie');
        $mail->addAddress('menuiserie.pro.temara@gmail.com'); // البريد المستلم
        $mail->Subject = "confirmation de votre commande sur notre site";
        $mail->Body = "Bonjour! Merci de nous avoir contactés. Nous vous contacterons bientôt.";

        // إرسال البريد
        $mail->send();
        echo 'تم إرسال الرسالة بنجاح!';
    } catch (Exception $e) {
        echo "خطأ أثناء الإرسال: {$mail->ErrorInfo}";
    }
?>
