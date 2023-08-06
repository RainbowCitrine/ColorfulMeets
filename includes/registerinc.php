<?php
if(isset($_POST['submit']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $pwd = $_POST['password'];
    $confirm_pwd = $_POST['confirm_password'];

    require_once 'database.php';
    require_once 'functions.inc.php';

    // Testing for empty variables
    if(emptyInputRegister($name, $email, $username, $pwd, $confirm_pwd) !== false)
    {
        header("Location: ../register.php?error=emptyinput");
        exit();
    }
    if(invalidUsername($username) !== false)
    {
        header("Location: ../register.php?error=invalidusername");
        exit();
    }
    if(invalidEmail($email) !== false)
    {
        header("Location: ../register.php?error=invalidemail");
        exit();
    }
    if(pwdMatch($pwd, $confirm_pwd) !== false)
    {
        header("Location: ../register.php?error=passwordsdontmatch");
        exit();
    }
    if(usernameExists($conn, $username, $email) !== false)
    {
        header("Location: ../register.php?error=usernametaken");
        exit();
    }

    createUser($conn, $name, $email, $username, $pwd);
}
else 
{
    header("Location: ../register.php");
    exit(); 
} 