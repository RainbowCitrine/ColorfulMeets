<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST["message"];

    require __DIR__ . '/../vendor/autoload.php';

    $mail = new \PHPMailer\PHPMailer\PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->Username = "your_email@example.com";
    $mail->Password = "your_email_password";

    $mail->setFrom($email, $name);
    $mail->addAddress("noahgbosco@gmail,com", "Noah");

    $mail->Subject = $subject;
    $mail->Body = $message;

    if ($mail->send()) {
        
    } 
    else 
    {
        header("Location: ../index.php?status=success");
        exit();
    }
}
?>
