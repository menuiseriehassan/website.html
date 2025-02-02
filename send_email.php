<?php
<<<<<<< HEAD
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // استقبال البيانات من النموذج
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // تأكد من أن البيانات غير فارغة
    if (!empty($name) && !empty($email) && !empty($message)) {
        // إعدادات البريد الإلكتروني
        $to = "hassanaitari4@gmail.com"; // بريدك الإلكتروني
        $subject = "رسالة جديدة من: " . $name;
        $body = "الاسم: $name\nالبريد الإلكتروني: $email\n\nالرسالة:\n$message";
        $headers = "From: $email" . "\r\n" . "Reply-To: $email" . "\r\n" . "X-Mailer: PHP/" . phpversion();

        // إرسال البريد الإلكتروني
        if (mail($to, $subject, $body, $headers)) {
            echo "تم إرسال الرسالة بنجاح.";
        } else {
            echo "حدث خطأ أثناء إرسال الرسالة.";
        }
    } else {
        echo "الرجاء ملء جميع الحقول.";
    }
}
=======
use PHPMailer-master\PHPMailer-master\PHPMailer-master;
use PHPMailer-master\PHPMailer-master\Exception;

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
>>>>>>> 583ef67b63e667d563e1aea5e108a698084afcf1
?>
