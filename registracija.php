<?php
// Start session
session_start();

// Check if the form is submitted
if(isset($_POST['submit'])){
    // Get the form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    $email = $_POST['email'];
    $u_name = $_POST['u_name'];

    if(empty($firstName) || empty($lastName) || empty($password) || empty($repassword) || empty($email) || empty($u_name)){
        $_SESSION['error'] = "Nisu popunjena sva polja za unos podataka.";
        header("Location: registracija.php");
        exit();
    }elseif($password!= $repassword){
        $_SESSION['error'] = "Passwords do not match.";
        header("Location: registracija.php");
        exit();
    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $_SESSION['error'] = "Invalid email format.";
        header("Location: registracija.php");
        exit();
    }else{
        $conn = mysqli_connect("localhost", "root", "", "fitnessbase");
        if(!$conn){
            die("Connection failed: ". mysqli_connect_error());
        }


        $emailCheckQuery = "SELECT * FROM korisnici WHERE email = '$email'";
        $emailCheckResult = mysqli_query($conn, $emailCheckQuery);
        if(mysqli_num_rows($emailCheckResult) > 0){
            $_SESSION['error'] = "Email se već koristi.";
            header("Location: registracija.php");
            exit();
        }

        $uNameCheckQuery = "SELECT * FROM korisnici WHERE u_name = '$u_name'";
        $uNameCheckResult = mysqli_query($conn, $uNameCheckQuery);
        if(mysqli_num_rows($uNameCheckResult) > 0){
            $_SESSION['error'] = "Korisničko ime se već koristi.";
            header("Location: registracija.php");
            exit();
        }

        $sql = "INSERT INTO korisnici (firstName, lastName, password, email, u_name) VALUES ('$firstName', '$lastName', '$password', '$email', '$u_name')";

        // Execute the SQL statement
        if(mysqli_query($conn, $sql)){
            $_SESSION['success'] = "Registration successful.";
            header("Location: prijava.php");
            exit();
        }else{
            $_SESSION['error'] = "Registration failed.";
            header("Location: registracija.php");
            exit();
        }

        // Close the database connection
        mysqli_close($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="registracija.css" />
</head>
<body>
    <?php
    if(isset($_SESSION['error'])){
        echo "<p style='color:red;'>".$_SESSION['error']."</p>";
        unset($_SESSION['error']);
    }
   ?>
   <div class="container">
   <h2>Registracija</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label>First Name:</label>
        <input type="text" name="firstName" placeholder="Ime" required><br><br>
        <label>Last Name:</label>
        <input type="text" name="lastName" placeholder="Prezime" required><br><br>
        <label>Password:</label>
        <input type="password" name="password" placeholder="Lozinka" required><br><br>
        <label>Confirm Password:</label>
        <input type="password" name="repassword" placeholder="Ponovite lozinku" required><br><br>
        <label>Email:</label>
        <input type="email" name="email" placeholder="E-mail" required><br><br>
        <label>Username:</label>
        <input type="text" name="u_name" placeholder="Korisnicko ime" required><br><br>
        <input type="submit" name="submit" value="Register" id="button">
    </form>
   </div>
   <div>
        <br>
        <a href="index.php" id="pocetna">Pocetna</a>
        <br>
    </div>
    
</body>
</html>