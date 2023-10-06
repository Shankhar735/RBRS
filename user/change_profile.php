<?php
session_start();
include '../admin/CRUD/connection.php';
if (!isset($_SESSION['login'])) {
    header('location:../index.php');
    exit;
}

$msg = "";
if (isset($_POST['submit'])) {
    $folder = "../userdp/" . basename($_FILES['image']['name']);

    $db = mysqli_connect("localhost", "root", "", "db_ms");
    $image = $_FILES['image']['name'];

    $file_ext = explode('.', $image);
    $file_ext_check = strtolower(end($file_ext));

    $valid_file_ext = array('png', 'jpg', 'jpeg');
    if (in_array($file_ext_check, $valid_file_ext)) {
        $Id = $_SESSION['Id'];
        $sql = "UPDATE `users` SET `Profile` = '$image' WHERE `users`.`Id` = $Id";
        mysqli_query($db, $sql);

        move_uploaded_file($_FILES['image']['tmp_name'], $folder);

        $msg = "**Profile picture changed";
    } else {
        $msg = "**Not a valid extension i.e.(png, jpg, jpeg)";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Profile Picture</title>
    <link rel="stylesheet" href="../css/profilenav.css">
    <link rel="shortcut icon" href="../admin/images/setting.png" type="image/x-icon">
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        .content {
            width: 100%;
            margin-left: 230px;
        }

        .content h1 {
            font-weight: 500;
            padding: 30px;
            background: white;
            border-bottom: 1px solid black;
        }

        .f {
            display: flex;
            justify-content: center;
            margin: 0 auto;
        }

        input[type=file]::file-selector-button {
            margin-top: 60px;
            margin-bottom: 30px;
            border: 2px dashed #c2cdda;
            padding: 180px;
            color: white;
            background-color: white;
        }

        .f i {
            position: absolute;
            left: 52%;
            font-size: 60px;
            margin-top: 210px;
        }

        p {
            position: absolute;
            top: 66%;
            left: 48%;
            font-size: 16px;
            font-weight: 500;
        }

        input[type=submit] {
            margin-left: 42%;
            padding: 10px;
            width: 120px;
            background-color: #4ea4dd;
            transition: 0.4s;
            font-size: 14px;
            font-weight: 500;
            border-radius: 22px;
            color: white;
            letter-spacing: 1px;
        }

        input[type=submit]:hover {
            background-color: #66ccff;
            color: black;
            cursor: pointer;
        }

        h4 {
            padding-top: 20px;
            text-align: center;
            font-size: 18px;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <?php
    include '../include/profilenav.php';
    ?>

    <div class="content">
        <h1>Change profile picture:</h1>
        <form method="post" enctype="multipart/form-data">
            <div class="f">
                <i class="fa-solid fa-cloud-arrow-up"></i>
                <input type="file" name="image" required>
            </div>
            <p>Drag & Drop Files to upload <br> OR, <br> Click to upload Files.</p>
            <div>
                <input type="submit" value="Upload" name="submit">
                <?php
                echo '<h4>' . $msg . '</h4>';
                ?>
            </div>
        </form>
    </div>
</body>
</html>