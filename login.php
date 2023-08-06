<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel= stylesheet href="styles/login.css">
    <title>Login</title>
</head>
<body>
    <div class="login">
        <form action="includes/Logininc.php" method="post">
            <h2>Login</h2>
            <div class="logo">
                <img src="imgs/logo3.png" alt="logo">
            </div>
            <input type="text" name="username" placeholder="Username/Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="submit">Login</button>
        </form>
        <?php
        if(isset($_GET["error"]))
        {
            if($_GET["error"] == "emptyinput")
            {
                echo "<p>Fill in all fields!</p>";
            }
            else if($_GET["error"] == "wronglogin")
            {
                echo "<p>Wrong Login!</p>";
            }
        }
    ?>
    </div>
</body>
</html>