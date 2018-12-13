<?php
session_start();

// In case the user accesses this page without logging in
if( !(isset($_SESSION['usertype'])) && $_SESSION['usertype'] != "adim" ) {
    header("Location: index.php?login=usererror");
    exit();
}
?>

<html>
<head>
    <title>Admin Home Page</title>
    <script>
        function validate(form) {
            fail = ""
            fail += checkFile()
            fail += checkFileName(form.malwareName.value)

            if(fail == "")
                return true
            else {
                alert(fail)
                return false
            }
        }

        function checkFile() {
            if(document.getElementById("uploadedFile").files.length == 0)
                return "No file uploaded\n"
            else
                return ""
        }

        function checkFileName(name) {
            if(name == "")
                return "File name cannot be empty\n"
            else if(/[^\s+$]/.test(name))
                return "File name cannot be empty spaces\n"
            else if(/[[^\w-._]]/.test(name))
                return "File name can contain only alphanumeric, \"-\", \".\" or \"_\" characters\n"
            else 
                return ""
        }
    </script>

<body>
    <h1>Welcome Admin!</h1>

    <!-- For the admin to submit files -->
    <form method='post' action='admin_home.php' onsubmit = "return validate(this)">
        Select file to upload
        <input type='file' name='malwareFile' id="uploadedfile"> <br>
        <input type="text" name="malwareName" placeholder="Malware Name">
        <button type="submit">Submit</button> 
    </form>
    <!-- Logging out -->
    <form action="admin_home.php">
        <button type="submit">Log out</button>
    </form>
</body>
</html>

<?php
// If user submitted a file or logged out
if(isset($_POST['submit'])) {
    require_once "../includes/mysql_login.php";
    require_once "../includes/common.php";

    $malwareName = sanitizeString($con, $_POST['malwareName']);
    // Check to make sure that malware name field isn't empty
    if($malwareName === "") { 
        echo "<h2>Please make ensure that you have entered a name for the uploaded malware</h2><br>";
        exit();
    }
    // If the user uploaded a file, check to see if file signature matches those found in DB
    if($_FILES) {
        $file = htmlentities($_FILES['malwarefile']['name']);
        $signature = sanitizeString($con,file_get_contents($file, false, null, 20));  // read first 20 characters
        $query = "INSERT INTO malware(name, signature)
                VALUES('$malwareName', '$signature')";
        $result = $con->query($query);
        if(!$result) mysqlError($con);
        echo "<h2>Malware $malwareName successfully uploaded.</h2>";
    }
    // if the user logged out
    else {
        destroySession();
    }


    $_POST['submit'] = array();
}
?>