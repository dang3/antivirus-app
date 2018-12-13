<html>
<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="styles.css">
    
    <title>Login</title>
</head>
<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Sign In</h3>
			</div>
			<div class="card-body">
				<form action="index.php" method="post">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
						<input type="text" name="username" id="userNameField" class="form-control" placeholder="username">
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" name="password" class="form-control" placeholder="password">
					</div>
					<div class="form-group">
						<input type="submit" name="submit" value="Login" class="btn float-right login_btn">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Don't have an account? 
                    <p><a href="signup/signup_form.php">Sign Up</a>
                </div>
			</div>
		</div>
	</div>
</div>
</body>
</html>  

<?php
if(isset($_POST['submit'])) {
    require_once "includes/mysql_login.php";

    // Get login information from user
    $uid = sanitizeString($con, $_POST['username']);
    $pw = sanitizeString($con, $_POST['password']);

    // Check if login information exists in database
    $query = "SELECT `User Name` FROM `Login Credentials` WHERE `User Name`='$uid'";
    $result = $con->query($query);
    if(!$result) mysqlError($con);
    elseif($result->num_rows == 0) {
        header("Location: index.php?login=error");
    } 
    else {
        // Check entered password against password in database
        $query = "SELECT `first name`, `last name`, `salt1`, `salt2`, `password hash` FROM `login credentials` WHERE `User Name`='$uid'";
        $result = $con->query($query);
        if(!$result) {mysqlError($con); }
        else {
            // check if passwords match
            $row = $result->fetch_assoc();
            $fullName = $row['first name'] . " " . $row['last name'];
            $salt1_DB = $row['salt1'];
            $salt2_DB = $row['salt2'];
            $pwhash_DB = $row['password hash'];
            $pwhash_calculated = getpw_hashed($salt1_DB, $salt2_DB, $pw);
            // if passwords match, redirect to new page depending on if user is admin or regular user
            if($pwhash_DB === $pwhash_calculated) {
                session_start();
                // check if admin
                if($uid === 'admin') {
                    $_SESSION['usertype'] = "admin";
                    header("Location: users/admin_home.php");
                }
                else {
                // else is a regular user
                    $_SESSION['usertype'] = "contributer";
                    $_SESSION['userFullName'] = $fullName;
                    header("Location: users/contributer_home.php");
                }
            }
            else {  // if the password was incorrect
                header("Location: index.php?login=error");
            }
        }
    }
    $_POST['submit'] = array();
}

// User redirected here if username and password combination were incorrect
if(isset($_GET['login']) && $_GET['login'] == 'error') {
    echo "Your username and password combination were incorrect. Please try again<br>";
    $_GET['login'] = array();
}

// User redirected here if registration succcessful
if(isset($_GET['signup'])) {
    if($_GET['signup'] == 'successful') {
        echo "<br><h1>Sign up success!!! Please login</h1><br><br>";
    }
    $_GET['signup'] = array();
}
?>