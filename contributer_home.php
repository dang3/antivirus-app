<?php
session_start();
$userFullName = $_SESSION['userFullName'];

// In case the user accesses this page without logging in
// if( !(isset($_SESSION['usertype'])) && $_SESSION['usertype'] != "contributer" ) {
//     header("Location: index.php?login=usererror");
//     exit();
// }
?>

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
    <link rel="stylesheet" type="text/css" href="../css/homeStyles.css">
    <script src="../js/uploadFile.js"></script>
    
    <title>Contributer Home Page</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <!-- Logo -->
            <div class="navbar-header">
                <span class="navbar-brand">DENNISDANG</span>
            </div>
            <!-- Logout -->
            <div class="nav navbar-nav navbar-right">
                <a href="logout.php" class="navbar-brand"><strong>Logout</strong></a>
            </div>
        </div>
    </nav>
    
    
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="mt-5">Welcome <?php echo $userFullName ?></h1>
                <p class="lead">Please upload a file. </p>
                
                <form method="POST" action="contributer_home.php">
                    <div class="form-group">
		                <div class="input-group input-file" name="Fichier1">
			                <span class="input-group-btn">
        		                <button class="btn btn-default btn-choose" type="button">Choose</button>
    		                </span>
    		            <input type="text" class="form-control" placeholder='Choose a file...' />
    		                <span class="input-group-btn">
                                <button class="btn btn-warning btn-reset" type="button">Reset</button>
                            </span>
                            <button type="submit" class="btn btn-primary pull-right" disabled>Submit</button>
                        </div>
	                </div>
                </form>
            </div>
        </div>
    </div>



    <!-- <div class="container">
        <h1>Welcome <?php echo $userFullName ?>!</h1>

        For the user to submit files 
        <form method='post' action='contributer_home.php'>
            Select file to upload
            <input type='file' name='uploadedFile'> <br>
            <button type="submit">Submit</button> 
        </form>
         Logging out 
        <form action="contributer_home.php">
            <button type="submit">Log out</button>
        </form>
    </div> -->
</body>
</html>

<?php
    if(isset($_POST['submit'])) {
        echo "<h1>asdfadf</h1>";
    } 



// If user submitted a file or logged out
/* if(isset($_POST['submit'])) {
    require_once "../includes/mysql_login.php";
    require_once "../includes/common.php";
    // If the user uploaded a file, check to see if file signature matches those found in DB
    if($_FILES) {
        $file = htmlentities($_FILES['uploadedFile']['name']);
        $signature = sanitizeString($con,file_get_contents($file, false, null, 20));  // read first 20 characters
        $query = "SELECT name FROM malware WHERE signature='$signature'";
        $result = $con->query($query);
        if(!$result) mysqlError($con);
        elseif($result->num_rows == 0) {
            echo "<h2>The uploaded file does not contain malware</h2><br>";
        }
        else {
            $malwareName = $result->fetch_assoc()['name'];
            echo "<h2>Caution! Uploaded file contains malware! Malware name: <strong>$malwareName</strong></h2><br>";
        }
    }
    // if the user logged out
    else {
        destroySession();
    }


    $_POST['submit'] = array();
} */

?>

