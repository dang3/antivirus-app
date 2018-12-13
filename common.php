<?php

// Inserts items into login credentials tables in DB
function insert_loginTable($first, $last, $uid, $pwhash, $salt1, $salt2, $con) {
    $query = "INSERT IGNORE INTO `Login Credentials`(`First Name`, `Last Name`, `User Name`, `Password Hash`, `Salt1`, `Salt2`) 
            VALUES ('$first', '$last', '$uid', '$pwhash', '$salt1', '$salt2')";
    $result = $con->query($query);
    if(!$result) mysqlError($con);
}

// Returns hashed password
function getpw_hashed($salt1, $salt2, $pw) {
    return hash("ripemd128", $salt1.$pw.$salt2);
}

// Sanitize string
function sanitizeString($con, $string) {
    if(get_magic_quotes_gpc()) $string = stripslashes($string);
    $string = htmlentities($string); 
    $string = $con->real_escape_string($string);
    return $string;   
}

// For MySQL query errors
function mysqlError($con) { 
    $msg = mysqli_error($con);

    echo <<< _END
        <br><br>
        Error, your request could not be completed. Please contact Fabio Di Troia at fabioDiTroia@sjsu.edu and reference the following error message: $msg<br>
        <br><br>
_END;
}

// Destroy session
function destroySession() {
    session_start();
    $_SESSION = array();
    setcookie(session_name(), time() - 2592000, '/');
    session_destroy();
} 



/*
    Admin login info
    username: admin
    passowrd: 45c0reNd7y3ar5ag0

*/
?>