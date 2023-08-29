<?php
session_start(); // Make sure to start the session

if (isset($_SESSION['u_name']) && isset($_POST['selectedRating'])) {
    $user = $_SESSION['u_name'];
    $rating = $_POST['selectedRating'];

    // Replace with your database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "fitnessbase";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert the rating into the database
    $sql = "INSERT INTO korisnici (rate) VALUES ('$rating') WHERE u_name = '$user'";
    $sql = "UPDATE korisnici SET rate = '$rating' WHERE u_name = '$user'";

    if ($conn->query($sql) === TRUE) {
        echo "Rating inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid request";
}
?>