<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel= stylesheet href="styles/styles.css">
    <title>Colorful Meets</title>
</head>
<body>
    <div class="nav">
        <nav class="navbar">
            <ul class="content">
                <li><a href="index.php">Home</a></li>
                <li><a href="#about">About Us</a></li>
                <li><a href="partners.php" target="_blank">Partners</a></li>
                <li><a href="book_event.php" target="_blank">Events</a></li>
                <li><a href="contact.php" target="_blank">Contact Us</a></li>
                <?php
                    if(isset($_SESSION["useruid"]))
                    {
                        echo "<li><a href='profile.php'>Profile Page</a></li>";
                        echo "<li><a href='includes/logoutscript.php'>Log Out</a></li>";
                    }
                    else 
                    {
                        echo "<li><a href='register.php' target='_blank'>Register</a></li>";
                        echo "<li><a href='login.php' target='_blank'>Log In</a></li>";
                    }
                ?>
            </ul>
        </nav>
    </div>
    <section id="home">
    <div class="hero-content">
        <h1 class="hero-title">🌈 Welcome to Colorful Meets 🌈</h1>
        <p class="hero-subtitle">🦄 Join and meet others in your community! We welcome all! 🦄</p>
        <div class="cta-buttons">
                <button id="register-button" class="buttons" type="button">Register</button>
                <button id="login-button" class="buttons" type="button">Login</button>
        </div>
        <br>
        <p class="hero-description">Colorful Meets is a vibrant and inclusive initiative with a noble mission to create a welcoming space for individuals of marginalized genders within the community. Our platform connects people through diverse events, workshops, and meetups. Join us and be a part of this amazing community today!</p>
    </div>
</section>
    <section id="about">
    <div class="container">
        <div class="white-box">
            <h2 class="title">🌈 Colorful Meets 🌈</h2>
            <p>Colorful Meets is a vibrant and inclusive initiative with a noble mission to create a welcoming space for individuals of marginalized genders within the community. Check out some of the events that are currently being hosted by people in your community. Feel free to register and meet others through events in your community! You can also get involved with our partners!</p>
            <button id="partner-button" class="button" type="button">Partners</button>
            <button id="events-button" class="button" type="button">Events</button>
        </div>
    </div>
    <div class="image">
        <img src="imgs/logo6.png" alt="logo">
    </div>
    </section>
    <script>
        const registerButton = document.getElementById('register-button');
        const loginButton = document.getElementById('login-button');
        const partnerButton = document.getElementById('partner-button'); 
        const eventsButton = document.getElementById('events-button'); 
        const registerURL = 'http://localhost/colorfulmeets/register.php'; 
        const loginURL = 'http://localhost/colorfulmeets/login.php';
        const partnerURL = 'http://localhost/colorfulmeets/partners.php';
        const eventsURL = 'http://localhost/colorfulmeets/book_event.php';

        function redirectToPage(url)
        {
            window.location.href = url; 
        }

        registerButton.addEventListener('click', function(){
            redirectToPage(registerURL);
        });

        loginButton.addEventListener('click',function(){
            redirectToPage(loginURL);
        });
        eventsButton.addEventListener('click',function(){
            redirectToPage(eventsURL);
        });
        partnerButton.addEventListener('click',function(){
            redirectToPage(partnerURL);
        });
    </script>
</body>
</html>