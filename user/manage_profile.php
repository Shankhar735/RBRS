<?php
session_start();
include '../Database/connection_db.php';
if (!isset($_SESSION['login'])) {
    header('location:../signin.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Settings</title>
    <link rel="stylesheet" href="css/manage_profile.css">
    <script src="https://kit.fontawesome.com/cacd88a93b.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="../admin/images/setting.png" type="image/x-icon">
</head>
<body>
    <?php
    include 'profilenav.php';
    ?>

    <div class="main_content">
        <h1>Your Profile:</h1>
        <div class="info">            
            <h2>Username: <?php echo $_SESSION['Name']; ?></h2> <br>
            <h2>Email: <?php echo $_SESSION['Email']; ?></h2><br>
            <a href="change_profile.php">Change profile picture</a> <br>
            <button onclick="location.href='logout.php'">Logout</button>
        </div>
    </div>
</body>
</html>