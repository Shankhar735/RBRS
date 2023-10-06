<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Side Navigation Bar</title>
	<link rel="stylesheet" href="css/profilenav.css">
    <script src="https://kit.fontawesome.com/cacd88a93b.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="../admin/images/setting.png" type="image/x-icon">
</head>
<body>

<div class="wrapper">
    <div class="sidebar">
        <h2>Settings</h2>
        <ul>
            <li><a href="manage_profile.php"><i class="fa-solid fa-id-badge"></i>Profile</a></li>
            <?php
                include 'conn.php';
                $email = $_SESSION['Email'];
                $stmt = $pdo->query("SELECT Id FROM users WHERE Email = '$email'");
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <li><a href="change_username.php?id=<?php echo $row['Id']; ?>"><i class="fa-solid fa-file-signature"></i>Change Username</a></li>
            <?php
                }
            ?>
           
            <li><a href="change_password.php"><i class="fa-solid fa-key"></i>Change password</a></li>
            <li><a href="../lessons.php"><i class="fa-solid fa-circle-chevron-left"></i>Go Back to Religious book</a></li>
        </ul>
    </div>