<?php
include 'includes/events_data.php';
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the booking data
    $eventTitle = $_POST['event_title'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    require_once 'includes/database.php';

    $stmt = $conn->prepare("INSERT INTO bookings (event_title, name, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $eventTitle, $name, $email);
    $stmt->execute();

    // Close the prepared statement and database connection
    $stmt->close();
    $conn->close();
    
    $mail = new PHPMailer(true);

    try{
        $mail->isSMTP();
        $mail->Host = 'smtp.sendgrid.net';
        $mail->SMTPAuth = true;
        $mail->Username = 'apikey';
        $mail->Password = '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';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->setFrom('ngoss@student.mtsac.edu', 'Noah Rainbow');
        $mail->addAddress($email, $name);

        // Content
        $mail->isHTML(false);
        $mail->Subject = 'Event Booking Confirmation';
        $mail->Body = "Hello $name,\n\nThank you for booking the event: $eventTitle.\n\nYour booking has been confirmed.\n\nBest regards,\nYour Event Team";

        $mail->send();

         
    }
    catch(Exception $e)
    {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    // Show a booking confirmation message
    
}
?>

<!-- index.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Events Page</title>
    <link rel="stylesheet" href="styles/events.css">
</head>
<body>
    <div class="background-container">
        <div class="background">
            <h1>🦄 Upcoming Events 🦄</h1>
        </div>
    </div>
    <ul>
        <?php foreach ($events as $event): ?>
            <br>
            <br>
            <br>
            <li>
                <h2><?php echo $event['title']; ?></h2>
                <p>Date: <?php echo $event['date']; ?></p>
                <p>Location: <?php echo $event['location']; ?></p>
                <p>Description: <?php echo $event['description']; ?></p>
                <form method="post" action="book_event.php">
                    <input type="hidden" name="event_title" value="<?php echo $event['title']; ?>">
                    <label for="name">Your Name:</label>
                    <input type="text" id="name" name="name" required>
                    <label for="email">Your Email:</label>
                    <input type="email" id="email" name="email" required>
                    <input type="submit" value="Book Now">
                </form>
                <div class="confirmation-message">
                    <h2>Booking Confirmation</h2>
                    <p>Thank you, $name, for booking the event: $eventTitle.</p>
                    <p>An email with the confirmation details has been sent to $email.</p>
               </div>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
