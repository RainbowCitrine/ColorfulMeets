<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = stylesheet href="styles/register.css">
    <title>Register</title>
</head>
<body>
    <section class="register">
        <div class="registry">
        <form action="includes/registerinc.php" method="post">
            <div class="logo">
                <img src="imgs/logo.png" alt="logo">
            </div>
            <h2>Register</h2>
            <input type="text" name="name" placeholder="Name" required>
            <input type="text" name="email" placeholder="Email" required>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <button type="submit" name="submit">Register</button>
        </form>
       </div>
       <?php
        if(isset($_GET["error"]))
        {
            if($_GET["error"] == "emptyinput")
            {
                echo "<p>Fill in all fields!</p>";
            }
            else if($_GET["error"] == "invalidusername")
            {
                echo "<p>Choose a proper username!</p>";
            }
            else if($_GET["error"] == "invalidemail")
            {
                echo "<p>Choose a proper email!</p>";
            }
            else if($_GET["error"] == "passwordsdontmatch")
            {
                echo "<p>Passwords don't match!</p>";
            }
            else if($_GET["error"] == "stmtfailed")
            {
                echo "<p>Something went wrong, try again!</p>";
            }
            else if($_GET["error"] == "usernametaken")
            {
                echo "<p>Username already taken!</p>";
            }
            else if($_GET["error"] == "none")
            {
                echo "<p>You have signed up!</p>";
            }
        }
    ?>
    </section>
    
</body>
</html>