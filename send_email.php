<?php
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
?>
