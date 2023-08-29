
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link rel="stylesheet" href="header.css" />
    <title>Header</title>
</head>
<body>
    <div class="menu-bar">
        <h1 class="logo">Fitness<span>360</span></h1>
        <ul>
            <li><a href="index.php">Početna</a></li>
            <?php
            session_start();
            if (isset($_SESSION['u_name'])) {
                echo '<li><a href="odjava.php">Odjava</a></li>';
            } else {
                echo '<li><a href="prijava.php">Prijava</a></li>';
                echo '<li><a href="registracija.php">Registracija</a></li>';
            }
            ?>
        </ul>
    </div>
</body>
</html>
