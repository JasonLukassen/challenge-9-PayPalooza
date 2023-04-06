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
    } else{
        $error_message = "Invalid username or password";
    }

    // Run a sample query
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "id: " . $row["id"]. " - username: " . $row["username"]. " - password: " . $row["password"]. "<br>";
        }
    } else {
        echo "0 results";
    }
}


?>