<?php
session_start();
if(isset($_POST['submit'])){
  $u_name = $_POST['u_name'];
  $password = $_POST['password'];
  if(empty($u_name) || empty($password)){
    $_SESSION['error'] = "All fields are required.";
    header("Location: prijava.php");
    exit();
  }
  $conn = mysqli_connect("localhost", "root", "", "fitnessbase");
  if(!$conn){
    die("Connection failed: ". mysqli_connect_error());
  }
  $sql = "SELECT * FROM korisnici WHERE u_name='$u_name' AND password='$password'";
  $result = mysqli_query($conn, $sql);
  if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
  if(mysqli_num_rows($result) > 0){
    $_SESSION['u_name'] = $u_name;
    header("Location: index.php");
    exit();
  }else{
    $_SESSION['error'] = "Invalid credentials.";
    header("Location: prijava.php");
    exit();
  }
  mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="prijava.css" />
</head>
<body>
  
  <?php
  if(isset($_SESSION['error'])){
    echo "<p style='color:red;'>".$_SESSION['error']."</p>";
    unset($_SESSION['error']);
  }
  ?>
  <div class="container">
    <h2>Login</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <label>Username:</label>
      <input type="text" name="u_name" placeholder="Korisničko ime" required><br><br>
      <label>Password:</label>
      <input type="password" name="password" placeholder="Lozinka" required><br><br>
      <input type="submit" name="submit" id="button" value="Login">
    </form>
  </div>
  <div>
        <br>
        <a href="index.php" id="pocetna">Početna</a>
        <br>
    </div>
  
</body>
</html>