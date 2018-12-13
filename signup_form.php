<html>
<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!--Bootsrap 4 CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<!--Custom styles--> 
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
	<script src="../js/signupCheck.js"></script>
    
    <title>Sign Up</title>
</head>

<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Sign up</h3>
			</div>
			<div class="card-body">
				<form action="signup_check.php" method="post" onsubmit="return validate(this);">
                    <!--First name -->
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
						<input type="text" name="firstName" class="form-control" placeholder="First Name">
                    </div>
                    <!--Last name -->
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" name="lastName" class="form-control" placeholder="Last Name">
                    </div>
                    <!--User name -->
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-book"></i></span>
						</div>
						<input type="text" name="userName" class="form-control" placeholder="User Name">
                    </div>
                    <!--Password -->
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
					<div class="form-group">
						<input type="submit" name="submit" value="Sign up" class="btn float-right login_btn">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>  


<?php

// If the user enters a user name that is already taken
if(isset($_GET['signup'])) {
    $value = $_GET['signup'];
    if($value == 'emptyfield') {
        echo "<br><h1>There was an empty field. Please fill out all fields</h1><br>";
    } elseif($value == 'usernameTaken') {
        echo "<br><h1>User name taken, pick another one.</h1><br>";
    }
    $_GET['signup'] = array();  // clear array when done
}
?>

