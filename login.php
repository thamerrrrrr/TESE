
<?php

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "web"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


function loginUser($conn) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        
        $sql = "SELECT * FROM users WHERE name = '$username' AND password = '$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $role = $row['role']; 
            session_start();
            if ($role == 'admin') {
                header("Location: admin.php"); 
            } else {
                header("Location: userPage.php"); 
            }
        } else {
            
            echo "Invalid username or password.";
        }
    }
}

loginUser($conn);

$conn->close();
?>
