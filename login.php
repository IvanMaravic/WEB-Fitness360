<?php
session_start(); // Start the session

require_once "connect.php"; // Include the database connection script

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE u_name = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if ($password == $row['password']) {
            // Password matches, user is authenticated
            $_SESSION['username'] = $row['u_name'];
            header("Location: index.php"); // Redirect to the dashboard or any other page
            exit();
        } else {
            $login_error = "Invalid password.";
        }
    } else {
        $login_error = "Username not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login Page</title>
  <link rel="stylesheet" href="login.css" />
</head>

<body>
    <div class="container">
    <h2>Login</h2>
    <form>
      <label for="username">Username</label>
      <input type="text" id="username" name="k_ime" placeholder="Enter your username" required>
      
      <label for="password">Password</label>
      <input type="password" id="password" name="lozinka" placeholder="Enter your password" required>
      
      <button type="submit">Login</button>
    </form>
  </div>  

  <div>
    <br>
    <a href="index.html" id="pocetna">Početna</a>
    <br>
  </div>
</body>
</html>
