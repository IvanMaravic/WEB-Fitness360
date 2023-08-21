<?php
require_once "connect.php"; // Include the database connection script

// Get form data
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$password = $_POST['password'];
$repassword = $_POST['repassword'];
$email = $_POST['email'];
$u_name = $_POST['u_name'];

$conn=new mysqli('localhost', 'root','','fitnessbase');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else{
    $stmt = $conn->prepare("INSERT INTO users (firstName, lastName, password, repassword, email, u_name) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $firstName, $lastName, $password, $repassword, $email, $u_name);
    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
// Insert data into the database

?>
