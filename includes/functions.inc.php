<?php

// used for our empty fields checker 
function emptyInputRegister($name, $email, $username, $pwd, $confirm_pwd)
{
    $result; // boolean flag 
    if(empty($name) || empty($email) || empty($username) || empty($pwd) || empty($confirm_pwd))
    {
        $result = true; 
    }
    else 
    {
        $result = false; 
    }
    return $result;
}

function invalidUsername($username)
{
    $result; // boolean flag 
    if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) // searches for symbols
    {
        $result = true; 
    }
    else 
    {
        $result = false; 
    }
    return $result;
}

function invalidEmail($email){
    $result; // boolean flag 
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) // searches for valid emails
    {
        $result = true; 
    }
    else 
    {
        $result = false; 
    }
    return $result;
}

function pwdMatch($pwd, $confirm_pwd)
{
    $result; // boolean flag 
    if($pwd !== $confirm_pwd) // searches for valid passwords
    {
        $result = true; 
    }
    else 
    {
        $result = false; 
    }
    return $result;
}

function usernameExists($conn, $username, $email)
{
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;"; // SQL statement to find existing users and emails
    $stmt = mysqli_stmt_init($conn); // connecting to the db
    if(!mysqli_stmt_prepare($stmt, $sql)) // if the statement fails
    {
        header("Location: ../register.php?error=stmtfailed");
        exit(); 
    }

    // security
    mysqli_stmt_bind_param($stmt, "ss", $username, $email); // binding the parameters to the statement
    mysqli_stmt_execute($stmt); // executing the statement

    $resultData = mysqli_stmt_get_result($stmt); // getting the results from the statement

    if($row = mysqli_fetch_assoc($resultData)) // if there is a result
    {
        return $row; 
    }
    else 
    {
        return $result = false; 
    }
    mysqli_stmt_close($stmt); // closing the statement
}

function createUser($conn, $name, $email, $username, $pwd)
{
    $sql = "INSERT INTO users (usersFullName, usersEmail, usersUid, usersPassword) VALUES (?, ?, ?, ?);"; // SQL statement to find existing users and emails
    $stmt = mysqli_stmt_init($conn); // connecting to the db
    if(!mysqli_stmt_prepare($stmt, $sql)) // if the statement fails
    {
        header("Location: ../register.php?error=stmtfailed");
        exit(); 
    }

    $hashpwd = password_hash($pwd, PASSWORD_DEFAULT); // hashing the password

    // security
    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashpwd); // binding the parameters to the statement
    mysqli_stmt_execute($stmt); // executing the statement

    mysqli_stmt_close($stmt); // closing the statement

    header("Location: ../register.php?error=none");
    exit();
}

//Login functions

function emptyInputLogin($username, $pwd)
{
    $result; // boolean flag 
    if(empty($username) || empty($pwd))
    {
        $result = true; 
    }
    else 
    {
        $result = false; 
    }
    return $result;
}

function loginUser($conn, $username, $pwd)
{
    $usernameExists = usernameExists($conn, $username, $pwd);

    if($usernameExists === false)
    {
        header("Location: ../login.php?error=wronglogin");
        exit(); 
    }

    $pwdHashed = $usernameExists["usersPassword"]; // getting the hashed password from the db

    $checkPwd = password_verify($pwd, $pwdHashed); // checking if the password matches the hashed password

    if($checkPwd === false)
    {
        header("Location: ../login.php?error=wronglogin");
        exit();
    }
    elseif($checkPwd === true)
    {
        session_start();
        $_SESSION["userid"] = $usernameExists["usersId"];
        $_SESSION["useruid"] = $usernameExists["usersUid"];
        header("Location: ../index.php");
    }
}