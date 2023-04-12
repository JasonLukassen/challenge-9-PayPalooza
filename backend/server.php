<?php
// MySQL server configuration
$servername = "localhost";
$username = "JasonWong";
$password = "ThisIsThePaypaloozaServer";
$dbname = "paypalooza";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    
    $loginCheck = "SELECT * FROM users WHERE username='$username' AND password='$password'";

    $result = mysqli_query($conn, $loginCheck);
    
    if (mysqli_num_rows($result) === 1){
        session_start();
        $_SESSION['username'] = $username;
        if(isset($_POST['remember-me'])){
            // set cookie for 30 days
            setcookie("username", $username, time() + (86400 * 30), "/");
        }
        header("Location: dashboard.php");
        exit();
    } else{
        $error_message = "Invalid username or password";
    }
}
?>