<?php

if(isset($_POST['submit'])) {
    require_once "../includes/mysql_login.php";
    require_once "../includes/common.php";

    // Obtain inputs from user
    $firstName = sanitizeString($con, $_POST['firstName']);
    $lastName = sanitizeString($con, $_POST['lastName']);
    $userName = sanitizeString($con, $_POST['userName']);
    $password = sanitizeString($con, $_POST['password']);

    // Check if there are any empty fields
    if($firstName == '' || $lastName == '' || $userName == '' || $password == '' ) {
        header("Location: signup_form.php?signup=emptyfield");
        exit();
    }
    else {
        // Check if user name is already taken
        $query = "SELECT `User Name` FROM `Login Credentials` WHERE `User Name`= '$userName'";
        $result = $con->query($query);
        if(!$result) mysqlError($con);
        elseif($result->num_rows > 0) {
            header("Location: signup_form.php?signup=usernameTaken");
            exit();
        }
        else {  // store credentials in database if everything is valid, redirects user to index.php
            $salt1 = random_bytes(20);
            $salt2 = random_bytes(20);
            $pwhashed = getpw_hashed($salt1, $salt2, $password);
            insert_loginTable($firstName, $lastName, $userName, $pwhashed, $salt1, $salt2, $con);
            header("Location: ../index.php?signup=successful");
            exit();
        }
    }

    $_POST['submit'] = array();
}
else {
    // In case someone tries to go to this page without properly making an account first
    header("Location: signup_form.php");
    exit();
}
?>