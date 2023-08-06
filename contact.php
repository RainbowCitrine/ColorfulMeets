<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel= stylesheet href="styles/contactus.css">
    <title>Contact Us</title>
</head>
<body>
    <h2>🌈 Contact Us 🌈</h2>
    <?php
        if(isset($_GET["status"]))
        {
            if($_GET["status"] == "success")
            {
                echo '<p style="color: green;">Message sent successfully!</p>';
            }
            else if($_GET["status"] == "failed")
            {
                echo '<p style="color: red;">Failed to send the message. Please try again later.</p>';
            }
        }

    ?>
    <form action="includes/contactus_process.php" method="post">
        <label for="name">Name: </label>
        <input type="text" name="name" placeholder="Name" required>
        <br>
        <label for="email">Email: </label>
        <input type="text" name="email" placeholder="Email" required>
        <br>
        <label for="subject">Subject: </label>
        <input type="text" name="subject" placeholder="Subject" required>
        <br>
        <label for="message">Message: </label>
        <textarea name="message" cols="30" rows="10" placeholder="Message" required></textarea>
        <br>
        <button type="submit" name="submit">Submit</button>
    </form>
</body>
</html>